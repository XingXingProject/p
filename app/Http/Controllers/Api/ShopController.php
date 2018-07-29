<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\ShopInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    //商家列表接口
    public function list(Request $request)
    {

        $search=$request->input('keyword');

        $shops = ShopInfo::where('status', 1)->where('shop_name','like',"%$search%")->get();

        foreach ($shops as $shop) {
            $shop->distance = rand(1000, 5000);
            $shop->estimate_time = $shop->distance / 100;
        }
        return $shops;
    }

    //找到店铺里面的内容
    public function index(Request $request){

        $id=$request->input('id');
        $shop=ShopInfo::findOrFail($id);
        $shop->distance = rand(1000, 5000);
        $shop->estimate_time = $shop->distance / 100;
        //添加评论
        $shop->evaluate = [
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"],
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"]
        ];
//先取出分类
        $cates=MenuCategory::where('shop_info_id',$id)->get();
        foreach ($cates as $cate){
            $cate->goods_list=Menu::where('category_id',$cate->id)->get();

        }
        //再把分类数据追加到$shop
        $shop->commodity=$cates;
        return $shop;


    }










}
