@extends('admin.layouts.default')
@section('title','商家分类显示页面')
@section('content')
    <form class="form-inline" action="" method="get">
        <div class="form-group navbar-right col-lg-3" >
            <input type="text" class="form-control" name="search" placeholder="搜索">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>
        <div class="form-group">
        </div>
    </form>
    <a href="{{route('shop_category.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>name</th>
            <th>img</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr class="info">
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                <td>
                    @if($shop->img)
                        <img src="{{$shop->img}}" width="50" >
                    @endif
                </td>
                <td>
                    @if($shop->status===1)
                    <span class="glyphicon glyphicon-ok"></span>
                    @endif

                </td>
                <td>
                    <a href="{{route('shop_category.edit',['id'=>$shop->id])}}" class=" btn btn-success">编辑</a>
                    <a href="{{route('shop_category.del',$shop->id)}}" class=" btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$shops->appends($query)->links()}}
@endsection