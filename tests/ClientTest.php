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
     * Test to get all of the clients with authorization.
     *
     * @return void
     */
    public function testGetClients()
    {
        $validOutput = "[{\"name\":\"Pear LLC\",\"phone\":\"123123123\",\"discount\":0},{\"name\":\"AEKI\",\"phone\":\"0987654321\",\"discount\":75}]";

        $res = $this->getWithAuth('api/customer_service/client');

        $this->assertEquals($res, $validOutput);
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

        $this->assertEquals('Pear LLC', $jsonArr['name']);
        $this->assertEquals('123123123', $jsonArr['phone']);
        $this->assertEquals('0', $jsonArr['discount']);
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

        $this->assertEquals('Pear LLC 4', $jsonArr['name']);
        $this->assertEquals('1233211233', $jsonArr['phone']);
        $this->assertEquals('1', $jsonArr['discount']);
    }

    /**
     * Test to update existing client.
     *
     * @return void
     */
    public function testUpdateExisting()
    {
        $json = "{\"name\":\"Pear LLC 31\",\"phone\":\"1233211233\",\"discount\":0}";
        $response = $this->putWithAuth('/api/client/1', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals('Pear LLC 31', $jsonArr['name']);
        $this->assertEquals('1233211233', $jsonArr['phone']);
        $this->assertEquals('0', $jsonArr['discount']);
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

    /**
     * Test to get total costs of projects for a single client.
     *
     * @return void
     */
    public function testGetClientProjectSum(){
        $this->getWithAuth('api/customer_service_manager/client/2/project_sum', 2);
        $this->assertEquals("1400", $this->response->getContent());
    }
}
