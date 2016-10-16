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


class ProjectController extends Controller
{
    public function index()
    {
        $projects = $this->dataSource->getAllProjects();
        return response()->json($projects);
    }

    public function getProject($id)
    {
        $project = $this->dataSource->getProjectById($id);
        return response()->json($project);
    }

    public function saveProject(Request $request)
    {
        $project = $this->dataSource->saveProject(new Project($request->all()));
        return response()->json($project);
    }

    public function deleteProject($id)
    {
        $this->dataSource->deleteProjectById($id);
        return response()->json('success');
    }

    public function updateProject(Request $request, $id)
    {
        $project = $this->dataSource->getProjectById($id);

        $project->name = $request->input('name');
        $project->client = $request->input('client');
        $project->description = $request->input('description');
        $project->cost = $request->input('cost');
        $project->start = $request->input('start');
        $project->stop = $request->input('stop');

        $this->dataSource->saveProject($project);

        return response()->json($project);
    }

    public function getTotalCost($clientId)
    {
        $total = $this->dataSource->getProjectCostSummation($clientId);
        return "{\"total\":" . $total . "}";
    }
}