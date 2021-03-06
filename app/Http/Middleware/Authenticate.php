<?php

namespace App\Http\Middleware;

use App\Data\DatabaseInterface;
use Closure;
use App\Session;
use App\User;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;
    protected  $dataSource;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(DatabaseInterface $ds, Auth $auth)
    {
        $this->dataSource = $ds;
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        //Get the token from the header
        $token = $request->header('Authorization');
        $isAuthenticated = false;

        //Check if there is a token
        if ($token) {


            //Get the session
            $session = $this->dataSource->getSessionByToken($token);

            if($session){

                //Check for a user
                $user = $this->dataSource->getUserById($session->user_id);
                if($user){

                    //Check if expired
                    $sessionTs = strtotime($session->valid_to);
                    $dateNow = new \DateTime();
                    $now = $dateNow->getTimestamp();
                    if($sessionTs < $now){
                        $session->delete();
                        return response("Token expired", 401);
                    }else{

                        //Add another hour
                        $newExpiry = new \DateTime();
                        $newExpiry->setTimestamp($now + 3600);
                        $session->valid_to = $newExpiry;
                        $session->save();
                        $isAuthenticated = true;
                    }
                }
            }
        }

        if($isAuthenticated){
            return $next($request);
        }else{
            return response("Unauthorized", 401);
        }
    }
}
