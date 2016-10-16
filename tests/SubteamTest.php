<?php

class SubteamTest extends TestCase
{
    /**
     * Test to get all of the subteams.
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->assertEquals(
            "[{\"name\":\"IT\",\"description\":\"IT description\",\"numberofpeople\":5},{\"name\":\"Music\",\"description\":\"Music description\",\"numberofpeople\":7}]",
            $this->getWithAuth('/api/subteam')
        );
    }

    /**
     * Test to get one of the subteams.
     *
     * @return void
     */
    public function testGetOne()
    {
        $response = $this->getWithAuth('/api/subteam/1');
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'IT');
        $this->assertEquals($jsonArr['description'], 'IT description');
        $this->assertEquals($jsonArr['numberofpeople'], 5);
    }

    /**
     * Test to create new subteam.
     *
     * @return void
     */
    public function testCreateNew()
    {
        $json = "{\"name\":\"Org\",\"description\":\"Org descr\",\"numberofpeople\":1}";
        $response = $this->postWithAuth('/api/subteam', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'Org');
        $this->assertEquals($jsonArr['description'], 'Org descr');
        $this->assertEquals($jsonArr['numberofpeople'], '1');
    }

    /**
     * Test to update existing subteam.
     *
     * @return void
     */
    public function testUpdateExisting()
    {
        $json = "{\"name\":\"Org1\",\"description\":\"Org descr1\",\"numberofpeople\":12}";
        $response = $this->putWithAuth('/api/subteam/1', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'Org1');
        $this->assertEquals($jsonArr['description'], 'Org descr1');
        $this->assertEquals($jsonArr['numberofpeople'], '12');
    }
    /**
     * Test to delete existing subteam.
     *
     * @return void
     */
    public function testDeleteExisting()
    {
        $response = $this->deleteWithAuth('/api/subteam/1');
        $this->assertEquals('"success"', $response);
    }
}
