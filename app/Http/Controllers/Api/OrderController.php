<?php

namespace App\Http\Controllers\Api;

use App\Models\AddCart;
use App\Models\Address;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use EasyWeChat\Foundation\Application;
use Faker\Provider\Base;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mrgoon\AliSms\AliSms;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;

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
        } catch (QueryException $exception) {
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

        $config = [
            'access_key' => 'LTAIylMWxorh14gn',
            'access_secret' => 'cA2kpj4Ztn6WiJBZXFkHzkAo8dXrxK',
            'sign_name' => '邓可星',
        ];
        $aliSms = new AliSms();
        // 调用接口发送短信
        $response = $aliSms->sendSms($member->tel, 'SMS_141600108', ['product' => $order->order_code], $config);

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

    //微信支持
    public function wxPay(Request $request)
    {
//        dd(public_path().'/aa/e1.jpg');
        //1、得到订单
        $order = Order::find($request->input('id'));
//        $orderGood = OrderGood::find($order->id)->get();
        //创建操作微信的对象
        $app = new Application(config('wechat'));

        //得到支付对象
        $payment = $app->payment;
//        dd($payment);
        //2、创建订单
        $attributes = [
            'trade_type' => 'NATIVE', // JSAPI，NATIVE，APP...
            'body' => "饭店支付",
            'detail' => '源码点餐详情',
            'out_trade_no' => $order->order_code,
            'total_fee' => $order->total * 100, // 单位：分
            'notify_url' => 'http://www.dengkexing.cn/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            // 'openid'           =>$order->id, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        //生成订单
        $orderPay = new \EasyWeChat\Payment\Order($attributes);
//dd($orderPay);
        //统一下单
        $result = $payment->prepare($orderPay);

        //  dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
//            取出预支付链接
//            dd($result->code_url);
            $payUrl = $result->code_url;

            $qrCode = new QrCode($payUrl);//地址
            $qrCode->setSize(200);//二维码大小

// Set advanced options
            $qrCode->setWriterByName('png');
            $qrCode->setMargin(10);
            $qrCode->setEncoding('UTF-8');
            $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);//容错级别
            $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
            $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
            $qrCode->setLabel('微信扫码支付', 16, public_path() . '/aa/noto_sans.otf', LabelAlignment::CENTER);

            $qrCode->setLogoPath(public_path() . '/aa/e1.jpg');
            $qrCode->setLogoWidth(80);//logo大小
            header('Content-Type: ' . $qrCode->getContentType());
            echo $qrCode->writeString();
            exit;

        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Core\Exceptions\FaultException
     *
     */
    //微信异步通知方法
    public function ok(){

        //1.创建操作微信的对象
        $app = new Application(config('wechat'));
        //2.处理微信通知信息
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            //  $order = 查询订单($notify->out_trade_no);
            $order=Order::where("order_code",$notify->out_trade_no)->first();

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status!==0) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;//更新订单状态
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;

    }


//微信订单状态
    public function status(Request $request)
    {
        return [
            'status'=>Order::find($request->input('id'))->status
        ];

    }


}
