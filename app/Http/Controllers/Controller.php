<?php

namespace App\Http\Controllers;

use app\Data\DatabaseInterface;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected  $dataSource;

    public function __construct(DatabaseInterface $ds)
    {
        dd("IN base ctor");
        $this->dataSource = $ds;
    }
}
