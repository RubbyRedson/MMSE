<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\User;

class BetterUsers extends Migration
{
    private function getSalt(){
        return bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function ($table) {
            $table->string('salt');
        });

        $user1 = new User();
        $user1->salt = $this->getSalt();
        $user1->password = sha1($user1->salt ."abc123");
        $user1->username = "kalle@kula.se";
        $user1->role = 1;
        $user1->save();

        $user2 = new User();
        $user2->salt = $this->getSalt();
        $user2->password = sha1($user2->salt ."abc123");
        $user2->username = "palle@kuling.se";
        $user2->role = 2;
        $user2->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('salt');
        });
    }
}
