<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use Illuminate\Http\Request;

class ProjectCrontroller extends Controller
{
    public function index() {
    
        $projects = Project::with('type','tags')->orderBy('created_at', 'desc')->paginate(6);

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}
