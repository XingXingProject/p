@extends('shop.layouts.default')
@section('title','菜品表显示页面')
@section('content')

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="{{route("menu.add")}}" class="navbar-brand ">添加</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <form class="navbar-form navbar-right">
                    <div class="form-group">
                        <select name="category_id" class="form-control">
                            <option value="">请选择分类</option>
                            @foreach($cates as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" name="minPrice" class="form-control" size="2" placeholder="最低价"
                           value="{{request()->input('minPrice')}}"> -
                    <input type="text" name="maxPrice" class="form-control" size="2" placeholder="最高价"
                           value="{{request()->input('maxPrice')}}">
                    <div class="form-group">
                        <input type="text" name="search" value="{{request()->input('search')}}" class="form-control" placeholder="菜品名称">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </nav>

    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>名称</th>
            <th>评分</th>
            <th>所属商家</th>
            <th>所属分类ID</th>
            <th>价格</th>
            <th>描述</th>
            <th>月销量</th>
            <th>评分数量</th>
            <th>提示信息</th>
            <th>满意度数量</th>
            <th>满意度评分</th>
            <th>商品图片</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menuCate)
            <tr class="info">
                <td>{{$menuCate->id}}</td>
                <td>{{$menuCate->goods_name}}</td>
                <td>{{$menuCate->rating}}</td>
                <td>

                    {{$menuCate->shopinfo->shop_name}}
                </td>
                <td>{{$menuCate->menuCategory->name}}</td>
                <td>{{$menuCate->goods_price}}</td>
                <td>{{$menuCate->description}}</td>
                <td>{{$menuCate->month_sales}}</td>
                <td>{{$menuCate->rating_count}}</td>
                <td>{{$menuCate->tips}}</td>
                <td>{{$menuCate->satisfy_count}}</td>
                <td>{{$menuCate->satisfy_rate}}</td>
                <td>
                    @if($menuCate->goods_img)
                        <img src="{{$menuCate->goods_img}}" width="50" >
                    @endif

                </td>
                <td>
                    @if($menuCate->status===1)
                    <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove" style="color: red"></span>
                    @endif

                </td>
                <td>
                    <a href="{{route('menu.edit',$menuCate->id)}}" class=" btn btn-success">编辑</a>
                    <a href="{{route('menu.del',$menuCate->id)}}" class=" btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$menus->links()}}
@endsection