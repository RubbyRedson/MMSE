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

    public function __construct()
    {
        $this->token = $this->getRandomHash();
        $nowDate = new \DateTime();
        $validToTs = $nowDate->getTimestamp() + 3600;
        $newExpiry = new \DateTime();
        $newExpiry->setTimestamp($validToTs);
        $this->valid_to = $newExpiry;
    }

    public function getRandomHash(){
        return bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
    }
}