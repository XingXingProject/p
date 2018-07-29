@extends('admin.layouts.default')
@section('title','商家显示页面')
@section('content')
    <form class="form-inline" action="" method="post">
        <div class="form-group navbar-right col-lg-3" >
            <input type="text" class="form-control" name="search" placeholder="搜索">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>
        <div class="form-group">
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>商家老板</th>
            {{--<th>商家密码</th>--}}
            <th>商家email</th>
            <th>是否启用</th>
            <th>所属店铺</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr class="info">
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                {{--<td>--}}
                    {{--{{$shop->password}}--}}
                {{--</td>--}}
                <td>{{$shop->email}}</td>
                <td>
                    @if($shop->status===1)
                    <span class="glyphicon glyphicon-ok" style="color: green"></span>
                        @else
                        <span class="glyphicon glyphicon-remove" style="color: red"></span>
                    @endif

                </td>
                <td>{{$shop->shopInfo->shop_name}}</td>
                <td>
                    <a href="{{route('shop_user.edit',['id'=>$shop->id])}}" class=" btn btn-success">编辑</a>
                    <a href="{{route('shop_user.del',$shop->id)}}" class=" btn btn-danger">删除</a>
                    <a href="{{route('shop_user.clear',$shop->id)}}" class=" btn btn-info">重置密码</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$shops->appends($query)->links()}}
@endsection