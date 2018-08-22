<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::domain('www.ele.com')->namespace('Api')->group(function(){
//商家店铺列表
    Route::get("shop/list","ShopController@list");
    Route::get("shop/index","ShopController@index");

//用户登录注册
    Route::get("member/sms","MemberController@sms");
    Route::any("member/reg","MemberController@reg");
    Route::any("member/login","MemberController@login");

//用户修改密码 ，重置密码
    Route::post("member/forget","MemberController@forget");
    Route::post("member/change","MemberController@change");
    Route::any("member/detail","MemberController@detail");

//添加收货地址
    Route::any("address/add","AddressController@add");
    Route::get("address/list","AddressController@list");
    Route::any("address/edit","AddressController@edit");
    Route::any("address/show","AddressController@show");

//购物车
    Route::any("addCart/add","AddCartController@add");
    Route::any("addCart/cart","AddCartController@cart");


//订单
    Route::any("order/add","OrderController@add");
    Route::any("order/detail","OrderController@detail");
    Route::any("order/pay","OrderController@pay");
    Route::any("order/index","OrderController@index");
//做微信支付
    Route::get("order/wxPay","OrderController@wxPay");
    Route::get("order/status","OrderController@status");
    Route::any("order/ok","OrderController@ok");






});



