<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id')->nullable();
            $table->foreign('job_id', 'job_fk_9956783')->references('id')->on('jobs');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9956784')->references('id')->on('users');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_9956787')->references('id')->on('categories');
        });
    }
}
