<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:46 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceRequest extends Model
{
    protected $fillable = ['project', 'approved', 'type', 'proposal', 'subteam'];
}