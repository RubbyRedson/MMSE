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
            "[{\"id\":1,\"name\":\"IT\",\"description\":\"IT description\",\"numberofpeople\":5,\"created_at\":null,\"updated_at\":null},{\"id\":2,\"name\":\"Music\",\"description\":\"Music description\",\"numberofpeople\":7,\"created_at\":null,\"updated_at\":null}]",
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

        $id = $jsonArr['id'];

        $this->deleteWithAuth('/api/subteam/'.$id);
    }

    /**
     * Test to update existing subteam.
     *
     * @return void
     */
    public function testUpdateExisting()
    {
        $json1 = "{\"name\":\"Org\",\"description\":\"Org descr\",\"numberofpeople\":1}";
        $response1 = $this->postWithAuth('/api/subteam', $json1);
        $jsonArr1 = json_decode($response1, true);
        $id = $jsonArr1['id'];

        $json = "{\"name\":\"Org1\",\"description\":\"Org descr1\",\"numberofpeople\":12}";
        $response = $this->putWithAuth('/api/subteam/'.$id, $json);
        $jsonArr = json_decode($response, true);
        $id1 = $jsonArr['id'];

        $this->assertEquals($jsonArr['name'], 'Org1');
        $this->assertEquals($jsonArr['description'], 'Org descr1');
        $this->assertEquals($jsonArr['numberofpeople'], '12');
        $this->deleteWithAuth('/api/subteam/'.$id1);
    }
    /**
     * Test to delete existing subteam.
     *
     * @return void
     */
    public function testDeleteExisting()
    {
        $json1 = "{\"name\":\"Org\",\"description\":\"Org descr\",\"numberofpeople\":1}";
        $response1 = $this->postWithAuth('/api/subteam', $json1);
        $jsonArr1 = json_decode($response1, true);
        $id = $jsonArr1['id'];

        $response = $this->deleteWithAuth('/api/subteam/'.$id);

        $this->assertEquals('"success"', $response);
    }
}
