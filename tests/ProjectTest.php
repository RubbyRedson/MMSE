<?php

class ProjectTest extends TestCase
{
    /**
     * Test to get total costs of projects for a single client.
     *
     * @return void
     */
    public function testGetTotalCost()
    {
        $this->getWithAuth('/api/project/total_cost/2');
        $this->assertEquals(
            "{\"total\":1400}", $this->response->getContent()
        );
    }

    /**
     * Test to get one of the projects.
     *
     * @return void
     */
    public function testGetOne()
    {
        $response = $this->getWithAuth('/api/project/1');
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'Birthday Party');
        $this->assertEquals($jsonArr['client'], 1);
        $this->assertEquals($jsonArr['description'], 'Birthday Party description');
        $this->assertEquals($jsonArr['cost'], 500);
        $this->assertEquals($jsonArr['start'], '2001-10-05');
        $this->assertEquals($jsonArr['stop'], '2001-10-27');
    }

    /**
     * Test to create new project.
     *
     * @return void
     */
    public function testCreateNew()
    {
        $json = "{\"name\":\"Birthday Party 2\",\"client\":1,\"description\":\"Birthday Party description 2\",\"cost\":1500,\"start\":\"2002-10-05\",\"stop\":\"2002-10-27\"}";
        $response = $this->postWithAuth('/api/project', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'Birthday Party 2');
        $this->assertEquals($jsonArr['client'], 1);
        $this->assertEquals($jsonArr['description'], 'Birthday Party description 2');
        $this->assertEquals($jsonArr['cost'], 1500);
        $this->assertEquals($jsonArr['start'], '2002-10-05');
        $this->assertEquals($jsonArr['stop'], '2002-10-27');
    }

    /**
     * Test to update existing project.
     *
     * @return void
     */
    public function testUpdateExisting()
    {
        $json = "{\"name\":\"Birthday Party 2\",\"client\":1,\"description\":\"Birthday Party description 2\",\"cost\":1500,\"start\":\"2002-10-05\",\"stop\":\"2002-10-27\"}";
        $response = $this->putWithAuth('/api/project/1', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'Birthday Party 2');
        $this->assertEquals($jsonArr['client'], 1);
        $this->assertEquals($jsonArr['description'], 'Birthday Party description 2');
        $this->assertEquals($jsonArr['cost'], 1500);
        $this->assertEquals($jsonArr['start'], '2002-10-05');
        $this->assertEquals($jsonArr['stop'], '2002-10-27');
    }

    /**
     * Test to delete existing project.
     *
     * @return void
     */
    public function testDeleteExisting()
    {
        $response = $this->deleteWithAuth('/api/project/1');
        $this->assertEquals('"success"', $response);
    }
}
