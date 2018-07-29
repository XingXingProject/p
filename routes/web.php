<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//平台路由admin.ele.com
Route::domain('admin.ele.com')->namespace('Admin')->group(function () {
    //店铺分类 route('路径'，‘控制器/方法’)
    Route::get('shop_category/index',"ShopCategoryController@index")->name('shop_category.index');
    Route::any('shop_category/add',"ShopCategoryController@add")->name('shop_category.add');
    Route::any('shop_category/edit/{id}',"ShopCategoryController@edit")->name('shop_category.edit');
    Route::get('shop_category/del/{id}',"ShopCategoryController@del")->name('shop_category.del');

    //商家人管理
    Route::get('shop_user/index',"UserController@index")->name('shop_user.index');
    Route::any('shop_user/add',"UserController@add")->name('shop_user.add');
    Route::any('shop_user/edit/{id}',"UserController@edit")->name('shop_user.edit');
    Route::get('shop_user/del/{id}',"UserController@del")->name('shop_user.del');
    Route::any('shop_user/clear/{id}',"UserController@clear")->name('shop_user.clear');
    //商家信息管理
    Route::get('shop_info/index',"ShopInfoController@index")->name('shop_info.index');
    Route::any('shop_info/add',"ShopInfoController@add")->name('shop_info.add');
    Route::any('shop_info/edit/{id}',"ShopInfoController@edit")->name('shop_info.edit');
    Route::get('shop_info/del/{id}',"ShopInfoController@del")->name('shop_info.del');
    Route::get('shop_info/see/{id}',"ShopInfoController@see")->name('shop_info.see');
    //平台管理员
    Route::get('admin/index',"AdminController@index")->name('admin.index');
    Route::any('admin/add',"AdminController@add")->name('admin.add');
    Route::any('admin/edit/{id}',"AdminController@edit")->name('admin.edit');
    Route::get('admin/del/{id}',"AdminController@del")->name('admin.del');
    Route::any('admin/check/{id}',"AdminController@check")->name('admin.check');
    Route::any('admin/login',"AdminController@login")->name('admin.login');
    Route::any('admin/logout',"AdminController@logout")->name('admin.logout');
//平台活动
    Route::any('active/index',"ActiveController@index")->name('active.index');
    Route::any('active/add',"ActiveController@add")->name('active.add');
    Route::any('active/edit/{id}',"ActiveController@edit")->name('active.edit');
    Route::any('active/del/{id}',"ActiveController@del")->name('active.del');
    Route::any('active/see/{id}',"ActiveController@see")->name('active.see');


});

//商家shop.ele.com
Route::domain('shop.ele.com')->namespace('Shop')->group(function () {
//商家注册 登录
    Route::any('user/reg',"UserController@reg")->name('user.reg');
    Route::any('user/joins',"UserController@joins")->name('user.joins');
    Route::any('user/logout',"UserController@logout")->name('user.logout');
//商家菜品分类
    Route::any('menuCategory/index',"MenuCategoryController@index")->name('menuCategory.index');
    Route::any('menuCategory/add',"MenuCategoryController@add")->name('menuCategory.add');
    Route::any('menuCategory/edit/{id}',"MenuCategoryController@edit")->name('menuCategory.edit');
    Route::any('menuCategory/del/{id}',"MenuCategoryController@del")->name('menuCategory.del');
//菜品表
    Route::any('menu/index',"MenuController@index")->name('menu.index');
    Route::any('menu/add',"MenuController@add")->name('menu.add');
    Route::any('menu/edit/{id}',"MenuController@edit")->name('menu.edit');
    Route::any('menu/del/{id}',"MenuController@del")->name('menu.del');

    //查看平台活动
    Route::any('active/info',"ActiveController@info")->name('active.info');
    Route::any('active/show/{id}',"ActiveController@show")->name('active.show');


});

//用户路由（前端）
