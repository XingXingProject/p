@extends('admin.layouts.default')
@section('title','nav')
@section('content')
    <form class="form-inline" action="" method="get">
        <div class="form-group navbar-right col-lg-3" >
            <input type="text" class="form-control" name="search" placeholder="搜索">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>
        <div class="form-group">
        </div>
    </form>
    <a href="{{route('nav.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>name</th>
            <th>url</th>
            <th>parent_id</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
            <tr class="info">
                <td>{{$nav->id}}</td>
                <td>{{$nav->name}}</td>
                <td>{{$nav->url}}</td>
                <td>{{$nav->parent_id}}</td>
                <td>
                    <a href="{{route('nav.edit',['id'=>$nav->id])}}" class=" btn btn-success">编辑</a>
                    <a href="{{route('nav.del',$nav->id)}}" class=" btn btn-danger">删除</a>

                </td>
            </tr>
        @endforeach
    </table>
    {{$navs->appends($query)->links()}}
@endsection