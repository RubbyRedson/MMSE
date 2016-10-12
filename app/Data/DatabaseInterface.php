<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 08:02
 */

namespace App\Data;


use App\Client;

interface DatabaseInterface
{
    public function getAllClients();
    public function getProjects();
    public function updateClient($client);
    public function getAllSubteams();
    public function saveSubteamRequest($subteamRequest);
    public function getSubteamRequest($subteamId);
    public function collectUnreadReports($userId);
    public function findPlanningRequest($userId);
    public function findSubteamRequests($planningRequestId);
    public function savePlanningRequest($planningRequest);
}