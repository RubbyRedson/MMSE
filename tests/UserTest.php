<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 15:47
 */

namespace tests;
use Laravel\Lumen\Testing\DatabaseTransactions;


class UserTest
{
    public function testLogin(){
        $this->get('/');
        dd($this->response->getContent());
    }
}