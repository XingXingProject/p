<?php

namespace App\Http\Controllers\Shop;

use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\ShopInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    /**
     * 订单显示
     */
    public function index(Request $request)
    {
        $orders = Order::all();
        return view('shop.order.index', compact('orders'));


    }

    /**
     * 取消订单
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cell(Request $request, $id)
    {
        //哪个订单
        $order = Order::find($id);
        //哪个会员
        $member = Member::find($order->user_id);
        //订单状态
        if ($order->status === -1 || $order->status === 2 || $order->status === 3) {
            $request->session()->flash('danger', '订单不能被取消');
            return redirect()->back();
        }
        //订单取消之后返回用户的钱
        if ($order->status === 1) {
            $member->money += $order->total;
            $request->session()->flash('success', '订单取消成功');
        }
        $order->status = -1;
        $order->update();
        return redirect()->back();
    }

    /**
     *
     * 发货
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order->status !== 1) {
            $request->session()->flash('danger', '订单不能被发送');
            return redirect()->back();
        }

        $order->status = 2;
        $order->update();
        return redirect()->back();

    }

    /**
     * 查看详情
     * @param Request $request
     * @param $id
     */
    public function info(Request $request, $id)
    {
        $order = Order::find($id);
        $ordergood=OrderGood::where('order_id',$order->id)->get();
//        dd($ordergood);
        return view('shop.order.see', compact('order','ordergood'));
    }


    /**
     * 订单按日统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function day(Request $request)
    {
        $shopId=Auth::user()->id;
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        //得到所有的信息
        $query = Order::where('shop_id',$shopId)->Select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") AS date,SUM(total) AS money,count(*) AS count '))->groupBy('date')->orderBy('date', 'desc');
        //得到所有数据
        if ($start_time !== null) {
            $query = $query->where('created_at', '>=', $start_time);
        }
        if ($end_time !== null) {
            $query = $query->where('created_at', '<=', $end_time);
        }

        $acts = $query->get();
//        dd($acts);


        return view('shop.order.search', compact( 'acts'));
    }


    /**
     * 订单按月统计
     * @param Request $request
     */
    public function month(Request $request)
    {
        $shopId=Auth::user()->id;
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        //得到所有的信息
        $query = Order::where('shop_id',$shopId)->Select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS date,SUM(total) AS money,count(*) AS count '))->groupBy('date');
        //得到所有数据
        if ($start_time !== null) {
            $query = $query->where('created_at', '>=', $start_time);
        }
        if ($end_time !== null) {
            $query = $query->where('created_at', '<=', $end_time);
        }
        $acts = $query->get();
        return view('shop.order.month', compact('acts'));
    }


    public function menuDay(Request $request)
    {
        //得到order_id
        $orderId = Order::where("shop_id", '=', Auth::user()->id)->pluck('id')->toArray();
         //dd($orderId);
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $query = Order::orderBy('id');
        //得到所有的信息
        $query = OrderGood::whereIn('order_id',$orderId)->Select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") AS date,goods_id,goods_name,sum(amount) as nums'))->groupBy('date', 'goods_id')->orderBy('date', 'desc')->limit(30);
        //得到所有数据
        $date = $request->query();
        if ($start_time !== null) {
            $query = $query->where('created_at', '>=', $start_time);
        }
        if ($end_time !== null) {
            $query = $query->where('created_at', '<=', $end_time);
        }
        $acts = $query->get();

        //显示数据
        return view('shop.order.menuDay',compact('acts'));
    }


    public function menuMonth(Request $request)
    {
        //得到order_id
        $orderId = Order::where("shop_id", '=', Auth::user()->id)->pluck('id')->toArray();

        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $query = Order::orderBy('id');
        //得到所有的信息
        $query = OrderGood::whereIn('order_id',$orderId)->Select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") AS date,goods_id,goods_name,sum(amount) as nums'))->groupBy('date', 'goods_id')->orderBy('date', 'desc')->limit(30);
        //得到所有数据
        if ($start_time !== null) {
            $query = $query->where('created_at', '>=', $start_time);
        }
        if ($end_time !== null) {
            $query = $query->where('created_at', '<=', $end_time);
        }
        $acts = $query->get();

        //显示数据
        return view('shop.order.menuDay',compact('acts'));
    }


    /**
     * 订单量统计
     * 按店铺分别统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function total(Request $request)
    {
        $shopId = ShopInfo::where("shop_user_id", '=',Auth::user()->id )->pluck('id')->toArray();
        $query = Order::orderBy('id');
        //接收参数
        $order = $query->whereIn('shop_id', $shopId)
            ->select(DB::raw('SUM(total) as money,COUNT(*) as count'))->first();
        //显示视图并传递数据
        return view('shop.order.dzj', compact('order'));
    }


    /**
     * 菜品销量统计
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu(Request $request)
    {
        $query = Order::orderBy('id');
        //接收参数
        $shopId = $request->input('shop_id');

        $orderId=$query->pluck('id')->toArray();
        $goods = OrderGood::whereIn('order_id', $orderId)
            ->select(DB::raw('SUM(amount) as count,goods_name'))
            ->groupBy('goods_name')->get();
        //显示视图并传递数据
        return view('shop.order.menu', compact('goods'));
    }


}
