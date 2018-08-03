@extends("shop.layouts.default")
@section("title","菜品销量统计列表")
@section("content")
    <table class="table table-bordered">
        <tr>
            <th>菜品名称</th>
            <th>菜品数量</th>
        </tr>
        @foreach($goods as $good)
            <tr>
                <td>{{$good->goods_name}}</td>
                <td>{{$good->count}}</td>
            </tr>
        @endforeach
    </table>
@endsection