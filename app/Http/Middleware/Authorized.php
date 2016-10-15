<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-13
 * Time: 14:18
 */

namespace app\Http\Middleware;

use App\Data\DatabaseInterface;
use Closure;
use Illuminate\Http\Request;

class Authorized
{
    protected $dataSource;

    public function __construct(DatabaseInterface $ds)
    {
        $this->dataSource = $ds;
    }

    public function handle(Request $request, Closure $next, $role_tag = null)
    {

        //Get the token from the header
        $token = $request->header('Authorization');
        $isAuthorized = false;


        //Check if there is a token
        if ($token) {

            //Get the session
            $session = $this->dataSource->getSessionByToken($token);
            if ($session) {

                //Check for a user
                $user = $this->dataSource->getUserById($session->user_id);
                if ($user) {
                    $role = $this->dataSource->getRoleById($user->role);
                    $isAuthorized = $role->tag == $role_tag;
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