<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobsTable extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_9956695')->references('id')->on('categories');
            $table->unsignedBigInteger('budget_id')->nullable();
            $table->foreign('budget_id', 'budget_fk_9956711')->references('id')->on('budgets');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9956870')->references('id')->on('task_statuses');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9956871')->references('id')->on('users');
        });
    }
}
