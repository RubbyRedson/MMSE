<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-12
 * Time: 16:26
 */

namespace app;


use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['token', 'valid_to', 'user_id'];
}