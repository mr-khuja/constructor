<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Homepage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang');
            $table->string('about_title')->nullable();
            $table->longText('about_text')->nullable();
            $table->string('about_image')->nullable();
            $table->string('figures_title')->nullable();
            $table->longText('figures_text')->nullable();
            $table->string('figures_title_first')->nullable();
            $table->string('figures_value_first')->nullable();
            $table->string('figures_title_second')->nullable();
            $table->string('figures_value_second')->nullable();
            $table->string('figures_title_third')->nullable();
            $table->string('figures_value_third')->nullable();
            $table->string('figures_title_fourth')->nullable();
            $table->string('figures_value_fourth')->nullable();
            $table->longText('footer')->nullable();
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
