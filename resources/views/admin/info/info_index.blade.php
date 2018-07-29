@extends('/admin.layouts.default')
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
    <a href="{{route('shop_info.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>商家老板</th>
            <th>店铺分类</th>
            <th>店铺名称</th>
            <th>商家图片</th>
            <th>是否准时</th>
            <th>是否蜂鸟配送</th>

            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr class="info">
                <td>{{$shop->id}}</td>
                <td>{{$shop->shop_user->name}}</td>
                <td>{{$shop->shopCategory->name}}</td>
                <td>{{$shop->shop_name}}</td>
                <td>
                    @if($shop->shop_img)
                        <img src="{{$shop->shop_img}}" width="50" >
                    @endif
                </td>
                <td>
                    @if($shop->on_time===1)
                        <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove" style="color: red"></span>
                    @endif</td></td></td>
                <td>
                    @if($shop->fengniao===1)
                        <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove"></span>
                    @endif</td></td></td></td>

                <td>
                    <a href="{{route('shop_info.see',$shop->id)}}" class=" btn btn-success">查看详情</a>
                    <a href="{{route('shop_info.edit',$shop->id)}}" class=" btn btn-info">编辑</a>
                    <a href="{{route('shop_info.del',$shop->id)}}" class=" btn btn-danger">删除</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{$shops->appends($query)->links()}}
@endsection