<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 08:02
 */

namespace App\Data;


use App\Client;
use App\JobAdvertisement;
use App\PlanningRequest;
use App\Project;
use App\ResourceRequest;
use App\Role;
use App\Session;
use App\Subteam;
use App\SubteamRequest;
use App\User;

class MockRepo implements DatabaseInterface
{
    private $salt1;

    public function __construct()
    {
        $this->salt1 = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
    }

    public function getAllClients()
    {
        $client1 = new Client();
        $client1->name = 'Pear LLC';
        $client1->phone = '123123123';
        $client1->discount = 0;

        $client2 = new Client();
        $client2->name = 'AEKI';
        $client2->phone = '0987654321';
        $client2->discount = 75;

        return [$client1, $client2];
    }

    public function getAllProjects()
    {
        $first = new Project();
        $first->name = 'Birthday Party';
        $first->client = 1;
        $first->description = 'Birthday Party description';
        $first->cost = 500;
        $first->start = date('2001-10-05');
        $first->stop = date('2001-10-27');

        $second = new Project();
        $second->name = 'Fika';
        $second->client = 2;
        $second->description = 'Fika description';
        $second->cost = 700;
        $second->start = date('2007-11-13');
        $second->stop = date('2007-12-27');

        $third = new Project();
        $third->name = 'Fika 2';
        $third->client = 2;
        $third->description = 'Fika 2 description';
        $third->cost = 700;
        $third->start = date('2008-11-13');
        $third->stop = date('2008-12-27');

        return [$first, $second, $third];
    }

    public function updateClient($client)
    {
        return $client;
    }

    public function saveSubteamRequest($subteamRequest)
    {
        return $subteamRequest;
    }

    public function getSubteamRequest($subteamId)
    {
        $result = new SubteamRequest();

        $result->reportedBySubteam = 1;
        $result->needMorePeople = false;
        $result->needBiggerBudget = true;

        return $result;
    }

    public function findPlanningRequest($clientId)
    {
        $result = new PlanningRequest();

        $result->client = 1;
        $result->feedback = 'Test feedback';

        return $result;
    }

    public function findSubteamRequests($subteamId)
    {
        $result = new SubteamRequest();

        $result->reportedBySubteam = $subteamId;
        $result->needMorePeople = false;
        $result->needBiggerBudget = true;

        return $result;
    }

    public function savePlanningRequest($planningRequest)
    {
        return $planningRequest;
    }

    public function getUserById($id)
    {
        $user1 = new User();
        $user1->id = $id;
        $user1->salt = $this->salt1;
        $user1->password = sha1($user1->salt . "abc123");
        $user1->username = 'Alice';
        $user1->role = $id;

        return $user1;
    }

    public function getUserByUsername($username)
    {
        $user1 = new User();
        $user1->salt = $this->salt1;
        $user1->password = sha1($user1->salt . "abc123");
        $user1->username = $username;
        $user1->role = 1;

        return $user1;
    }

    public function createSession($userId)
    {
        $session = new Session();
        $session->user_id = $userId;
        return $session;
    }

    public function getSessionByToken($token)
    {
        $session = new Session();
        $session->user_id = $token;
        $session->token = $token;
        $newExpiry = new \DateTime();
        $newExpiry->setTimestamp((new \DateTime())->getTimestamp() + 3600);
        $session->valid_to = $newExpiry->format('Y-m-d H:i:s');
        return $session;
    }

    public function getRoleById($id)
    {
        $role = new Role();
        $role->id = $id;
        $role->title = 'do not know, do not care';
        $role->auth = 1;

        switch ($id) {
            case 1:
                $role->title = 'Customer Service';
                $role->description = 'Customer Service description';
                $role->tag = 'customer_service';
                break;
            case 2:
                $role->tag = 'customer_service_manager';
                break;
            case 3:
                $role->tag = 'financial_manager';
                break;
            case 4:
                $role->tag = 'administration_manager';
                break;
            case 5:
                $role->tag = 'production_manager';
                break;
            case 6:
                $role->tag = 'hr_manager';
                break;
            case 7:
                $role->tag = 'hr_team';
                break;
            case 8:
                $role->tag = 'service_manager';
                break;
            case 9:
                $role->tag = 'sub_team';
                break;
        }

        return $role;
    }

    public function getAllPlanningRequests()
    {
        $res =  new PlanningRequest();
        $res->id = 1;
        $res->client = 1;
        $res->status = 1;
        $res->feedback = "Feedback for request 1";
        $res->description = "description for request 1";
        $res->proposed_budget = 500;

        $res1 =  new PlanningRequest();
        $res1->id = 1;
        $res1->client = 1;
        $res1->status = 1;
        $res1->feedback = "Feedback for request 1";
        $res1->description = "description for request 1";
        $res->proposed_budget = 700;

        return [$res, $res1];
    }

    public function getPlanningRequestsByStatusId($statusId)
    {
        $res =  new PlanningRequest();
        $res->id = 1;
        $res->client = 1;
        $res->status = $statusId;
        $res->feedback = "Feedback for request 1";
        $res->description = "description for request 1";
        $res->proposed_budget = 500;

        $res1 =  new PlanningRequest();
        $res1->id = 1;
        $res1->client = 1;
        $res1->status = $statusId;
        $res1->feedback = "Feedback for request 1";
        $res1->description = "description for request 1";
        $res1->proposed_budget = 700;

        return [$res, $res1];
    }

    public function setPlanningRequestsStatus($requestId, $statusId)
    {
        $res =  new PlanningRequest();
        $res->id = $requestId;
        $res->client = 1;
        $res->status = $statusId;
        $res->feedback = "Feedback for request 1";
        $res->description = "description for request 1";
        $res->proposed_budget = 500;

        return new PlanningRequest(json_decode($res, true));
    }

    public function getPlanningRequestById($id)
    {
        $res =  new PlanningRequest();
        $res->id = $id;
        $res->client = 1;
        $res->status = 1;
        $res->feedback = "Feedback for request 1";
        $res->description = "description for request 1";
        $res->proposed_budget = 500;

        return $res;
    }

    public function getClientById($id)
    {
        $client1 = new Client();
        $client1->id = $id;
        $client1->name = 'Pear LLC';
        $client1->phone = '123123123';
        $client1->discount = 0;
        return $client1;
    }

    public function getProjectCostSummation($clientId)
    {
        return 1400;
    }

    public function saveClient($client)
    {
        return $client;
    }

    public function createClient($requestData)
    {
        $client1 = new Client();
        $client1->id = 1;
        $client1->name = $requestData['name'];
        $client1->phone = $requestData['phone'];
        $client1->discount = $requestData['discount'];

        return $client1;
    }

    public function deleteClientById($id)
    {
        // do nothing
    }

    public function deletePlanningRequestById($id)
    {
        // do nothing
    }

    public function getProjectById($id)
    {
        switch ($id) {
            case 1:
                $first = new Project();
                $first->name = 'Birthday Party';
                $first->client = 1;
                $first->description = 'Birthday Party description';
                $first->cost = 500;
                $first->start = date('2001-10-05');
                $first->stop = date('2001-10-27');
                return $first;
                break;
            case 2:
                $second = new Project();
                $second->name = 'Fika';
                $second->client = 2;
                $second->description = 'Fika description';
                $second->cost = 700;
                $second->start = date('2007-11-13');
                $second->stop = date('2007-12-27');
                return $second;
                break;
            case 3:
                $third = new Project();
                $third->name = 'Fika 2';
                $third->client = 2;
                $third->description = 'Fika 2 description';
                $third->cost = 700;
                $third->start = date('2008-11-13');
                $third->stop = date('2008-12-27');
                return $third;
                break;
        }
    }

    public function saveProject($project)
    {
        return $project;
    }

    public function getSubteamRequestByStatus($status)
    {
        $second = new SubteamRequest();
        $second->id = 2;
        $second->reportedBySubteam = 2;
        $second->project = 1;
        $second->status = $status;
        $second->needMorePeople = false;
        $second->needBiggerBudget = true;
        return [$second];
    }

    public function deleteProjectById($id)
    {
        // do nothing
    }

    public function getAllRoles()
    {
        $customer_service = new Role();
        $customer_service->title = 'Customer service';
        $customer_service->description = 'Description of Customer service';
        $customer_service->auth = 1;
        $customer_service->tag = 'customer_service';

        $customer_service_manager = new Role();
        $customer_service_manager->title = 'Customer service manager';
        $customer_service_manager->description = 'Description of Customer service manager';
        $customer_service_manager->auth = 2;
        $customer_service_manager->tag = 'customer_service_manager';

        $financial_manager = new Role();
        $financial_manager->title = 'Financial manager';
        $financial_manager->description = 'Description of Financial manager';
        $financial_manager->auth = 3;
        $financial_manager->tag = 'financial_manager';

        $administration_manager = new Role();
        $administration_manager->title = 'Administration manager';
        $administration_manager->description = 'Description of Administration manager';
        $administration_manager->auth = 4;
        $administration_manager->tag = 'administration_manager';

        $production_manager = new Role();
        $production_manager->title = 'Production manager';
        $production_manager->description = 'Description of Production manager';
        $production_manager->auth = 5;
        $production_manager->tag = 'production_manager';

        $hr_manager = new Role();
        $hr_manager->title = 'HR manager';
        $hr_manager->description = 'Description of HR manager';
        $hr_manager->auth = 6;
        $hr_manager->tag = 'hr_manager';

        $hr_team = new Role();
        $hr_team->title = 'HR team';
        $hr_team->description = 'Description of HR team';
        $hr_team->auth = 7;
        $hr_team->tag = 'hr_team';

        $service_manager = new Role();
        $service_manager->title = 'Service manager';
        $service_manager->description = 'Description of Service manager';
        $service_manager->auth = 8;
        $service_manager->tag = 'service_manager';

        $sub_team = new Role();
        $sub_team->title = 'Sub-team';
        $sub_team->description = 'Description of Sub-team';
        $sub_team->auth = 9;
        $sub_team->tag = 'sub_team';

        $vice_president = new Role();
        $vice_president->title = 'Vice-president';
        $vice_president->description = 'Description of Vice-president';
        $vice_president->auth = 10;
        $vice_president->tag = 'vice_president';

        $financial_department = new Role();
        $financial_department->title = 'Financial department';
        $financial_department->description = 'Description of Financial department';
        $financial_department->auth = 11;
        $financial_department->tag = 'financial_department';

        $administration_department = new Role();
        $administration_department->title = 'Administration department';
        $administration_department->description = 'Description of Administration department';
        $administration_department->auth = 12;
        $administration_department->tag = 'administration_department';

        return [$customer_service, $customer_service_manager, $financial_manager, $administration_manager, $production_manager,
            $hr_manager, $hr_team, $service_manager, $sub_team, $vice_president, $financial_department, $administration_department];
    }

    public function saveRole($role)
    {
        return $role;
    }

    public function deleteRoleById($id)
    {
        // do nothing
    }

    public function getSubteamRequestById($id)
    {
        switch ($id) {
            case 1:

                $first = new SubteamRequest();
                $first->reportedBySubteam = 1;
                $first->project = 2;
                $first->status = 1;
                $first->needMorePeople = false;
                $first->needBiggerBudget = true;
                return $first;
                break;
            case 2:
                $second = new SubteamRequest();
                $second->reportedBySubteam = 2;
                $second->project = 1;
                $second->status = 2;
                $second->needMorePeople = false;
                $second->needBiggerBudget = true;
                return $second;
                break;
        }
    }

    public function deleteSubteamRequestById($id)
    {
        // do nothing
    }

    public function getAllSubteamRequests()
    {
        $first = new SubteamRequest();
        $first->reportedBySubteam = 1;
        $first->project = 2;
        $first->status = 1;
        $first->needMorePeople = false;
        $first->needBiggerBudget = true;

        $second = new SubteamRequest();
        $second->reportedBySubteam = 2;
        $second->project = 1;
        $second->status = 1;
        $second->needMorePeople = false;
        $second->needBiggerBudget = true;

        return [$first, $second];
    }

    public function getAllSubteams()
    {
        $first = new Subteam();
        $first->name = 'IT';
        $first->description = 'IT description';
        $first->numberofpeople = 5;

        $second = new Subteam();
        $second->name = 'Music';
        $second->description = 'Music description';
        $second->numberofpeople = 7;

        return [$first, $second];
    }

    public function getSubteamById($id)
    {
        switch ($id) {
            case 1:
                $first = new Subteam();
                $first->name = 'IT';
                $first->description = 'IT description';
                $first->numberofpeople = 5;
                return $first;
                break;
            case 2:
                $second = new Subteam();
                $second->name = 'Music';
                $second->description = 'Music description';
                $second->numberofpeople = 7;
                return $second;
                break;
        }
    }

    public function saveSubteam($subteam)
    {
        return $subteam;
    }

    public function deleteSubteamById($id)
    {
        // do nothing
    }

    public function getConflictingSubteamRequests()
    {
        $first = new SubteamRequest();
        $first->id = 3;
        $first->reportedBySubteam = 1;
        $first->project = 2;
        $first->status = 1;
        $first->needMorePeople = true;
        $first->needBiggerBudget = false;

        $second = new SubteamRequest();
        $first->id = 4;
        $second->reportedBySubteam = 2;
        $second->project = 1;
        $second->status = 1;
        $second->needMorePeople = false;
        $second->needBiggerBudget = true;

        return [$first, $second];
    }

    public function getResourceRequestById($id)
    {
        switch ($id) {
            case 1:
                $first = new ResourceRequest();
                $first->id = 1;
                $first->project = 1;
                $first->approved = false;
                $first->type = 'budget';
                $first->proposal = 3;
                return $first;
                break;
            case 2:
                $first = new ResourceRequest();
                $first->id = 2;
                $first->project = 1;
                $first->approved = false;
                $first->type = 'people';
                $first->proposal = 3;
                return $first;
                break;
        }
    }

    public function deleteResourceRequestById($id)
    {
        // do nothing
    }

    public function createResourceRequest($data)
    {
        $first = new ResourceRequest($data);
        return $first;
    }

    public function getResourceRequestByType($type)
    {
        $first = new ResourceRequest();
        $first->id = 1;
        $first->project = 1;
        $first->approved = false;
        $first->type = $type;
        $first->proposal = 3;
        return $first;
    }

    public function getAllJobAdvertisements()
    {
        $first = new JobAdvertisement();
        $first->id = 1;
        $first->title = 'IT Engineer';
        $first->description = 'IT Engineer description';
        $first->salary = 5000;
        $first->count = 3;

        $second = new JobAdvertisement();
        $second->id = 2;
        $second->title = 'Music Composer';
        $second->description = 'Music Composer description';
        $second->salary = 5500;
        $second->count = 2;

        return [$first, $second];
    }

    public function getJobAdvertisementById($id)
    {
        $second = new JobAdvertisement();
        $second->id = $id;
        $second->title = 'Music Composer';
        $second->description = 'Music Composer description';
        $second->salary = 5500;
        $second->count = 2;

        return $second;
    }

    public function saveJobAdvertisement($jobAdvertisement)
    {
        return $jobAdvertisement;
    }

    public function deleteJobAdvertisementById($id)
    {
        // do nothing
    }
}