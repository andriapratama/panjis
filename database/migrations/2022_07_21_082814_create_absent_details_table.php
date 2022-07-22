<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absent_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('absent_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->tinyInteger('status');

            $table->foreign('absent_id')->references('id')->on('absents');
            $table->foreign('member_id')->references('id')->on('members');
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
        Schema::dropIfExists('absent_details');
    }
}
