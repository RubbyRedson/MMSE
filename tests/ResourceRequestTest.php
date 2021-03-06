<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-17
 * Time: 10:38
 */

namespace tests;


use TestCase;

class ResourceRequestTest extends TestCase
{

    public function testCreateResourceRequest(){
        $json = "{\"project\":1,\"approved\":false,\"type\":\"budget\",\"proposal\":500}";
        $response = $this->postWithAuth('api/production_manager/resource_request', $json, 5);

        $jsonArr = json_decode($response, true);

        $this->assertEquals(1, $jsonArr['project']);
        $this->assertEquals(false, $jsonArr['approved']);
        $this->assertEquals("budget", $jsonArr['type']);
        $this->assertEquals(500, $jsonArr['proposal']);
    }

    public function testGetResourceRequestByTypePeople(){
        $response = $this->getWithAuth('api/hr_team/resource_request', 7);

        $jsonArr = json_decode($response, true);
        $this->assertEquals(1, $jsonArr['id']);
        $this->assertEquals(1, $jsonArr['project']);
        $this->assertEquals(false, $jsonArr['approved']);
        $this->assertEquals("people", $jsonArr['type']);
        $this->assertEquals(3, $jsonArr['proposal']);
    }

    public function testDeletePeopleResourceRequestForHR(){
        $response = $this->deleteWithAuth('api/hr_team/resource_request/2', 7);
        $this->assertEquals('"success"', $response);
    }

    public function testDeleteBudgetResourceRequestForHR(){
        $response = $this->deleteWithAuth('api/hr_team/resource_request/1', 7);
        $this->assertEquals('Unauthorized. You are not authorized to remove this resource request type.', $response);
    }

    public function testApproveBudgetResourceRequest(){
        $json = "{\"project\":1,\"approved\":1}";
        $response = $this->putWithAuth('api/financial_manager/set_resource_request_status/1', $json, 3);
        $this->assertEquals('', $response);
    }

    public function testGetFinancialRequests(){
        $response = $this->getWithAuth('api/financial_manager/resource_request', 3);

        $jsonArr = json_decode($response, true);
        $this->assertEquals(1, $jsonArr['id']);
        $this->assertEquals(1, $jsonArr['project']);
        $this->assertEquals(false, $jsonArr['approved']);
        $this->assertEquals("budget", $jsonArr['type']);
        $this->assertEquals(3, $jsonArr['proposal']);
    }
}