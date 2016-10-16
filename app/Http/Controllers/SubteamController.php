<?php
/**
 * Created by PhpStorm.
 * Project: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Subteam;
use Illuminate\Http\Request;


class SubteamController extends Controller
{
    public function index()
    {
        $subteams = $this->dataSource->getAllSubteams();
        return response()->json($subteams);
    }

    public function getSubteam($id)
    {
        $subteam = $this->dataSource->getSubteamById($id);
        return response()->json($subteam);
    }

    public function saveSubteam(Request $request)
    {
        $subteam = $this->dataSource->saveSubteam(new Subteam($request->all()));
        return response()->json($subteam);
    }

    public function deleteSubteam($id)
    {
        $this->dataSource->deleteSubteamById($id);
        return response()->json('success');
    }

    public function updateSubteam(Request $request, $id)
    {
        $subteam = $this->dataSource->getSubteamById($id);
        $subteam->name = $request->input('name');
        $subteam->description = $request->input('description');
        $subteam->numberofpeople = $request->input('numberofpeople');
        $subteam = $this->dataSource->saveSubteam($subteam);

        return response()->json($subteam);
    }
}