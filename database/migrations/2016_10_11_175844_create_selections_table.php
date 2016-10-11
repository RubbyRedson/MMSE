<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('selections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('byUserId');
            $table->unsignedInteger('selectedId');
            $table->string('selectionType');
            $table->timestamps();
        });

        Schema::table('selections', function($table) {
            $table->foreign('byUserId')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selections');
    }
}
