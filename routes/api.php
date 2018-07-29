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
});



