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
            $this->app->version(), $this->response->getContent()
        );
    }
}
