<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('nickname')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->integer('age')->nullable();
            $table->string('sex')->nullable();
            $table->enum('role_id',array('0','1','2'))->default('2');
            $table->string('alipay')->nullable();
            $table->string('alipay_tips')->nullable();
            $table->string('wechat')->nullable();
            $table->string('wechat_tips')->nullable();
            $table->string('icon')->default('https://zos.alipayobjects.com/rmsportal/hqQWgTXdrlmVVYi.jpeg');
            $table->string('averagelists_id');
            //这个是他自己管理自己的timestamps
            //created_at列为仅当行被创建时当前时间戳。
            // updated_at被修改为每次操作的行的数据时当前时间戳。
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
        Schema::dropIfExists('users');
    }
}
