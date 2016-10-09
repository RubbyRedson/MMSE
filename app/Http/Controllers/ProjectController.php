<?php
/**
 * Created by PhpStorm.
 * Project: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Project;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class ProjectController extends BaseController
{
    public function index(){

        $projects  = Project::all();

        return response()->json($projects);

    }

    public function getProject($id){

        $project  = Project::find($id);

        return response()->json($project);
    }

    public function saveProject(Request $request){

        $project = Project::create($request->all());

        return response()->json($project);

    }

    public function deleteProject($id){
        $project  = Project::find($id);

        $project->delete();

        return response()->json('success');
    }

    public function updateProject(Request $request,$id){
        $project  = Project::find($id);

        $project->name = $request->input('name');
        $project->client = $request->input('client');
        $project->description = $request->input('description');
        $project->cost = $request->input('cost');
        $project->start = $request->input('start');
        $project->stop = $request->input('stop');

        $project->save();

        return response()->json($project);
    }
}