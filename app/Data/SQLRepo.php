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
use App\User;
use App\Session;

class SQLRepo implements DatabaseInterface
{
    public function getAllClients()
    {
        return Client::all();
    }

    public function getProjects()
    {
        // TODO: Implement getProjects() method.
    }

    public function updateClient($client)
    {
        // TODO: Implement updateClient() method.
    }

    public function getAllSubteams()
    {
        // TODO: Implement getAllSubteams() method.
    }

    public function saveSubteamRequest($subteamRequest)
    {
        // TODO: Implement saveSubteamRequest() method.
    }

    public function getSubteamRequest($subteamId)
    {
        // TODO: Implement getSubteamRequest() method.
    }

    public function findPlanningRequest($clientId)
    {
        // TODO: Implement findPlanningRequest() method.
    }

    public function findSubteamRequests($subteamId)
    {
        // TODO: Implement findSubteamRequests() method.
    }

    public function savePlanningRequest($planningRequest)
    {

        $planningRequest->save();

        return $planningRequest;
        // TODO: Implement savePlanningRequest() method.
    }

    public function getUserById($id)
    {
        return User::where('id', $id)->first();
    }
    public function getUserByUsername($username)
    {
        return User::where('username', $username)->with('role')->first();
    }

    public function createSession($userId)
    {
        //Remove old sessions
        Session::where('user_id', $userId)->delete();

        //Crete a new one
        $session = new Session();
        $session->user_id = $userId;
        $session->save();

        return $session;
    }

    public function getSessionByToken($token)
    {
        return Session::where('token', $token)->first();
    }

    public function getRoleById($id)
    {
        return Role::where('id', $id)->first();
    }
}
