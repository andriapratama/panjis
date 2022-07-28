<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
            $table->string('name');
            $table->string('path');

            $table->foreign('gallery_id')->references('id')->on('galleries');
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
        Schema::dropIfExists('gallery_detail');
    }
}
