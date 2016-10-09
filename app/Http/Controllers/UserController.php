<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class UserController extends BaseController
{
    public function index(){

        $users  = User::all();

        return response()->json($users);

    }

    public function getUser($id){

        $user  = User::find($id);

        return response()->json($user);
    }

    public function saveUser(Request $request){

        $user = User::create($request->all());

        return response()->json($user);

    }

    public function deleteUser($id){
        $user  = User::find($id);

        $user->delete();

        return response()->json('success');
    }

    public function updateUser(Request $request,$id){
        $user  = User::find($id);

        $user->title = $request->input('title');
        $user->description = $request->input('description');
        $user->authLevel = $request->input('authLevel');

        $user->save();

        return response()->json($user);
    }
}