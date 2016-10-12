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

$app->post('api/user/login','AuthController@login');

$app->group(['middleware' => 'auth'], function () use ($app) {

    $app->get('api/client','App\Http\Controllers\ClientController@index');
    $app->get('api/client/{id}','ClientController@getClient');
    $app->post('api/client','ClientController@saveClient');
    $app->put('api/client/{id}','ClientController@updateClient');
    $app->delete('api/client/{id}','ClientController@deleteClient');


    $app->get('api/user','UserController@index');
    $app->get('api/user/{id}','UserController@getUser');
    $app->post('api/user','UserController@saveUser');
    $app->put('api/user/{id}','UserController@updateUser');
    $app->delete('api/user/{id}','UserController@deleteUser');


<<<<<<< HEAD
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
});
=======
$app->get('api/project','ProjectController@index');
$app->get('api/project/{id}','ProjectController@getProject');
$app->get('api/project/total_cost/{id}','ProjectController@getTotalCost');
$app->post('api/project','ProjectController@saveProject');
$app->put('api/project/{id}','ProjectController@updateProject');
$app->delete('api/project/{id}','ProjectController@deleteProject');


$app->get('api/subteam','SubteamController@index');
$app->get('api/subteam/{id}','SubteamController@getSubteam');
$app->post('api/subteam','SubteamController@saveSubteam');
$app->put('api/subteam/{id}','SubteamController@updateSubteam');
$app->delete('api/subteam/{id}','SubteamController@deleteSubteam');


$app->get('api/subteam_request','SubteamRequestController@index');
$app->get('api/subteam_request/{id}','SubteamRequestController@getSubteamRequestController');
$app->post('api/subteam_request','SubteamRequestController@saveSubteamRequestController');
$app->put('api/subteam_request/{id}','SubteamRequestController@updateSubteamRequestController');
$app->delete('api/subteam_request/{id}','SubteamRequestController@deleteSubteamRequestController');


$app->get('api/planning_request','PlanningRequestController@index');
$app->get('api/planning_request/{id}','PlanningRequestController@getPlanningRequestController');
$app->post('api/planning_request','PlanningRequestController@savePlanningRequestController');
$app->put('api/planning_request/{id}','PlanningRequestController@updatePlanningRequestController');
$app->delete('api/planning_request/{id}','PlanningRequestController@deletePlanningRequestController');


$app->get('api/selection','SelectionController@index');
$app->get('api/selection/{id}','SelectionController@getSelection');
$app->post('api/selection','SelectionController@saveSelection');
$app->put('api/selection/{id}','SelectionController@updateSelection');
$app->delete('api/selection/{id}','SelectionController@deleteSelection');


$app->get('api/employee','EmployeeController@index');
$app->get('api/employee/{id}','EmployeeController@getEmployee');
$app->post('api/employee','EmployeeController@saveEmployee');
$app->put('api/employee/{id}','EmployeeController@updateEmployee');
$app->delete('api/employee/{id}','EmployeeController@deleteEmployee');
>>>>>>> b49a7e6a51e72787c9df03954a429a3d27b81ef2
