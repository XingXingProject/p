@extends('shop.layouts.default')
@section('title','抽奖活动页面')
@section('content')
    <form class="form-inline" action="" method="get">
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
            <th>名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖时间</th>
            <th>报名人数限制</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr class="info">
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>
                    <a href="{{route('eventShop.see',$event->id)}}" class=" btn btn-success">查看详情</a>
                </td>

                <td>{{$event->start_time}}</td>
                <td>{{$event->end_time}}</td>
                <td>{{$event->prize_time}}</td>
                <td>{{$event->num}}</td>
                <td>
                    @if($event->is_prize===1)
                        <a href="{{route('eventShop.read',$event->id)}}" class="btn btn-info">结果</a>
                     @else
                        <a href="#" class="btn btn-info">未开奖</a>
                    @endif
                </td>
                <td>
                    <a href="{{route('eventShop.add',$event->id)}}" class="btn btn-info">我要报名</a>

                </td>

            </tr>
        @endforeach
    </table>
    {{$events->appends($query)->links()}}
@endsection