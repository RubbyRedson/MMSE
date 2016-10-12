<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubteamRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subteam_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reportedBySubteam');
            $table->unsignedInteger('project');
            $table->boolean('needMorePeople');
            $table->boolean('needBiggerBudget');
            $table->timestamps();
        });

        Schema::table('subteam_requests', function($table) {
            $table->foreign('reportedBySubteam')->references('id')->on('subteams')
                ->onDelete('cascade');
            $table->foreign('project')->references('id')->on('projects')
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
        Schema::dropIfExists('subteam_requests');
    }
}
