<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->datetime('deadline');
            $table->string('completed_link')->nullable();
            $table->boolean('published')->default(0)->nullable();
            $table->string('job_code')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
