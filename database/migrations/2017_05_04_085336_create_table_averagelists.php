<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAveragelists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('averagelists', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->string('tips');
          $table->integer('creator_id');
          $table->string('password');
          $table->string('actor_id');
          $table->string('cost');
          $table->enum('state',array('进行中','已完成'))->default('进行中');
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
        Schema::dropIfExists('averagelists');
    }
}
