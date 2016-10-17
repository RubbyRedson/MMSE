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
use App\Subteam;
use App\SubteamRequest;
use App\User;
use App\Session;

class SQLRepo implements DatabaseInterface
{
    public function getAllClients()
    {
        return Client::all();
    }

    public function getAllProjects()
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
        $subteamRequest->save();
        return $subteamRequest;
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

    public function getAllPlanningRequests()
    {
        return PlanningRequest::all();
    }

    public function getPlanningRequestsByStatusId($statusId)
    {
        return PlanningRequest::where('status', $statusId)->orderBy('updated_at', 'DESC')->get();
    }

    public function setPlanningRequestsStatus($requestId, $statusId)
    {
        $req = PlanningRequest::where('id', $requestId)->first();
        $req->status = $statusId;
        $req->save();

        return $req;
    }

    public function getPlanningRequestById($id)
    {
        return PlanningRequest::find($id);
    }

    public function getClientById($id)
    {
        return Client::find($id);
    }

    public function getProjectCostSummation($clientId)
    {
        return Project::where('client', $clientId)->sum('cost');
    }

    public function saveClient($client)
    {
        $client->save();
        return $client;
    }

    public function createClient($requestData)
    {
        return Client::create($requestData);
    }

    public function deleteClientById($id)
    {
        return Client::find($id)->delete();
    }

    public function deletePlanningRequestById($id)
    {
        return PlanningRequest::find($id)->delete();
    }

    public function getProjectById($id)
    {
        return Project::find($id);
    }

    public function saveProject($project)
    {
        $project->save();
        return $project;
    }

    public function deleteProjectById($id)
    {
        return Project::find($id)->delete();
    }

    public function getAllRoles()
    {
        return Role::all();
    }

    public function saveRole($role)
    {
        $role->save();
        return $role;
    }

    public function deleteRoleById($id)
    {
        return Role::find($id)->delete();
    }

    public function getSubteamRequestById($id)
    {
        return SubteamRequest::find($id);
    }

    public function deleteSubteamRequestById($id)
    {
        return SubteamRequest::find($id)->delete();
    }

    public function getAllSubteamRequests()
    {
        return SubteamRequest::all();
    }

    public function getSubteamRequestByStatus($status)
    {
        return SubteamRequest::where('status', $status)->get();
    }

    public function getSubteamById($id)
    {
        return Subteam::find($id);
    }

    public function saveSubteam($subteam)
    {
        $subteam->save();
        return $subteam;
    }

    public function deleteSubteamById($id)
    {
        return Subteam::find($id)->delete();
    }

    public function getConflictingSubteamRequests()
    {
        return SubteamRequest::where('status', 1)
            ->where(function($query){
                $query->where('needMorePeople', 1)->orWhere('needBiggerBudget', 1);
            })->get();
    }

    public function createResourceRequest($data)
    {
        return ResourceRequest::create($data);
    }

    public function getAllJobAdvertisements()
    {
        return JobAdvertisement::all();
    }

    public function getJobAdvertisementById($id)
    {
        return JobAdvertisement::find($id);
    }

    public function saveJobAdvertisement($jobAdvertisement)
    {
        $jobAdvertisement->save();
        return $jobAdvertisement;
    }

    public function deleteJobAdvertisementById($id)
    {
        return JobAdvertisement::find($id)->delete();
    }
}
