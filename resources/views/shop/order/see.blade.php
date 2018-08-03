@extends('shop.layouts.default')
@section('title','订单信息显示页面')
@section('content')

   </a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>订单编号</th>
            <th>省</th>
            <th>市</th>
            <th>区县</th>
            <th>收货地址</th>
            <th>商品总价</th>
            <th>操作</th>
        </tr>
            <tr class="info">
                <td>
                    {{$order->order_code}}
                </td>
                {{--<td>--}}
                    {{--{{$ordergood[0]->goods_name}}--}}
                    {{--{{$ordergood[1]->goods_name}}--}}
                {{--</td>--}}
                <td>
                    {{$order->provence}}
                </td>
                <td>{{$order->city}}</td>
                <td>{{$order->county}}</td>
                <td>{{$order->order_address}}</td>
                <td>{{$order->total}}</td>

                <td>
                    <a href="{{route('order.index')}}" class=" btn btn-success">返回</a>

                </td>

            </tr>
    </table>
<div class="box-body table-responsive no-padding">
    <table class="table table-hover">
        <tbody>
        <tr>
            <th>菜品名称</th>
            <th>数量</th>
            <th>菜品价格</th>
        </tr>
        @foreach($ordergood as $good)
            <tr>
                <td>{{$good->goods_name}}</td>
                <td>{{$good->amount}}</td>
                <td>{{$good->goods_price}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection