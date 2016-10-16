<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\SubteamRequest;
use Illuminate\Http\Request;


class SubteamRequestController extends Controller
{
    public function index(){
        $subteamRequests = $this->dataSource->getAllSubteamRequests();
        return response()->json($subteamRequests);
    }

    function getPendingSubteamRequest(){
        return $this->dataSource->getSubteamRequestByStatus(1);
    }

    public function getSubteamRequest($id){
        $subteamRequest = $this->dataSource->getSubteamRequestById($id);
        return response()->json($subteamRequest);
    }

    public function saveSubteamRequest(Request $request){
        $subteamRequest = $this->dataSource->saveSubteamRequest(new SubteamRequest($request->all()));
        return response()->json($subteamRequest);
    }

    public function deleteSubteamRequest($id){
        $this->dataSource->deleteSubteamRequestById($id);
        return response()->json('success');
    }

    public function updateSubteamRequest(Request $request,$id){
        $subteamRequest = $this->dataSource->getSubteamRequestById($id);
        $subteamRequest->reportedBySubteam = $request->input('reportedBySubteam');
        $subteamRequest->project = $request->input('project');
        $subteamRequest->status = $request->input('status');
        $subteamRequest->needMorePeople = $request->input('needMorePeople');
        $subteamRequest->needBiggerBudget = $request->input('needBiggerBudget');
        $subteamRequest = $this->dataSource->saveSubteamRequest($subteamRequest);
        return response()->json($subteamRequest);
    }
}