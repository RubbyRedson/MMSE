<?php

class SubteamRequestTest extends TestCase
{
    /**
     * Test to get all of the subteam requests.
     *
     * @return void
     */
    public function testGetAll()
    {
        $expected = '[{"reportedBySubteam":1,"project":2,"status":1,"needMorePeople":false,"needBiggerBudget":true},'.
            '{"reportedBySubteam":2,"project":1,"status":2,"needMorePeople":false,"needBiggerBudget":true}]';
        $this->assertEquals($expected, $this->getWithAuth('/api/subteam_request')
        );
    }
    /**
     * Test to get one of the subteam requests.
     *
     * @return void
     */
    public function testGetOne()
    {
        $response = $this->getWithAuth('/api/subteam_request/1');
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['reportedBySubteam'], 1);
        $this->assertEquals($jsonArr['project'], 2);
        $this->assertEquals($jsonArr['status'], 1);
        $this->assertEquals($jsonArr['needMorePeople'], false);
        $this->assertEquals($jsonArr['needBiggerBudget'], true);
    }

    /**
     * Test to create new subteam_request.
     *
     * @return void
     */
    public function testCreateNew()
    {
        $json = "{\"reportedBySubteam\":1,\"project\":2,\"status\":1,\"needMorePeople\":false,\"needBiggerBudget\":false}";
        $response = $this->postWithAuth('/api/subteam_request', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['reportedBySubteam'], 1);
        $this->assertEquals($jsonArr['project'], 2);
        $this->assertEquals($jsonArr['status'], 1);
        $this->assertEquals($jsonArr['needMorePeople'], false);
        $this->assertEquals($jsonArr['needBiggerBudget'], false);
    }

    /**
     * Test to update existing subteam_request.
     *
     * @return void
     */
    public function testUpdateExisting()
    {
        $json = "{\"reportedBySubteam\":1,\"project\":2,\"status\":1,\"needMorePeople\":false,\"needBiggerBudget\":false}";
        $response = $this->putWithAuth('/api/subteam_request/1', $json);

        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['reportedBySubteam'], 1);
        $this->assertEquals($jsonArr['project'], 2);
        $this->assertEquals($jsonArr['status'], 1);
        $this->assertEquals($jsonArr['needMorePeople'], false);
        $this->assertEquals($jsonArr['needBiggerBudget'], false);
    }

    /**
     * Test to delete existing subteam_request.
     *
     * @return void
     */
    public function testDeleteExisting()
    {
        $response = $this->deleteWithAuth('/api/subteam_request/1');
        $this->assertEquals('"success"', $response);
    }


    public function testGetSubteamRequestsByStatus(){
        //$app->get('api/sub_team/subteam_request'
        $this->markTestIncomplete("Need to test that only pending statuses on the subteam requests are returned");
    }
}


