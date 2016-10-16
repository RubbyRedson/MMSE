<?php
/**
 * Created by PhpStorm.
 * Employee: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    public function index(){

        $employees = Employee::all();

        return response()->json($employees);

    }

    public function getEmployee($id){

        $employee  = Employee::find($id);

        return response()->json($employee);
    }

    public function saveEmployee(Request $request){

        $employee = Employee::create($request->all());

        return response()->json($employee);

    }

    public function deleteEmployee($id){
        $employee  = Employee::find($id);

        $employee->delete();

        return response()->json('success');
    }

    public function updateEmployee(Request $request,$id){
        $employee  = Employee::find($id);

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->phone = $request->input('phone');
        $employee->user_id = $request->input('user_id');

        $employee->save();

        return response()->json($employee);
    }
}