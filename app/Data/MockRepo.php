<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 08:02
 */

namespace App\Data;


use App\Client;
use App\PlanningRequest;
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
        $client1->name ='Pear LLC';
        $client1->phone = '123123123';
        $client1->discount = 0;

        $client2 = new Client();
        $client2->name ='AEKI';
        $client2->phone = '0987654321';
        $client2->discount = 75;

        return [$client1, $client2];
    }

    public function getProjects()
    {
        $first = new Subteam();
        $first->name = 'Birthday Party';
        $first->client = 1;
        $first->description ='Birthday Party description';
        $first->cost = 500;
        $first->start = date('2001-10-05');
        $first->stop = date('2001-10-27');

        $second = new Subteam();
        $second->name = 'Fika';
        $second->client = 2;
        $second->description ='Fika description';
        $second->cost = 700;
        $second->start = date('2007-11-13');
        $second->stop = date('2007-12-27');

        $third = new Subteam();
        $third->name = 'Fika 2';
        $third->client = 2;
        $third->description ='Fika 2 description';
        $third->cost = 700;
        $third->start = date('2008-11-13');
        $third->stop = date('2008-12-27');

        return [$first, $second, $third];
    }

    public function updateClient($client)
    {
        return $client;
    }

    public function getAllSubteams()
    {
        $first = new Subteam();
        $first->name ='IT';
        $first->description = 'IT description';
        $first->numberofpeople = 7;

        $second = new Subteam();
        $second->name ='Music';
        $second->description = 'Music description';
        $second->numberofpeople = 7;

        return [$first, $second];
    }

    public function saveSubteamRequest($subteamRequest)
    {
        return $subteamRequest;
    }

    public function getSubteamRequest($subteamId)
    {
        $result = new SubteamRequest();

        $result -> reportedBySubteam = 1;
        $result -> needMorePeople = false;
        $result -> needBiggerBudget = true;

        return $result;
    }

    public function findPlanningRequest($clientId)
    {
        $result = new PlanningRequest();

        $result -> client = 1;
        $result -> feedback = 'Test feedback';

        return $result;
    }

    public function findSubteamRequests($subteamId)
    {
        $result = new SubteamRequest();

        $result -> reportedBySubteam = $subteamId;
        $result -> needMorePeople = false;
        $result -> needBiggerBudget = true;

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
        $user1->password = sha1($user1->salt ."abc123");
        $user1->username = 'Alice';
        $user1->role = $id;

        return $user1;
    }

    public function getUserByUsername($username)
    {
        $user1 = new User();
        $user1->salt = $this->salt1;
        $user1->password = sha1($user1->salt ."abc123");
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
        $role -> id = $id;
        $role -> title = 'do not know, do not care';
        $role -> auth = 999;

        switch ($id){
            case 1:
                $role->tag =  'customer_service';
                break;
            case 2:
                $role->tag =  'customer_service_manager';
                break;
            case 3:
                $role->tag =  'financial_manager';
                break;
            case 4:
                $role->tag =  'administration_manager';
                break;
            case 5:
                $role->tag =  'production_manager';
                break;
            case 6:
                $role->tag =  'hr_manager';
                break;
            case 7:
                $role->tag =  'hr_team';
                break;
            case 8:
                $role->tag =  'service_manager';
                break;
        }

        return $role;
    }

    public function getAllPlanningRequests()
    {
        $requests = "[{\"id\":4,\"client\":1,\"status\":1,\"feedback\":\"\",\"created_at\":\"2016-10-15 14:30:19\",\"updated_at\":\"2016-10-15 16:17:47\",\"description\":\"kmkmk\"},{\"id\":1,\"client\":1,\"status\":1,\"feedback\":\"Feedback for request 1\",\"created_at\":null,\"updated_at\":\"2016-10-15 16:17:41\",\"description\":\"\"}]";
        return json_decode($requests, true);
    }

    public function getPlanningRequestsByStatusId($statusId)
    {
        $requests = "[{\"id\":4,\"client\":1,\"status\":1,\"feedback\":\"\",\"created_at\":\"2016-10-15 14:30:19\",\"updated_at\":\"2016-10-15 16:17:47\",\"description\":\"kmkmk\"},{\"id\":1,\"client\":1,\"status\":1,\"feedback\":\"Feedback for request 1\",\"created_at\":null,\"updated_at\":\"2016-10-15 16:17:41\",\"description\":\"\"}]";
        return json_decode($requests, true);
    }

    public function setPlanningRequestsStatus($requestId, $statusId)
    {
        $res = "{\"id\":".$requestId.",\"client\":1,\"status\":".$statusId.",\"feedback\":\"Feedback for request 1\",\"created_at\":null,\"updated_at\":\"2016-10-16 09:21:03\",\"description\":\"\"}";

        return json_decode($res, true);
    }

    public function getPlanningRequestById($id)
    {
        $res = "{\"id\":".id.",\"client\":1,\"status\":1,\"feedback\":\"Feedback for request 1\",\"created_at\":null,\"updated_at\":\"2016-10-16 09:21:03\",\"description\":\"\"}";

        return json_decode($res, true);
    }

    public function getClientById($id)
    {
        $client1 = new Client();
        $client1->id = $id;
        $client1->name ='Pear LLC';
        $client1->phone = '123123123';
        $client1->discount = 0;
        return $client1;
    }

    public function getProjectCostSummation($clientId)
    {
        return 200;
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
}