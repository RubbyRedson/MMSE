<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class ProjectTest extends TestCase
{
    /**
     * Test to get all of the clients.
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->getWithAuth('/api/project/total_cost/2');


        $this->assertEquals(
            "{\"total\":1400}", $this->response->getContent()
        );
    }
}
