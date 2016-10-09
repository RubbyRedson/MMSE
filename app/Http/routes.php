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


$app->get('api/user','UserController@index');
$app->get('api/user/{id}','UserController@getUser');
$app->post('api/user','UserController@saveUser');
$app->put('api/user/{id}','UserController@updateUser');
$app->delete('api/user/{id}','UserController@deleteUser');


$app->get('api/role','RoleController@index');
$app->get('api/role/{id}','RoleController@getRole');
$app->post('api/role','RoleController@saveRole');
$app->put('api/role/{id}','RoleController@updateRole');
$app->delete('api/role/{id}','RoleController@deleteRole');


$app->get('api/project','ProjectController@index');
$app->get('api/project/{id}','ProjectController@getProject');
$app->post('api/project','ProjectController@saveProject');
$app->put('api/project/{id}','ProjectController@updateProject');
$app->delete('api/project/{id}','ProjectController@deleteProject');


$app->get('api/subteam','SubteamController@index');
$app->get('api/subteam/{id}','SubteamController@getSubteam');
$app->post('api/subteam','SubteamController@saveSubteam');
$app->put('api/subteam/{id}','SubteamController@updateSubteam');
$app->delete('api/subteam/{id}','SubteamController@deleteSubteam');