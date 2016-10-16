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
        $json1 = "{\"name\":\"Birthday Party 3\",\"client\":1,\"description\":\"Birthday Party description 3\",\"cost\":2500,\"start\":\"2003-10-05\",\"stop\":\"2003-10-27\"}";
        $response1 = $this->postWithAuth('/api/project', $json1);
        $jsonArr1 = json_decode($response1, true);
        $id = $jsonArr1['id'];

        $json = "{\"name\":\"Birthday Party 2\",\"client\":1,\"description\":\"Birthday Party description 2\",\"cost\":1500,\"start\":\"2002-10-05\",\"stop\":\"2002-10-27\"}";
        $response = $this->putWithAuth('/api/project/'.$id, $json);
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
        $json1 = "{\"name\":\"Birthday Party 3\",\"client\":1,\"description\":\"Birthday Party description 3\",\"cost\":2500,\"start\":\"2003-10-05\",\"stop\":\"2003-10-27\"}";
        $response1 = $this->postWithAuth('/api/project', $json1);
        $jsonArr1 = json_decode($response1, true);
        $id = $jsonArr1['id'];

        $response = $this->deleteWithAuth('/api/project/'.$id);

        $this->assertEquals('"success"', $response);
    }
}
