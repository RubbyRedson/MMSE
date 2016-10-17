<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/11/2016
 * Time: 8:10 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobAdvertisement extends Model
{
    protected $fillable = ['title', 'description', 'salary'];
}