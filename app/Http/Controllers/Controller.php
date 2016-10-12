<?php

namespace App\Http\Controllers;

use App\Data\DatabaseInterface;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected  $dataSource;

    public function __construct(DatabaseInterface $ds)
    {
        $this->dataSource = $ds;
    }
}
