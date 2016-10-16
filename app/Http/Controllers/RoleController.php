<?php
/**
 * Created by PhpStorm.
 * Role: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function index(){

        $roles = $this->dataSource->getAllRoles();

        return response()->json($roles);

    }

    public function getRole($id){

        $role = $this->dataSource->getRoleById($id);

        return response()->json($role);
    }

    public function saveRole(Request $request){

        $role = $this->dataSource->saveRole(new Role($request->all()));

        return response()->json($role);

    }

    public function deleteRole($id){
        $this->dataSource->deleteRoleById($id);
        return response()->json('success');
    }

    public function updateRole(Request $request,$id){
        $role = $this->dataSource->getRoleById($id);
        $role->title = $request->input('title');
        $role->description = $request->input('description');
        $role->auth = $request->input('auth');
        $role->tag = $request->input('tag');
        $role = $this->dataSource->saveRole($role);

        return response()->json($role);
    }
}