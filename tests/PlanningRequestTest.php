<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-16
 * Time: 10:12
 */



class PlanningRequestTest extends TestCase
{

    public function testGetClients(){
        $validOutput = "[{\"name\":\"Pear LLC\",\"phone\":\"123123123\",\"discount\":0},{\"name\":\"AEKI\",\"phone\":\"0987654321\",\"discount\":75}]";

        $res = $this->getWithAuth('api/customer_service/client');

        $this->assertEquals($res, $validOutput);
    }

    public function testCreatePlanningRequest(){

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

    public function testServicemanagerGetPlanningRequest(){
        $res = json_decode(
            $this->getWithAuth('api/customer_service_manager/planning_request', 2),
            true);

        //Check the format of each request
        foreach ($res as $request){
            $this->assertArrayHasKey('id', $request);
            $this->assertArrayHasKey('client', $request);
            $this->assertArrayHasKey('status', $request);
            $this->assertArrayHasKey('feedback', $request);

            //The service manager should only get request with this status
            $this->assertEquals(1, $request['status']);
        }
    }

    public function testUpdatePlanningRequest(){

        $validInput = [
            'status' => 5
        ];

        $res = json_decode(
            $this->putWithAuth('api/customer_service_manager/planning_request/1', json_encode($validInput), 2),
            true);

        //ensure format of output
        $this->assertArrayHasKey('id', $res);
        $this->assertArrayHasKey('client', $res);
        $this->assertArrayHasKey('status', $res);
        $this->assertArrayHasKey('feedback', $res);
        $this->assertArrayHasKey('description', $res);
    }

    

}