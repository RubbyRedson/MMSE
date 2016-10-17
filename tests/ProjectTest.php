<?php

class ProjectTest extends TestCase
{
    /**
     * Test to get one of the projects.
     *
     * @return void
     */
    public function testGetOne()
    {
        $response = $this->getWithAuth('/api/project/1');
        $jsonArr = json_decode($response, true);

        $this->assertEquals('Birthday Party', $jsonArr['name']);
        $this->assertEquals(1, $jsonArr['client']);
        $this->assertEquals('Birthday Party description', $jsonArr['description']);
        $this->assertEquals(500, $jsonArr['cost']);
        $this->assertEquals('2001-10-05', $jsonArr['start']);
        $this->assertEquals('2001-10-27', $jsonArr['stop']);
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

        $this->assertEquals('Birthday Party 2', $jsonArr['name']);
        $this->assertEquals(1, $jsonArr['client']);
        $this->assertEquals('Birthday Party description 2', $jsonArr['description']);
        $this->assertEquals(1500, $jsonArr['cost']);
        $this->assertEquals('2002-10-05', $jsonArr['start']);
        $this->assertEquals('2002-10-27', $jsonArr['stop']);
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

        $this->assertEquals('Birthday Party 2', $jsonArr['name']);
        $this->assertEquals(1, $jsonArr['client']);
        $this->assertEquals('Birthday Party description 2', $jsonArr['description']);
        $this->assertEquals(1500, $jsonArr['cost']);
        $this->assertEquals('2002-10-05', $jsonArr['start']);
        $this->assertEquals('2002-10-27', $jsonArr['stop']);
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
