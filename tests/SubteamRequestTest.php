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
        $expected = '[{"reportedBySubteam":1,"project":2,"status":1,"needMorePeople":false,"needBiggerBudget":true},' .
            '{"reportedBySubteam":2,"project":1,"status":2,"needMorePeople":false,"needBiggerBudget":true}]';
        $this->assertEquals($expected, $this->getWithAuth('/api/subteam_request'));
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
     * Test to create new subteam request.
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
     * Test to update existing subteam request.
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
     * Test to delete existing subteam request.
     *
     * @return void
     */
    public function testDeleteExisting()
    {
        $response = $this->deleteWithAuth('/api/subteam_request/1');
        $this->assertEquals('"success"', $response);
    }

    /**
     * Test to get only pending subteam requests.
     *
     * @return void
     */
    public function testGetSubteamRequestsByStatus()
    {
        $expected = '[{"id":1,"reportedBySubteam":1,"project":2,"status":1,"needMorePeople":false,'.
            '"needBiggerBudget":true,"created_at":null,"updated_at":null}]';
        $this->assertEquals($expected, $this->getWithAuth('/api/sub_team/subteam_request', 9));
    }
}


