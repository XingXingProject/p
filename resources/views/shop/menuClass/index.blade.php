@extends('shop.layouts.default')
@section('title','菜品分类显示页面')
@section('content')
    <form class="form-inline" action="" method="get">
        <div class="form-group navbar-right col-lg-3" >
            <input type="text" class="form-control" name="search" placeholder="搜索">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>
        <div class="form-group">
        </div>
    </form>
    <a href="{{route('menuCategory.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>菜品名称</th>
            <th>菜品编号</th>
            <th>菜品描述</th>
            <th>所属商家</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menuCates as $menuCate)
            <tr class="info">
                <td>{{$menuCate->id}}</td>
                <td>{{$menuCate->name}}</td>
                <td>{{$menuCate->type_accumulation}}</td>
                <td>{{$menuCate->description}}</td>
                <td>

                    {{$menuCate->shopinfo->shop_name}}
                </td>
                <td>
                    @if($menuCate->status===1)
                    <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove" style="color: red"></span>
                    @endif

                </td>
                <td>
                    <a href="{{route('menuCategory.edit',['id'=>$menuCate->id])}}" class=" btn btn-success">编辑</a>
                    <a href="{{route('menuCategory.del',$menuCate->id)}}" class=" btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$menuCates->appends($query)->links()}}
@endsection