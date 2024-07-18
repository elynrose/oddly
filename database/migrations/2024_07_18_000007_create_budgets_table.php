<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('ordering')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
