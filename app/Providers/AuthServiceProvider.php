<?php

namespace App\Providers;

use App\User;
use App\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            $token = $request->header('Authorization');
            if ($token) {

                $session = Session::where('token', $token)->first();

                if($session){
                    return User::where('id', $session->user_id)->first();
                }else{
                    return null;
                }
            }else{
               return null;
            }
        });
    }
}
