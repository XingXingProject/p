<?php

namespace App\Http\Controllers\Api;

use App\Models\AddCart;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddCartController extends BaseController
{
    //购物车添加
    public function add(Request $request)
    {
        //每次添加同一个购物车时，删除之前的记录
        AddCart::where('user_id', $request->post('user_id'))->delete();
        //得到所有数据
        $goodsList = $request->post('goodsList');
        $goodsCount = $request->post('goodsCount');
//        dd($goodsList);
        //循环出当前商品id对应的数据 存入数据库
        foreach ($goodsList as $k => $goods) {
            $data = [
                'user_id' => $request->post('user_id'),
                'goods_id' => $goods,
                'amount' => $goodsCount[$k]
            ];

            AddCart::create($data);
        }
        return [

            'status' => "true",
            'message' => '添加成功'
        ];


    }


    public function cart(Request $request)
    {
        //接收参数
        $user_id = $request->input('user_id');
        //取出购物车的数据
        $goods = AddCart::where('user_id', $user_id)->get();
        $totalCost = 0;
        foreach ($goods as $good) {
            //找出菜品表里面的菜品
            $menu = Menu::where('id', $good->goods_id)->first();
            $goodl['goods_name'] = $menu['goods_name'];
            $goodl['goods_img'] = $menu['goods_img'];
            $goodl["goods_price"] = $menu->goods_price;
            $goodl['amount']=$good->amount;
            $goodl['goods_id']=(string)$good->goods_id;
            $totalCost += $good->amount * $menu->goods_price;

            $goodsList[]=$goodl;
        }
        //添加多个
          $data['goods_list']=$goodsList;
           $data['totalCost']=$totalCost;


        return $data;


    }


}
