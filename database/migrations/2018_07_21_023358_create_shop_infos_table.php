<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_category_id')->comment('店铺分类id');
            $table->string('shop_name')->comment('名称');
            $table->string('shop_img')->comment('店铺图片');
            $table->float('shop_rating')->comment('店铺评分');
            $table->boolean('brand')->comment('是否是品牌');
            $table->boolean('on_time')->comment('是否是准时');
            $table->boolean('fengniao')->comment('是否是蜂鸟配送');
            $table->boolean('bao')->comment('是否是保标记');
            $table->boolean('piao')->comment('是否是票标记');
            $table->boolean('zhun')->comment('是否是准标记');
            $table->decimal('start_send')->comment('起送金额');
            $table->decimal('start_cost')->comment('配送费');
            $table->string('notice')->comment('配送费');
            $table->string('discount')->comment('优惠信息');
            $table->integer('status')->comment('状态1正常 0 待审核');

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
        Schema::dropIfExists('shop_infos');
    }
}
