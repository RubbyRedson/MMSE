<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
    return $app->version();
});



$app->get('api/client','ClientController@index');

$app->get('api/client/{id}','ClientController@getClient');

$app->post('api/client','ClientController@saveClient');

$app->put('api/client/{id}','ClientController@updateClient');

$app->delete('api/client/{id}','ClientController@deleteClient');