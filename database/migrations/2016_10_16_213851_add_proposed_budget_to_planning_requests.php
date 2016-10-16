<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddProposedBudgetToPlanningRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planning_requests', function ($table) {
            $table->string('proposed_budget');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planning_requests', function ($table) {
            $table->dropColumn('proposed_budget');
        });
    }
}
