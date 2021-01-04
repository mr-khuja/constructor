<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Basicpages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //basic
        Schema::create('basic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang');
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('short')->nullable();
            $table->longText('body');
            $table->unsignedInteger('trans_id')->nullable();
            $table->foreign('trans_id')->references('id')->on('basic');
            $table->timestamps();
        });
        Schema::table('menu', function (Blueprint $table) {
            $table->string('lang');
            $table->unsignedInteger('trans_id')->nullable();
            $table->foreign('trans_id')->references('id')->on('menu');
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
