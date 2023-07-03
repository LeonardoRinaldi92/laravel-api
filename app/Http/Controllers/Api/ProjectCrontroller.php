<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;

class ProjectCrontroller extends Controller
{
    public function index(Request $request) {

        $query = Project::with(['type','tags']);


        if( $request->has( 'type_id' ) ){
            $query->where( 'type_id', $request->type_id );
        }

        if ($request->has('tags_ids')) {
            $tagIds = explode(',', $request->tags_ids);
            $query->where(function ($query) use ($tagIds) {
                foreach ($tagIds as $tagId) {
                    $query->whereHas('tags', function ($query) use ($tagId) {
                        $query->where('tags.id', $tagId);
                    });
                }
            });
        }




        $projects = $query->orderBy('created_at', 'desc')->paginate(6);

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
