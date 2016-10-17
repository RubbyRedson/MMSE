<?php

class JobAdvertisementTest extends TestCase
{
    /**
     * Test to get all of the job advertisements.
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->assertEquals(
            "[{\"id\":1,\"title\":\"IT Engineer\",\"description\":\"IT Engineer description\",\"salary\":5000,\"count\":3},".
            "{\"id\":2,\"title\":\"Music Composer\",\"description\":\"Music Composer description\",\"salary\":5500,\"count\":2}]",
            $this->getWithAuth('/api/job_advertisement')
        );
    }

    /**
     * Test to get one of the job advertisements.
     *
     * @return void
     */
    public function testGetOne()
    {
        $response = $this->getWithAuth('/api/job_advertisement/2');
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['title'], 'Music Composer');
        $this->assertEquals($jsonArr['description'], 'Music Composer description');
        $this->assertEquals($jsonArr['salary'], 5500);
        $this->assertEquals($jsonArr['count'], 2);
    }

    /**
     * Test to create new job advertisement.
     *
     * @return void
     */
    public function testCreateNew()
    {
        $json = "{\"title\":\"CEO\",\"description\":\"CEO description\",\"salary\":10000,\"count\":1}";
        $response = $this->postWithAuth('/api/job_advertisement', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals('CEO', $jsonArr['title']);
        $this->assertEquals('CEO description', $jsonArr['description']);
        $this->assertEquals('10000', $jsonArr['salary']);
        $this->assertEquals('1', $jsonArr['count']);
    }

    /**
     * Test to update existing job advertisement.
     *
     * @return void
     */
    public function testUpdateExisting()
    {
        $json = "{\"title\":\"CEO\",\"description\":\"CEO description\",\"salary\":10000,\"count\":1}";
        $response = $this->putWithAuth('/api/job_advertisement/1', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['title'], 'CEO');
        $this->assertEquals($jsonArr['description'], 'CEO description');
        $this->assertEquals($jsonArr['salary'], '10000');
        $this->assertEquals('1', $jsonArr['count']);
    }
    /**
     * Test to delete existing job advertisement.
     *
     * @return void
     */
    public function testDeleteExisting()
    {
        $response = $this->deleteWithAuth('/api/job_advertisement/1');
        $this->assertEquals('"success"', $response);
    }
}
