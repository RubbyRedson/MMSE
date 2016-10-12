<?php
/**
 * Created by PhpStorm.
 * Role: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Role;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function index(){

        $roles  = Role::all();

        return response()->json($roles);

    }

    public function getRole($id){

        $role  = Role::find($id);

        return response()->json($role);
    }

    public function saveRole(Request $request){

        $role = Role::create($request->all());

        return response()->json($role);

    }

    public function deleteRole($id){
        $role  = Role::find($id);

        $role->delete();

        return response()->json('success');
    }

    public function updateRole(Request $request,$id){
        $role  = Role::find($id);
        $role->name = $request->input('title');
        $role->password = $request->input('description');
        $role->role = $request->input('auth');
        $role->save();

        return response()->json($role);
    }
}