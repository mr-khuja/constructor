<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang');
            $table->string('title');
            $table->integer('price')->nullable();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('short')->nullable();
            $table->longText('body')->nullable();
            $table->longText('full')->nullable();
            $table->unsignedInteger('trans_id')->nullable();
            $table->foreign('trans_id')->references('id')->on('product');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('category');
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
