<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanningRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('planning_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client');
            $table->string('feedback');
            $table->timestamps();
        });

        Schema::table('planning_requests', function($table) {
            $table->foreign('client')->references('id')->on('clients')
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
        Schema::dropIfExists('planning_requests');
    }
}
