<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-17
 * Time: 10:38
 */

namespace tests;


use TestCase;

class ResourceRequestTest extends TestCase
{

    public function testCreateResourceRequest(){
        //$app->post('api/production_manager/resource_request',

        $this->markTestIncomplete(
            "Test so that its created correct. This is a totaly new controller btw"
        );
    }

    public function testGetResourceRequestByType(){
        //$app->get('api/hr_team/resource_request',

        $this->markTestIncomplete(
            "Test so that the roight resources are returned. The HR team should only get 'people' and finanacial manager should only get 'money' type"
        );
    }

    public function testDeleteResourceRequestForHR(){
        //$app->delete('api/hr_team/resource_request/{id}'

        $this->markTestIncomplete(
            "Test so that the HR team can only remove 'people' request and not budget stuff"
        );
    }

}