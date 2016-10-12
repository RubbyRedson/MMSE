<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Selection;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class SelectionController extends Controller
{
    public function index(){

        $selections  = Selection::all();

        return response()->json($selections);

    }

    public function getSelection($id){

        $selection  = Selection::find($id);

        return response()->json($selection);
    }

    public function saveSelection(Request $request){
        $selection = Selection::create($request->all());

        return response()->json($selection);

    }

    public function deleteSelection($id){
        $selection  = Selection::find($id);

        $selection->delete();

        return response()->json('success');
    }

    public function updateSelection(Request $request,$id){
        $selection  = Selection::find($id);

        $selection->byUserId = $request->input('byUserId');
        $selection->selectedId = $request->input('selectedId');
        $selection->selectionType = $request->input('selectionType');

        $selection->save();

        return response()->json($selection);
    }
}