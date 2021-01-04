<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sliders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang');
            $table->string('title');
            $table->text('subtitle');
            $table->integer('order');
            $table->string('path')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('trans_id')->nullable();
            $table->foreign('trans_id')->references('id')->on('sliders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
