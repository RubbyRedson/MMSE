<?php

/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-16
 * Time: 10:12
 */
class PlanningRequestTest extends TestCase
{


    public function testCreatePlanningRequest()
    {

        $validInput = [
            'description' => "Some mock description",
            'client' => 1
        ];

        $res = json_decode(
            $this->postWithAuth('api/customer_service/planning_request', json_encode($validInput)),
            true);

        $this->assertEquals($res['description'], $validInput['description']);
        $this->assertEquals($res['client'], $validInput['client']);

        //It should have set the status to 1
        $this->assertArrayHasKey('status', $res);
        $this->assertEquals(1, $res['status']);
    }

    public function testServicemanagerGetPlanningRequest()
    {
        $res = json_decode(
            $this->getWithAuth('api/customer_service_manager/planning_request', 2),
            true);

        //Check the format of each request
        foreach ($res as $request) {
            $this->assertArrayHasKey('id', $request);
            $this->assertArrayHasKey('client', $request);
            $this->assertArrayHasKey('status', $request);
            $this->assertArrayHasKey('feedback', $request);

            //The service manager should only get request with this status
            $this->assertEquals(1, $request['status']);
        }
    }

    public function testUpdatePlanningRequest()
    {

        $validInput = [
            'status' => 5
        ];

        $res = json_decode(
            $this->putWithAuth('api/customer_service_manager/planning_request/1', json_encode($validInput), 2),
            true);

        //ensure format of output
        $this->assertArrayHasKey('client', $res);
        $this->assertArrayHasKey('status', $res);
        $this->assertArrayHasKey('feedback', $res);
        $this->assertArrayHasKey('description', $res);
    }

    public function testGetPendingRequestFinancialManager()
    {
        $expected = '[{"id":1,"client":1,"status":2,"feedback":"Feedback for request 1","description":'.
            '"description for request 1","proposed_budget":500},{"id":1,"client":1,"status":2,"feedback":"Feedback for request 1",'.
            '"description":"description for request 1","proposed_budget":700}]';

        $actual = $this->getWithAuth('api/financial_manager/planning_request', 3);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdateRequestFinancialManager()
    {
        $json = "{\"status\":3,\"feedback\":\"that's the stuff\"}";
        $expected = '{"id":4,"client":1,"status":3,"feedback":"that\'s the stuff","description":'.
            '"description for request 1","proposed_budget":500}';
        $actual = $this->putWithAuth('api/financial_manager/planning_request/4', $json, 3);
        $this->assertEquals($expected, $actual);
    }

    public function testIncorrectUpdateRequestFinancialManager()
    {
        $json = "{\"status\":5,\"feedback\":\"that's the stuff\"}";
        $expected = 'Bad request. You cannot set this status.';
        $actual = $this->putWithAuth('api/financial_manager/planning_request/4', $json, 3);
        $this->assertEquals($expected, $actual);
    }

    public function testGetPendingAdministrationManager()
    {
        $expected = '[{"id":1,"client":1,"status":3,"feedback":"Feedback for request 1","description":'.
            '"description for request 1","proposed_budget":500},{"id":1,"client":1,"status":3,"feedback":"Feedback for request 1",'.
            '"description":"description for request 1","proposed_budget":700}]';

        $actual = $this->getWithAuth('api/administration_manager/planning_request', 4);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdateRequestAdministrativeManager()
    {
        $json = "{\"status\":4,\"feedback\":\"that's the stuff\"}";
        $expected = '{"client":1,"status":4,"feedback":"Feedback for request 1","description":"description for request 1","proposed_budget":500}';
        $actual = $this->putWithAuth('api/administration_manager/planning_request/4', $json, 4);
        $this->assertEquals($expected, $actual);
    }

    public function testRejectRequestAdministrativeManager()
    {
        $json = "{\"status\":5,\"feedback\":\"that's the stuff\"}";
        $expected = '{"client":1,"status":5,"feedback":"Feedback for request 1","description":"description for request 1","proposed_budget":500}';
        $actual = $this->putWithAuth('api/administration_manager/planning_request/4', $json, 4);
        $this->assertEquals($expected, $actual);
    }

    public function testIncorrectUpdateRequestAdministrativeManager()
    {
        $json = "{\"status\":2,\"feedback\":\"that's the stuff\"}";
        $expected = 'Bad request. You cannot set this status.';
        $actual = $this->putWithAuth('api/administration_manager/planning_request/4', $json, 4);
        $this->assertEquals($expected, $actual);
    }

    public function testGetAllFinishedPlanningRequests()
    {
        $expected = '[{"id":1,"client":1,"status":4,"feedback":"Feedback for request 1","description":'.
            '"description for request 1","proposed_budget":500},{"id":1,"client":1,"status":4,"feedback":"Feedback for request 1",'.
            '"description":"description for request 1","proposed_budget":700},{"id":1,"client":1,"status":5,"feedback":"Feedback for request 1","description":'.
            '"description for request 1","proposed_budget":500},{"id":1,"client":1,"status":5,"feedback":"Feedback for request 1",'.
            '"description":"description for request 1","proposed_budget":700}]';

        $actual = $this->getWithAuth('api/customer_service_manager/finished_planning_request', 2);
        $this->assertEquals($expected, $actual);
    }


}