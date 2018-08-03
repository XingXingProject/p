@extends('admin.layouts.default')
@section('title','权限显示页面')
@section('content')
    <a href="{{route('role.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>角色组</th>
            <th>guard_name</th>
            <th>所属权限</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr class="info">
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->guard_name}}</td>
                <td>{{ str_replace(['[',']','"'],'', $role->permissions()->pluck('name')) }}</td>
                <td>
                    <a href="{{route('role.edit',['id'=>$role->id])}}" class=" btn btn-success">编辑</a>
                    <a href="{{route('role.del',$role->id)}}" class=" btn btn-danger">删除</a>

                </td>
            </tr>
        @endforeach
    </table>
    {{--{{$roles->appends($query)->links()}}--}}
@endsection