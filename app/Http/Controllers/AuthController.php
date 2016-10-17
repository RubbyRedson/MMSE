<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 15:41
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;



class AuthController extends Controller
{

    private function isValidUser($user, $password){
        return $user->password === sha1($user->salt .$password);
    }

    public function login(Request $request){
        $user = $this->dataSource->getUserByUsername($request->input('username'));

        if($user && $this->isValidUser($user, $request->input('password'))){
            $session =  $this->dataSource->createSession($user->id);

            $user->token = $session->token;

            return response()->json($user);
        }else{
            return response("Bad request", 400);
        }
    }
}