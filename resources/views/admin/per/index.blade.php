@extends('admin.layouts.default')
@section('title','权限显示页面')
@section('content')
    <a href="{{route('per.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>name</th>
            <th>guard_name</th>
            <th>操作</th>
        </tr>
        @foreach($pers as $per)
            <tr class="info">
                <td>{{$per->id}}</td>
                <td>{{$per->name}}</td>
                <td>{{$per->guard_name}}</td>
                <td>
                    <a href="{{route('per.edit',['id'=>$per->id])}}" class=" btn btn-success">编辑</a>
                    <a href="{{route('per.del',$per->id)}}" class=" btn btn-danger">删除</a>

                </td>
            </tr>
        @endforeach
    </table>
    {{$pers->links()}}
@endsection