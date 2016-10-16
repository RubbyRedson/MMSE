<?php

class RoleTest extends TestCase
{
    /**
     * Test to get all of the roles.
     *
     * @return void
     */
    public function testGetAll()
    {
        $expected = '[{"title":"Customer service","description":"Description of Customer service","auth":1,"tag":'.
            '"customer_service"},{"title":"Customer service manager","description":"Description of Customer service'.
            ' manager","auth":2,"tag":"customer_service_manager"},{"title":"Financial manager","description":'.
            '"Description of Financial manager","auth":3,"tag":"financial_manager"},{"title":"Administration '.
            'manager","description":"Description of Administration manager","auth":4,"tag":"administration_manager"}'.
            ',{"title":"Production manager","description":"Description of Production manager","auth":5,"tag":'.
            '"production_manager"},{"title":"HR manager","description":"Description of HR manager","auth":6,"tag":'.
            '"hr_manager"},{"title":"HR team","description":"Description of HR team","auth":7,"tag":"hr_team"},'.
            '{"title":"Service manager","description":"Description of Service manager","auth":8,"tag":"service_manager"}'.
            ',{"title":"Sub-team","description":"Description of Sub-team","auth":9,"tag":"sub_team"},{"title":'.
            '"Vice-president","description":"Description of Vice-president","auth":10,"tag":"vice_president"},'.
            '{"title":"Financial department","description":"Description of Financial department","auth":11,"tag":'.
            '"financial_department"},{"title":"Administration department","description":"Description of Administration'.
            ' department","auth":12,"tag":"administration_department"}]';
        $this->assertEquals($expected, $this->getWithAuth('/api/role')
        );
    }
    /**
     * Test to get one of the roles.
     *
     * @return void
     */
    public function testGetOne()
    {
        $response = $this->getWithAuth('/api/role/1');
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['title'], 'Customer Service');
        $this->assertEquals($jsonArr['description'], 'Customer Service description');
        $this->assertEquals($jsonArr['auth'], 1);
        $this->assertEquals($jsonArr['tag'], 'customer_service');
    }

    /**
     * Test to create new role.
     *
     * @return void
     */
    public function testCreateNew()
    {
        $json = "{\"title\":\"Rock n Role\",\"description\":\"jada jada\",\"auth\":666,\"tag\":\"glowing_fork\"}";
        $response = $this->postWithAuth('/api/role', $json);
        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['title'], 'Rock n Role');
        $this->assertEquals($jsonArr['description'], 'jada jada');
        $this->assertEquals($jsonArr['auth'], 666);
        $this->assertEquals($jsonArr['tag'], 'glowing_fork');
    }

    /**
     * Test to update existing role.
     *
     * @return void
     */
    public function testUpdateExisting()
    {
        $json = "{\"title\":\"Rock n Role\",\"description\":\"jada jada\",\"auth\":666,\"tag\":\"glowing_fork\"}";
        $response = $this->putWithAuth('/api/role/1', $json);

        $jsonArr = json_decode($response, true);

        $this->assertEquals($jsonArr['title'], 'Rock n Role');
        $this->assertEquals($jsonArr['description'], 'jada jada');
        $this->assertEquals($jsonArr['auth'], 666);
        $this->assertEquals($jsonArr['tag'], 'glowing_fork');
    }

    /**
     * Test to delete existing role.
     *
     * @return void
     */
    public function testDeleteExisting()
    {
        $response = $this->deleteWithAuth('/api/role/1');
        $this->assertEquals('"success"', $response);
    }
}
