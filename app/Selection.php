<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/11/2016
 * Time: 8:09 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    protected $fillable = ['byUserId', 'selectedId', 'selectionType'];
}