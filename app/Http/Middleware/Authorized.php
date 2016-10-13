<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-13
 * Time: 14:18
 */

namespace app\Http\Middleware;

use App\Role;
use Closure;
use App\Session;
use App\User;

class Authorized
{
    public function handle($request, Closure $next, $role_tag = null)
    {

        //Get the token from the header
        $token = $request->header('Authorization');
        $isAuthorized = false;


        //Check if there is a token
        if ($token) {

            //Get the session
            $session = Session::where('token', $token)->first();
            if ($session) {

                //Check for a user
                $user = User::where('id', $session->user_id)->first();
                if ($user) {
                    $role = Role::where('id', $user->role)->first();
                    $isAuthorized =  $role->tag == $role_tag;
                }
            }
        }

        if($isAuthorized){
            return $next($request);
        }else{
            return response("Unauthorized", 401);
        }

    }
}