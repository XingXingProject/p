<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商家姓名');
            $table->string('password')->comment('商家密码');
            $table->string('email')->comment('商家邮箱');
            $table->integer('status')->comment('商家状态 1==启用 0==禁用');
            $table->integer('shop_id')->comment('所属商家信息id');
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
        Schema::dropIfExists('shop_users');
    }
}
