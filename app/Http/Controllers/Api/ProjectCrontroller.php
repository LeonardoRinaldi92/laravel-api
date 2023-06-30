<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;

class ProjectCrontroller extends Controller
{
    public function index(Request $request) {

        if($request->has('type_id')){

            $projects = Project::with('type','tags')->where('type_id',$request->type_id)->orderBy('created_at', 'desc')->paginate(6);

        } else {

            $projects = Project::with('type','tags')->orderBy('created_at', 'desc')->paginate(6);
        }
        

        return response()->json([
            'success' => true,
            'projects' => $projects
            
        ]);
    }

    public function show($slug) {

        $project = Project::with('type','tags')->where('slug',$slug)->first();

        if($project) {
            return response()->json([
                'success' => true,
                'projects' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errore' => 'no post avaible'
            ])->setStatusCode(404);

        }

    }
}
