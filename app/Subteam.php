<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 4:09 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Subteam extends Model
{
    protected $fillable = ['name', 'description', 'numberOfPeople'];
}