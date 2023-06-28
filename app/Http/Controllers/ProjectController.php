<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Admin\Project;
use App\Models\Admin\Type;
use App\Models\Admin\Tag;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::visible()->latest()->get();
        $types = Type::all();
        return view('pages.projects.index', compact('projects','types'));
    }

    public function indexForEdit()
    {
        $projects = Project::latest()->get();
        return view('pages.admin.projects.indexForEdit', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $tags = Tag::all();
        return view('pages.admin.projects.create', compact('types','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        if( $request->hasFile('image') ){
            $path = Storage::disk('public')->put( 'projects_images', $request->image );
        };

        $slug = Str::slug($request->name);
        
        $form_data = $request->validated();

        $form_data['slug'] = $slug;
        $form_data['image'] = $path;
 
        $new_project = new Project($form_data);
        $new_project->save();

        if ($request->has('tags')){
            $new_project->tags()->attach($request->tags);
        }
        
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)

    {
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function filter(Type $type)
    {
        $types = Type::all();
        $typeSelected = $type;
        $projects = $type->projects;
        return view('pages.projects.index', compact('projects','types', 'typeSelected'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $tags = Tag::all();

        return view('pages.admin.projects.edit',compact('project','types','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();

        if( $request->hasFile('image') ){        
            if( $project->image ){
                Storage::delete($project->image);
            }
            $path = Storage::disk('public')->put( 'projects_images', $request->image );
            $form_data['image'] = $path;
        }

        $form_data['slug'] = Str::slug($request->name);

        $project->update($form_data);

        if ($request->has('tags')){
            $project->tags()->sync($request->tags);
        }
        
        return redirect()->route('projects.show', $project)->with('success', "hai modificato l'elemento".$project['name']);
    }

    public function visibility(Project $project) {
        $project->update(['visibility' => !$project->visibility]);

        return redirect()->route('admin.projects.indexForEdit')->with('success', "hai modificato la vidibilità dell'elemento".$project['name']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if( $project->image ){
            Storage::delete($project->image);
            $project->delete();
        }  
        return redirect()->route('admin.projects.indexForEdit');
    }
}
