<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 09:11
 */

namespace app\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind('App\Data\DatabaseInterface', function ($app) {
            if(getenv('USE_MOCK') == 'true'){
                return new \App\Data\MockRepo();
            }else{
                return new \App\Data\SQLRepo();
            }
        });
    }

}