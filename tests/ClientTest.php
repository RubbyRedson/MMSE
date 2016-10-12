<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ClientTest extends TestCase
{
    /**
     * Test to get all of the clients.
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->get('/api/client');


        $this->assertEquals(
            "[{\"id\":1,\"name\":\"Pear LLC\",\"phone\":\"123321123\",\"discount\":0,\"created_at\":null,\"updated_at\""
        .":null},{\"id\":2,\"name\":\"AEKI\",\"phone\":\"0987654321\",\"discount\":75,\"created_at\":null,\"updated_at\""
        .":null}]", $this->response->getContent()
        );
    }
}
