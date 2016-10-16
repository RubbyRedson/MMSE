<?php

class ClientTest extends TestCase
{
    /**
     * Test to get all of the clients.
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->assertEquals(
            "[{\"name\":\"Pear LLC\",\"phone\":\"123123123\",\"discount\":0},{\"name\":\"AEKI\",\"phone\":\"0987654321\",\"discount\":75}]",
            $this->getWithAuth('/api/client')
        );
    }

    /**
     * Test to get one of the clients.
     *
     * @return void
     */
    public function testGetOne()
    {
        $response = $this->getWithAuth('/api/client/1');
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'Pear LLC');
        $this->assertEquals($jsonArr['phone'], '123321123');
        $this->assertEquals($jsonArr['discount'], '0');
    }

    /**
     * Test to create new client.
     *
     * @return void
     */
    public function testCreateNew()
    {
        $json = "{\"name\":\"Pear LLC 4\",\"phone\":\"1233211233\",\"discount\":1}";
        $response = $this->postWithAuth('/api/client', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'Pear LLC 4');
        $this->assertEquals($jsonArr['phone'], '1233211233');
        $this->assertEquals($jsonArr['discount'], '1');

        $id = $jsonArr['id'];

        $this->deleteWithAuth('/api/client/'.$id);
    }

    /**
     * Test to update existing client.
     *
     * @return void
     */
    public function testUpdateExisting()
    {
        $json1 = "{\"name\":\"Pear LLC 25\",\"phone\":\"123321123\",\"discount\":1}";
        $response1 = $this->postWithAuth('/api/client', $json1);
        $jsonArr1 = json_decode($response1, true);
        $id = $jsonArr1['id'];

        $json = "{\"name\":\"Pear LLC 31\",\"phone\":\"1233211233\",\"discount\":0}";
        $response = $this->putWithAuth('/api/client/'.$id, $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['name'], 'Pear LLC 31');
        $this->assertEquals($jsonArr['phone'], '1233211233');
        $this->assertEquals($jsonArr['discount'], '0');
    }
    /**
     * Test to delete existing client.
     *
     * @return void
     */
    public function testDeleteExisting()
    {
        $json1 = "{\"name\":\"Pear LLC 25\",\"phone\":\"123321123\",\"discount\":1}";
        $response1 = $this->postWithAuth('/api/client', $json1);
        $jsonArr1 = json_decode($response1, true);
        $id = $jsonArr1['id'];

        $response = $this->deleteWithAuth('/api/client/'.$id);

        $this->assertEquals('"success"', $response);
    }
}
