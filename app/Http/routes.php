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
        $app->post('api/customer_service/planning_request','App\Http\Controllers\PlanningRequestController@savePlanningRequest');
    });

    $app->group(['middleware' => 'authorize:customer_service_manager'], function () use ($app) {

        //To modify planning requests
        $app->get('api/customer_service_manager/planning_request','App\Http\Controllers\PlanningRequestController@getPlanningRequestForCustomerServiceManager');
        $app->get('api/customer_service_manager/finished_planning_request','App\Http\Controllers\PlanningRequestController@getFinishedPlanningRequests');
        $app->get('api/customer_service_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@getPlanningRequest');
        $app->put('api/customer_service_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@updatePlanningRequestFromCustomerServiceManager');

        //To modify projects
        $app->get('api/customer_service_manager/project','App\Http\Controllers\ProjectController@index');
        $app->get('api/customer_service_manager/project/{id}','App\Http\Controllers\ProjectController@getProject');
        $app->post('api/customer_service_manager/project','App\Http\Controllers\ProjectController@saveProject');
        $app->put('api/customer_service_manager/project/{id}','App\Http\Controllers\ProjectController@updateProject');
        $app->delete('api/customer_service_manager/project/{id}','App\Http\Controllers\ProjectController@deleteProject');

        //To work with the client, give discounts, etc
        $app->get('api/customer_service_manager/client/{id}/project_sum','App\Http\Controllers\ClientController@getProjectSum');
        $app->get('api/customer_service_manager/client/{id}','App\Http\Controllers\ClientController@getClient');
        $app->post('api/customer_service_manager/client','App\Http\Controllers\ClientController@saveClient');
        $app->put('api/customer_service_manager/client/{id}','App\Http\Controllers\ClientController@updateClient');
        $app->delete('api/customer_service_manager/client/{id}','App\Http\Controllers\ClientController@deleteClient');
    });

    $app->group(['middleware' => 'authorize:financial_manager'], function () use ($app) {
        //To modify planning requests
        $app->get('api/financial_manager/planning_request','App\Http\Controllers\PlanningRequestController@getPlanningRequestForFinancialManager');
        $app->get('api/financial_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@getPlanningRequest');
        $app->put('api/financial_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@updatePlanningRequestFromFinancialManager');

        //get resource requests
        $app->get('api/financial_manager/resource_request','App\Http\Controllers\ResourceRequestController@getFinancialRequests');

        //To modify projects, negotiations for budget with department manager
        $app->get('api/financial_manager/project','App\Http\Controllers\ProjectController@index');
        $app->get('api/financial_manager/project/{id}','App\Http\Controllers\ProjectController@getProject');
        $app->post('api/financial_manager/project','App\Http\Controllers\ProjectController@saveProject');
        $app->put('api/financial_manager/project/{id}','App\Http\Controllers\ProjectController@updateProject');
        $app->delete('api/financial_manager/project/{id}','App\Http\Controllers\ProjectController@deleteProject');

        $app->put('api/financial_manager/set_resource_request_status/{id}',
            'App\Http\Controllers\ResourceRequestController@setResourceRequestStatus');
    });

    $app->group(['middleware' => 'authorize:administration_manager'], function () use ($app) {
        //To modify planning requests
        $app->get('api/administration_manager/planning_request','App\Http\Controllers\PlanningRequestController@getPlanningRequestForAdministrationManager');
        $app->get('api/administration_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@getPlanningRequest');
        $app->put('api/administration_manager/planning_request/{id}','App\Http\Controllers\PlanningRequestController@updatePlanningRequestFromAdministrationManager');
    });

    $app->group(['middleware' => 'authorize:sub_team'], function () use ($app) {
        //To modify subteam requests for additional resources
        $app->get('api/sub_team/subteam_request','App\Http\Controllers\SubteamRequestController@getPendingSubteamRequest');
        $app->get('api/sub_team/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@getSubteamRequest');
        $app->post('api/sub_team/subteam_request','App\Http\Controllers\SubteamRequestController@saveSubteamRequest');
        $app->put('api/sub_team/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@updateSubteamRequest');
        $app->delete('api/sub_team/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@deleteSubteamRequest');
    });

    $app->group(['middleware' => 'authorize:production_manager'], function () use ($app) {

        //To send resource requests from subteams to hr team
        $app->get('api/production_manager/subteam_request','App\Http\Controllers\SubteamRequestController@index');
        $app->get('api/production_manager/subteam_request/conflict','App\Http\Controllers\SubteamRequestController@getConflictingRequest');
        $app->get('api/production_manager/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@getSubteamRequest');
        $app->post('api/production_manager/subteam_request','App\Http\Controllers\SubteamRequestController@saveSubteamRequest');
        $app->put('api/production_manager/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@updateSubteamRequest');
        $app->delete('api/production_manager/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@deleteSubteamRequest');

        //To create resource requests
        $app->post('api/production_manager/resource_request','App\Http\Controllers\ResourceRequestController@createNewRequest');


        //To modify projects, negotiations for budget
        $app->get('api/production_manager/project','App\Http\Controllers\ProjectController@index');
        $app->get('api/production_manager/project/{id}','App\Http\Controllers\ProjectController@getProject');

        $app->post('api/production_manager/project','App\Http\Controllers\ProjectController@saveProductionmanagerProject');
    });

    $app->group(['middleware' => 'authorize:hr_team'], function () use ($app) {
        //To see subteam requests
        $app->get('api/hr_team/subteam_request','App\Http\Controllers\SubteamRequestController@index');
        $app->get('api/hr_team/resource_request','App\Http\Controllers\ResourceRequestController@getHrRequests');
        $app->delete('api/hr_team/resource_request/{id}','App\Http\Controllers\ResourceRequestController@removeResourceRequestHR');
        $app->get('api/hr_team/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@getSubteamRequest');

        //To see job advertisement
        $app->get('api/hr_team/job_advertisement','App\Http\Controllers\JobAdvertisementController@index');
        $app->get('api/hr_team/job_advertisement/{id}','App\Http\Controllers\JobAdvertisementController@getJobAdvertisement');
        $app->post('api/hr_team/job_advertisement','App\Http\Controllers\JobAdvertisementController@saveJobAdvertisement');
        $app->put('api/hr_team/job_advertisement/{id}','App\Http\Controllers\JobAdvertisementController@updateJobAdvertisement');
        $app->delete('api/hr_team/job_advertisement/{id}','App\Http\Controllers\JobAdvertisementController@deleteJobAdvertisement');
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


    $app->get('api/client','App\Http\Controllers\ClientController@index');
    $app->get('api/client/{id}','App\Http\Controllers\ClientController@getClient');
    $app->post('api/client','App\Http\Controllers\ClientController@saveClient');
    $app->put('api/client/{id}','App\Http\Controllers\ClientController@updateClient');
    $app->delete('api/client/{id}','App\Http\Controllers\ClientController@deleteClient');

    $app->get('api/user','App\Http\Controllers\UserController@index');
    $app->get('api/user/{id}','App\Http\Controllers\UserController@getUser');
    $app->post('api/user','App\Http\Controllers\UserController@saveUser');
    $app->put('api/user/{id}','App\Http\Controllers\UserController@updateUser');
    $app->delete('api/user/{id}','App\Http\Controllers\UserController@deleteUser');


    $app->get('api/role','App\Http\Controllers\RoleController@index');
    $app->get('api/role/{id}','App\Http\Controllers\RoleController@getRole');
    $app->post('api/role','App\Http\Controllers\RoleController@saveRole');
    $app->put('api/role/{id}','App\Http\Controllers\RoleController@updateRole');
    $app->delete('api/role/{id}','App\Http\Controllers\RoleController@deleteRole');


    $app->get('api/project','App\Http\Controllers\ProjectController@index');
    $app->get('api/project/{id}','App\Http\Controllers\ProjectController@getProject');
    $app->post('api/project','App\Http\Controllers\ProjectController@saveProject');
    $app->put('api/project/{id}','App\Http\Controllers\ProjectController@updateProject');
    $app->delete('api/project/{id}','App\Http\Controllers\ProjectController@deleteProject');


    $app->get('api/subteam','App\Http\Controllers\SubteamController@index');
    $app->get('api/subteam/{id}','App\Http\Controllers\SubteamController@getSubteam');
    $app->post('api/subteam','App\Http\Controllers\SubteamController@saveSubteam');
    $app->put('api/subteam/{id}','App\Http\Controllers\SubteamController@updateSubteam');
    $app->delete('api/subteam/{id}','App\Http\Controllers\SubteamController@deleteSubteam');


    $app->get('api/job_advertisement','App\Http\Controllers\JobAdvertisementController@index');
    $app->get('api/job_advertisement/{id}','App\Http\Controllers\JobAdvertisementController@getJobAdvertisement');
    $app->post('api/job_advertisement','App\Http\Controllers\JobAdvertisementController@saveJobAdvertisement');
    $app->put('api/job_advertisement/{id}','App\Http\Controllers\JobAdvertisementController@updateJobAdvertisement');
    $app->delete('api/job_advertisement/{id}','App\Http\Controllers\JobAdvertisementController@deleteJobAdvertisement');


    $app->get('api/project','App\Http\Controllers\ProjectController@index');
    $app->get('api/project/{id}','App\Http\Controllers\ProjectController@getProject');
    $app->post('api/project','App\Http\Controllers\ProjectController@saveProject');
    $app->put('api/project/{id}','App\Http\Controllers\ProjectController@updateProject');
    $app->delete('api/project/{id}','App\Http\Controllers\ProjectController@deleteProject');


    $app->get('api/subteam_request','App\Http\Controllers\SubteamRequestController@index');
    $app->get('api/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@getSubteamRequest');
    $app->post('api/subteam_request','App\Http\Controllers\SubteamRequestController@saveSubteamRequest');
    $app->put('api/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@updateSubteamRequest');
    $app->delete('api/subteam_request/{id}','App\Http\Controllers\SubteamRequestController@deleteSubteamRequest');


    $app->get('api/planning_request','App\Http\Controllers\PlanningRequestController@index');
    $app->get('api/planning_request/{id}','App\Http\Controllers\PlanningRequestController@getPlanningRequest');
    $app->post('api/planning_request','App\Http\Controllers\PlanningRequestController@savePlanningRequest');
    $app->put('api/planning_request/{id}','App\Http\Controllers\PlanningRequestController@updatePlanningRequest');
    $app->delete('api/planning_request/{id}','App\Http\Controllers\PlanningRequestController@deletePlanningRequest');


    $app->get('api/selection','App\Http\Controllers\SelectionController@index');
    $app->get('api/selection/{id}','App\Http\Controllers\SelectionController@getSelection');
    $app->post('api/selection','App\Http\Controllers\SelectionController@saveSelection');
    $app->put('api/selection/{id}','App\Http\Controllers\SelectionController@updateSelection');
    $app->delete('api/selection/{id}','App\Http\Controllers\SelectionController@deleteSelection');


    $app->get('api/employee','App\Http\Controllers\EmployeeController@index');
    $app->get('api/employee/{id}','App\Http\Controllers\EmployeeController@getEmployee');
    $app->post('api/employee','App\Http\Controllers\EmployeeController@saveEmployee');
    $app->put('api/employee/{id}','App\Http\Controllers\EmployeeController@updateEmployee');
    $app->delete('api/employee/{id}','App\Http\Controllers\EmployeeController@deleteEmployee');

});
