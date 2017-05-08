<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAveragedetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('averagedetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('tips');
            $table->integer('averagelist_id');
            $table->integer('creator_id');
            $table->string('actor_id');
            $table->string('cost');
            $table->enum('state',array('免单','不免单'))->default('不免单');
            $table->integer('actor_num');
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
        Schema::dropIfExists('averagedetails');
    }
}
