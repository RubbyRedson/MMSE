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
        $this->assertEquals(
            "{\"id\":1,\"name\":\"Pear LLC\",\"phone\":\"123321123\",\"discount\":0,\"created_at\":null,\"updated_at\":null}",
            $this->getWithAuth('/api/client/1')
        );
    }


}
