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
use App\SubteamRequest;
use Illuminate\Http\Request;


class ProjectController extends Controller
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


    public function saveProductionManagerProject(Request $request){
        $project = $this->dataSource->saveProject($request->all());

        $subteams = $this->dataSource->getAllSubteams()->toArray();

        //Create a subteam request for all the subteams
        foreach ($subteams as $subteam){
            $sr = new SubteamRequest();
            $sr->reportedBySubteam = $subteam['id'];
            $sr->project = $project->id;
            $sr->status = 1;
            $sr->needMorePeople = 0;
            $sr->needBiggerBudget = 0;

            $this->dataSource->saveSubteamRequest($sr);
        }


        return $project;
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

    public function getTotalCost($clientId){

        $projects  = Project::where('client', '=', $clientId)->get();
        $total = 0.0;
        foreach ($projects as &$project) {
            $total += $project->cost;
        }
        return "{\"total\":" . $total . "}";
    }
}