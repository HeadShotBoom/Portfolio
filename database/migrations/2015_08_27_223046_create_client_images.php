<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_images', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('clientId');
            $table->string('imageName');
            $table->string('largePath');
            $table->string('thumbPath');
            $table->string('height');
            $table->string('width');
            $table->string('chosenImage');
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
        Schema::drop('client_images');
    }
}
