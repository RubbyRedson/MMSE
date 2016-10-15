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
    $app->group(['middleware' => 'authorize:customer_service'], function () use ($app) {
        $app->get('api/customer_service/client', 'App\Http\Controllers\ClientController@index');

        //To create new planning requests
        $app->post('api/customer_service/planning_request','App\Http\Controllers\PlanningRequestController@savePlanningRequestController');
    });

    $app->group(['middleware' => 'authorize:customer_service_manager'], function () use ($app) {
        //To modify planning requests
        $app->get('api/customer_service_manager/planning_request','App\Http\Controllers\PlanningRequestController@index');
        $app->get('api/customer_service_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@getPlanningRequest');
        $app->put('api/customer_service_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@updatePlanningRequest');

        //To modify projects
        $app->get('api/customer_service_manager/project','App\Http\Controllers\ProjectController@index');
        $app->get('api/customer_service_manager/project/{id}','App\Http\Controllers\ProjectController@getProject');
        $app->post('api/customer_service_manager/project','App\Http\Controllers\ProjectController@saveProject');
        $app->put('api/customer_service_manager/project/{id}','App\Http\Controllers\ProjectController@updateProject');
        $app->delete('api/customer_service_manager/project/{id}','App\Http\Controllers\ProjectController@deleteProject');

        //To work with the client, give discounts, etc
        $app->get('api/customer_service_manager/client/{id}','App\Http\Controllers\ClientController@getClient');
        $app->post('api/customer_service_manager/client','App\Http\Controllers\ClientController@saveClient');
        $app->put('api/customer_service_manager/client/{id}','App\Http\Controllers\ClientController@updateClient');
        $app->delete('api/customer_service_manager/client/{id}','App\Http\Controllers\ClientController@deleteClient');
    });

    $app->group(['middleware' => 'authorize:financial_manager'], function () use ($app) {
        //To modify planning requests
        $app->get('api/financial_manager/planning_request','App\Http\Controllers\PlanningRequestController@index');
        $app->get('api/financial_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@getPlanningRequest');
        $app->put('api/financial_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@updatePlanningRequest');

        //To modify projects, negotiations for budget with department manager
        $app->get('api/financial_manager/project','App\Http\Controllers\ProjectController@index');
        $app->get('api/financial_manager/project/{id}','App\Http\Controllers\ProjectController@getProject');
        $app->post('api/financial_manager/project','App\Http\Controllers\ProjectController@saveProject');
        $app->put('api/financial_manager/project/{id}','App\Http\Controllers\ProjectController@updateProject');
        $app->delete('api/financial_manager/project/{id}','App\Http\Controllers\ProjectController@deleteProject');
    });

    $app->group(['middleware' => 'authorize:administration_manager'], function () use ($app) {
        //To modify planning requests
        $app->get('api/administration_manager/planning_request','App\Http\Controllers\PlanningRequestController@index');
        $app->get('api/administration_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@getPlanningRequest');
        $app->put('api/administration_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@updatePlanningRequest');
    });

    $app->group(['middleware' => 'authorize:sub_team'], function () use ($app) {
        //To modify subteam requests for additional resources
        $app->get('api/sub_team/subteam_request','App\Http\Controllers\SubteamRequestController@index');
        $app->get('api/sub_team/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@getSubteamRequest');
        $app->post('api/sub_team/subteam_request','App\Http\Controllers\SubteamRequestController@saveSubteamRequest');
        $app->put('api/sub_team/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@updateSubteamRequest');
        $app->delete('api/sub_team/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@deleteSubteamRequest');
    });

    $app->group(['middleware' => 'authorize:production_manager'], function () use ($app) {
        //To send resource requests from subteams to hr team
        $app->get('api/production_manager/subteam_request','App\Http\Controllers\SubteamRequestController@index');
        $app->get('api/production_manager/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@getSubteamRequest');
        $app->post('api/production_manager/subteam_request','App\Http\Controllers\SubteamRequestController@saveSubteamRequest');
        $app->put('api/production_manager/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@updateSubteamRequest');
        $app->delete('api/production_manager/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@deleteSubteamRequest');

        //To modify projects, negotiations for budget
        $app->get('api/production_manager/project','App\Http\Controllers\ProjectController@index');
        $app->get('api/production_manager/project/{id}','App\Http\Controllers\ProjectController@getProject');
    });

    $app->group(['middleware' => 'authorize:hr_team'], function () use ($app) {
        //To see subteam requests
        $app->get('api/hr_team/subteam_request','App\Http\Controllers\SubteamRequestController@index');
        $app->get('api/hr_team/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@getSubteamRequest');
    });

    $app->group(['middleware' => 'authorize:administration_department'], function () use ($app) {
        //To modify projects, negotiations for budget with financial department
        $app->get('api/administration_department/project','App\Http\Controllers\ProjectController@index');
        $app->get('api/administration_department/project/{id}','App\Http\Controllers\ProjectController@getProject');
    });

    $app->group(['middleware' => 'authorize:financial_department'], function () use ($app) {
        //To modify projects, negotiations for budget from administration department
        $app->get('api/financial_department/project','App\Http\Controllers\ProjectController@index');
        $app->get('api/financial_department/project/{id}','App\Http\Controllers\ProjectController@getProject');
        $app->post('api/financial_department/project','App\Http\Controllers\ProjectController@saveProject');
        $app->put('api/financial_department/project/{id}','App\Http\Controllers\ProjectController@updateProject');
        $app->delete('api/financial_department/project/{id}','App\Http\Controllers\ProjectController@deleteProject');
    });


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
    $app->get('api/subteam_request/{id}','SubteamRequestController@getSubteamRequest');
    $app->post('api/subteam_request','SubteamRequestController@saveSubteamRequest');
    $app->put('api/subteam_request/{id}','SubteamRequestController@updateSubteamRequest');
    $app->delete('api/subteam_request/{id}','SubteamRequestController@deleteSubteamRequest');


    $app->get('api/planning_request','PlanningRequestController@index');
    $app->get('api/planning_request/{id}','PlanningRequestController@getPlanningRequest');
    $app->post('api/planning_request','PlanningRequestController@savePlanningRequest');
    $app->put('api/planning_request/{id}','PlanningRequestController@updatePlanningRequest');
    $app->delete('api/planning_request/{id}','PlanningRequestController@deletePlanningRequest');


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

});
