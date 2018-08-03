@extends("shop.layouts.default")
@section("title","订单统计列表")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>订单数量</th>
            <th>总金额</th>
        </tr>
        <tr>
            <td>{{$order->count}}</td>
            <td>{{$order->money}}</td>
        </tr>
    </table>
@endsection