<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_images', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('category');
            $table->string('path');
            $table->string('thumbnail');
            $table->string('alt_tag');
            $table->string('height');
            $table->string('width');
            $table->integer('main_gallery');
            $table->integer('home_page');
            $table->integer('position');
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
        Schema::drop('project_images');
    }
}
