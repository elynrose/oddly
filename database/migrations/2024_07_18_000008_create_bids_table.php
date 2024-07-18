<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('bid_amount', 15, 2)->nullable();
            $table->integer('points_required')->nullable();
            $table->boolean('featured')->default(0)->nullable();
            $table->boolean('highlighted')->default(0)->nullable();
            $table->boolean('free')->default(0)->nullable();
            $table->boolean('selected')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
