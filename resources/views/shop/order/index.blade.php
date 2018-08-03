@extends('shop.layouts.default')
@section('title','订单显示页面')
@section('content')
    {{--<form class="form-inline" action="" method="get">--}}
        {{--<div class="form-group navbar-right col-lg-3">--}}
            {{--<input type="text" class="form-control" name="search" placeholder="搜索">--}}
            {{--<button type="submit" class="btn btn-default">搜索</button>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
        {{--</div>--}}
    {{--</form>--}}
    {{--<a href="{{route('shop_info.add')}}" class="btn btn-info">添加</a>--}}
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>会员id</th>
            <th>商家</th>
            <th>联系电话</th>
            <th>收货人</th>
            <th>status</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
            <tr class="info">
                <td>{{$order->id}}</td>
                <td>{{$order->user_id}}</td>
                <td>{{$order->shop->shop_name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->name}}</td>

                <td>
                    @if($order->status==-1)
                        <i>已取消</i>
                    @elseif($order->status==0)
                        <i>代付款</i>
                    @elseif($order->status==1)
                        <i>待发货</i>
                    @elseif($order->status==2)
                        <i>待确认</i>
                    @endif

                </td>
                <td>
                    <a href="{{route('order.info',$order->id)}}" class=" btn btn-success">查看详情</a>
                    <a href="{{route('order.cell',$order->id)}}" class=" btn btn-danger">取消订单</a>
                    <a href="{{route('order.send',$order->id)}}" class=" btn btn-info">发货</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{--{{$orders->links()}}--}}
@endsection