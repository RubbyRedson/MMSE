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
        $user1->role = 1;

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
        $session->user_id = 1;
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
        $role -> tag = 'customer_service';

        return $role;
    }
}