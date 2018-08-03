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
    //会员管理[会员列表,查询会员,查看会员信息,禁用会员账号]
    Route::any('member/index',"MemberController@index")->name('member.index');
    Route::any('member/info/{id}',"MemberController@info")->name('member.info');
    Route::any('member/check/{id}',"MemberController@check")->name('member.check');

    //订单
    Route::get('order/index',"OrderController@index")->name('orders.index');
    Route::get('order/day',"OrderController@day")->name('orders.day');
    Route::get('order/month',"OrderController@month")->name('orders.month');
    //菜品
    Route::get('order/menu',"OrderController@menu")->name('orders.menu');
    Route::get('order/menuDay',"OrderController@menuDay")->name('orders.menuDay');
    Route::get('order/menuMonth',"OrderController@menuMonth")->name('orders.menuMonth');

    //平台权限Rbac
    Route::any('per/index',"PermissionController@index")->name('per.index');
    Route::any('per/add',"PermissionController@add")->name('per.add');
    Route::any('per/del/{id}',"PermissionController@del")->name('per.del');
    Route::any('per/edit/{id}',"PermissionController@edit")->name('per.edit');
    //平台角色Rbac
    Route::any('role/index',"RoleController@index")->name('role.index');
    Route::any('role/add',"RoleController@add")->name('role.add');
    Route::any('role/edit/{id}',"RoleController@edit")->name('role.edit');
    Route::any('role/del/{id}',"RoleController@del")->name('role.del');


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


    //订单管理[订单列表,查看订单,取消订单,发货]
    Route::any('order/index',"OrderController@index")->name('order.index');
    Route::any('order/info/{id}',"OrderController@info")->name('order.info');
    Route::any('order/cell/{id}',"OrderController@cell")->name('order.cell');
    Route::any('order/send/{id}',"OrderController@send")->name('order.send');
    //订单量统计[按日统计,按月统计,累计]（每日、每月、总计）
    Route::any('order/day',"OrderController@day")->name('order.day');
    Route::any('order/month',"OrderController@month")->name('order.month');
    Route::get('order/total',"OrderController@total")->name('order.total');
    //菜品销量统计[按日统计,按月统计,累计]（每日、每月、总计）
    Route::any('order/menuDay',"OrderController@menuDay")->name('order.menuDay');
    Route::any('order/menuMonth',"OrderController@menuMonth")->name('order.menuMonth');
    Route::get('order/menu',"OrderController@menu")->name('order.menu');


});

//用户路由（前端）
