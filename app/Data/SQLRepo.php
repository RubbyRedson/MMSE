<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 08:02
 */

namespace App\Data;
use App\Client;

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

    public function collectUnreadReports($userId)
    {
        // TODO: Implement collectUnreadReports() method.
    }

    public function findPlanningRequest($userId)
    {
        // TODO: Implement findPlanningRequest() method.
    }

    public function findSubteamRequests($planningRequestId)
    {
        // TODO: Implement findSubteamRequests() method.
    }

    public function savePlanningRequest($planningRequest)
    {
        // TODO: Implement savePlanningRequest() method.
    }
}
