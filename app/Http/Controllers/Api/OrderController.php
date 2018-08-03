<?php

namespace App\Http\Controllers\Api;

use App\Models\AddCart;
use App\Models\Address;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use Faker\Provider\Base;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    //订单添加
    public function add(Request $request)
    {
        //接收参数
        $address_id = $request->post('address_id');
        //查找收货地址
        $address = Address::find($address_id);

        //判断地址都否正确
        if ($address === null) {
            return [
                "status" => "false",
                "message" => "地址选择不正确"
            ];

        }
        $data['user_id'] = $request->post('user_id');
        //分别赋值
        //找到shop_id ，通过user_id 找到购物车找到商品，在菜品中再找shop_id
//        $carts= AddCart::where('user_id',$user_id)->first();
        $carts = AddCart::where('user_id', $request->post('user_id'))->get();

        $goods_id = $carts[0]->goods_id;//得到三条数据，取第一条数据
        //得到shop_id
        $shop_id = Menu::find($goods_id)->shop_info_id;
        //把值全部存入一个数组里面
        $data['shop_id'] = $shop_id;
        //订单号的生成
        $data['order_code'] = date("ymdHis") . rand(1000, 9999);
        //取出地址
        $data['provence'] = $address->provence;
        $data['city'] = $address->city;
        $data['county'] = $address->area;
        $data['tel'] = $address->tel;
        $data['name'] = $address->name;
        $data['order_address'] = $address->detail_address;

        //算出总价
        $total = 0;
        foreach ($carts as $k => $v) {
            $menu = Menu::where('id', $v->goods_id)->first();

            //算出总价
            $total += $v->amount * $menu->goods_price;

        }
        $data['total'] = $total;
        //赋值状态=等待支付
        $data['status'] = 0;

        //事物启动
        DB::beginTransaction();

        try {
            //入订单库
            $order = Order::create($data);
            $data['order_birth_time'] = $order->create_at;


            //准备入商品订单,里面是商品的信息
            $goods['order_id'] = $order->id;
            foreach ($carts as $vv) {
                //找到当前商品
                $info = Menu::find($vv->goods_id);
                $goods['goods_id'] = $vv->goods_id;
                $goods['goods_name'] = $info->goods_name;
                $goods['goods_img'] = $info->goods_img;
                $goods['amount'] = $vv->amount;
                $goods['goods_price'] = $info->goods_price;
                //入库
                OrderGood::create($goods);

            }
            //事物提交
            DB::commit();
            //捕获
        } catch (\Exception $exception) {
              //回滚
            DB::rollBack();
            //返回数据
            return [
                "status" => "false",
                "message" => $exception->getMessage()
            ];
        }catch(QueryException $exception){
            //回滚
            DB::rollBack();
            //返回数据  指数据库
            return [
                "status" => "false",
                "message" => $exception->getMessage()
            ];
        }
        //返回数据
        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];

    }

    //订单detail
    public function detail(Request $request)
    {
        //取出订单的信息
        $order = Order::find($request->input('id'));

        $data['id'] = $order->id;
        $data['order_code'] = $order->order_code;
        $data['order_status'] = $order->order_status;
        $data['shop_name'] = $order->shop->shop_name;
        $data['shop_img'] = $order->shop->shop_img;
        $data['shop_id'] = $order->shop_id;
        $data['order_birth_time'] = (string)$order->created_at;
        $data['order_price'] = $order->total;
        $data['order_address'] = $order->provence . $order->city . $order->county . $order->order_address;

        //直接连表调用方法，通过order_id 找到当前的所有信息
        $data['goods_list'] = $order->goods;
        return $data;

    }


    //订单支付pay
    public function pay(Request $request)
    {
        //得到当前的订单
        $order = Order::find($request->input('id'));
        //得到当前的用户
        $member = Member::where('id', $order->user_id)->first();
//       dd($member);
        //判断用户余额够不够
        if ($order->total > $member->money) {
            return [
                'status' => "false",
                'message' => '您余额不足，不能消费'
            ];

        }
        //扣用户余额的钱
        $member->money = $member->money - $order->total;
        $member->save();
        //改变订单状态
        $order->update(['status' => 1]);


        return [
            'status' => "true",
            'message' => "支付成功"
        ];

    }


    //订单展示
    public function index(Request $request)
    {

        //找到订单表返回所有信息
        $orders = Order::where('user_id', $request->input('user_id'))->get();
        $datas = [];
        foreach ($orders as $order) {

            $data['id'] = $order->id;
            $data['order_code'] = $order->order_code;
            $data['order_status'] = $order->order_status;
            $data['order_birth_time'] = (string)$order->created_at;
            $data['shop_id'] = $order->shop_id;
            $data['shop_name'] = $order->shop->shop_name;
            $data['shop_img'] = $order->shop->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->county . $order->order_address;

            $data['goods_list'] = $order->goods;
            $datas[] = $data;

        }

        return $datas;


    }


}
