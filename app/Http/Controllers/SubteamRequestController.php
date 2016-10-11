<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\SubteamRequest;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class SubteamRequestController extends BaseController
{
    public function index(){

        $subteamRequests  = SubteamRequest::all();

        return response()->json($subteamRequests);

    }

    public function getSubteamRequest($id){

        $subteamRequest  = SubteamRequest::find($id);

        return response()->json($subteamRequest);
    }

    public function saveSubteamRequest(Request $request){
        $subteamRequest = SubteamRequest::create($request->all());

        return response()->json($subteamRequest);

    }

    public function deleteSubteamRequest($id){
        $subteamRequest  = SubteamRequest::find($id);

        $subteamRequest->delete();

        return response()->json('success');
    }

    public function updateSubteamRequest(Request $request,$id){
        $subteamRequest  = SubteamRequest::find($id);

        $subteamRequest->reportedBySubteam = $request->input('reportedBySubteam');
        $subteamRequest->needMorePeople = $request->input('needMorePeople');
        $subteamRequest->needBiggerBudget = $request->input('needBiggerBudget');

        $subteamRequest->save();

        return response()->json($subteamRequest);
    }
}