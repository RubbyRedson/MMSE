<?php
/**
 * Created by PhpStorm.
 * Project: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Subteam;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class SubteamController extends Controller
{
    public function index(){

        $subteams  = Subteam::all();

        return response()->json($subteams);

    }

    public function getSubteam($id){

        $subteam  = Subteam::find($id);

        return response()->json($subteam);
    }

    public function saveSubteam(Request $request){

        $subteam = Subteam::create($request->all());

        return response()->json($subteam);

    }

    public function deleteSubteam($id){
        $subteam  = Subteam::find($id);

        $subteam->delete();

        return response()->json('success');
    }

    public function updateSubteam(Request $request,$id){
        $subteam  = Subteam::find($id);

        $subteam->name = $request->input('name');
        $subteam->description = $request->input('description');
        $subteam->numberofpeople = $request->input('numberofpeople');

        $subteam->save();

        return response()->json($subteam);
    }
}