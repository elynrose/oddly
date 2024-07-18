<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBidsTable extends Migration
{
    public function up()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id')->nullable();
            $table->foreign('job_id', 'job_fk_9956766')->references('id')->on('jobs');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9956767')->references('id')->on('users');
        });
    }
}
