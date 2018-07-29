@extends('admin.layouts.default')
@section('title','商家信息显示页面')
@section('content')
    <form class="form-inline" action="" method="get">
        <div class="form-group navbar-right col-lg-3" >
            <input type="text" class="form-control" name="search" placeholder="搜索">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>
        <div class="form-group">
        </div>
    </form>
   </a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>店铺评分</th>
            <th>是否保标记</th>
            <th>是否品牌</th>
            <th>piao是否票标记</th>
            <th>是否准时送达</th>
            <th>起送费</th>
            <th>配送费</th>
            <th>店铺公告</th>
            <th>店铺优惠活动</th>
            <th>是否启用</th>
            <th>操作</th>
        </tr>
            <tr class="info">
                <td>
                    {{$shop->shop_rating}}
                </td>
                <td>
                    @if($shop->bao===1)
                        <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove" style="color: red"></span>
                    @endif</td></td>
                <td>
                    @if($shop->brand===1)
                        <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @endif
                </td>

                <td>
                    @if($shop->piao===1)
                        <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove" style="color: red"></span>
                    @endif</td>
                <td>
                    @if($shop->zhun===1)
                        <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove" style="color:red"></span>
                    @endif</td></td>
                <td>{{$shop->start_send}}</td>
                <td>{{$shop->start_cost}}</td>
                <td>{{$shop->notice}}</td>
                <td>{{$shop->discount}}</td>
                <td>
                    @if($shop->status===1)
                    <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove" style="color: red "></span>
                    @endif

                </td>
                <td>
                    <a href="{{route('shop_info.index',$shop->id)}}" class=" btn btn-success">返回</a>

                </td>

            </tr>
    </table>
@endsection