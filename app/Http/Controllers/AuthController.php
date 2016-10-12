<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 15:41
 */

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class AuthController extends Controller
{

    public function login(Request $request){
        return response()->json($request->input('username'));
    }
}