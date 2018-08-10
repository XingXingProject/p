<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\ShopInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class ShopController extends BaseController
{
    //商家列表接口
    public function list(Request $request)
    {
       //全文搜索
        $search=$request->input('keyword');
        if($search===null){
            $shops = ShopInfo::where('status', 1)->get();
        }else{
            $shops = ShopInfo::search($search)->where('status', 1)->get();
        }
        $data=Redis::get('shop:');
        if($data){
            //如果存在就直接返回,不存在就去数据库查找
            return  $data;
        }
        foreach ($shops as $shop) {
            $shop->distance = rand(1000, 5000);
            $shop->estimate_time = $shop->distance / 100;
        }
        //存入redis
        Redis::setex('shop:',60*60*24*7,$shops);
        return $shops;
    }

    //找到店铺里面的内容
    public function index(Request $request){

        $id=$request->input('id');
        $data=Redis::get('shop:'.$id);
        //判断有没有缓存redis
        if($data){
          //如果存在就直接返回,不存在就去数据库查找
            return  $data;
        }
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
        //把数据存入redis里面
        Redis::setex('shop:'.$id,60*60*24*7,$shop);
        return $shop;


    }










}
