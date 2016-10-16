<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 08:02
 */

namespace App\Data;




interface DatabaseInterface
{

    //Client
    public function getAllClients();
    public function getClientById($id);
    public function saveClient($client);
    public function createClient($requestData);
    public function updateClient($client);
    public function deleteClientById($id);

    //User
    public function getUserById($id);
    public function getUserByUsername($username);

    //Subteam
    public function getAllSubteams();

    //Subteam Request
    public function getAllSubteamRequests();
    public function findSubteamRequests($subteamId);
    public function getSubteamRequestById($id);
    public function getSubteamRequest($subteamId);
    public function getSubteamRequestByStatus($status);
    public function saveSubteamRequest($subteamRequest);
    public function deleteSubteamRequestById($id);

    //Planning Request
    public function findPlanningRequest($clientId);
    public function savePlanningRequest($planningRequest);
    public function getAllPlanningRequests();
    public function getPlanningRequestById($id);
    public function getPlanningRequestsByStatusId($statusId);
    public function setPlanningRequestsStatus($requestId, $statusId);
    public function deletePlanningRequestById($id);

    //Session
    public function createSession($userId);
    public function getSessionByToken($token);

    //Project
    public function getProjectCostSummation($clientId);
    public function getAllProjects();
    public function getProjectById($id);
    public function saveProject($project);
    public function deleteProjectById($id);

    //Roles
    public function getAllRoles();
    public function getRoleById($id);
    public function saveRole($role);
    public function deleteRoleById($id);
}