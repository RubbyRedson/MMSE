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
use App\Subteam;
use App\SubteamRequest;

class MockRepo implements DatabaseInterface
{

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

        return [$first, $second];
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
}