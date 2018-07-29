@extends('admin.layouts.default')
@section('title','管理员显示页面')
@section('content')
    <form class="form-inline" action="" method="get">
        <div class="form-group navbar-right col-lg-3" >
            <input type="text" class="form-control" name="search" placeholder="搜索">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>
        <div class="form-group">
        </div>
    </form>
    <a href="{{route('admin.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>是否审核</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr class="info">
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->status===1)
                        <a href="#"></a>
                    <span class="glyphicon glyphicon-ok"></span>
                    @else
                        <span class="glyphicon glyphicon-remove"></span>
                    @endif

                </td>
                <td>
                    <a href="{{route('admin.edit',['id'=>$user->id])}}" class=" btn btn-success">编辑</a>
                    <a href="{{route('admin.del',$user->id)}}" class=" btn btn-danger">删除</a>

                    <a href="{{route('admin.check',$user->id)}}" class=" btn btn-info">审核</a>

                </td>
            </tr>
        @endforeach
    </table>
    {{$users->appends($query)->links()}}
@endsection