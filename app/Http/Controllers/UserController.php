<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class UserController extends Controller
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

        $user->title = $request->input('name');
        $user->description = $request->input('password');
        $user->auth = $request->input('role');

        $user->save();

        return response()->json($user);
    }
}