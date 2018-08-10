@extends('admin.layouts.default')
@section('title','抽奖活动页面')
@section('content')
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>活动名称</th>
            <th>报名商家</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr class="info">
                <td>{{$event->id}}</td>
                <td>{{$event->event->title}}</td>
                <td>{{$event->user->name}}</td>
                <td>
                    <a href="{{route('eventMember.edit',$event->id)}}" class=" btn btn-success">编辑</a>

                    <a href="{{route('eventMember.del',$event->id)}}" class=" btn btn-danger">删除</a>
                </td>

            </tr>
        @endforeach
    </table>
@endsection