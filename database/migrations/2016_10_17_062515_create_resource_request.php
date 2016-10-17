<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('resource_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project');
            $table->boolean('approved');
            $table->string('type');
            $table->timestamps();
        });

        Schema::table('resource_requests', function($table) {
            $table->foreign('project')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_requests');
    }
}
