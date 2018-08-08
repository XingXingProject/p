@extends('/admin.layouts.default')
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
    <a href="{{route('event.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖时间</th>
            <th>报名人数限制</th>
            <th>是否已经开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr class="info">
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>
                    <a href="{{route('event.see',$event->id)}}" class=" btn btn-success">查看详情</a>
                </td>

                <td>{{$event->start_time}}</td>
                <td>{{$event->end_time}}</td>
                <td>{{$event->prize_time}}</td>
                <td>{{$event->num}}</td>
                <td>
                    @if($event->is_prize===1)
                        <span class="glyphicon glyphicon-ok" style="color: green"></span>
                     @else
                        <span class="glyphicon glyphicon-remove" style="color: red"></span>
                    @endif
                </td>
                <td>
                    <a href="{{route('event.edit',$event->id)}}" class=" btn btn-success">编辑</a>

                    <a href="{{route('event.del',$event->id)}}" class=" btn btn-danger">删除</a>
                    <a href="{{route('event.prize',$event->id)}}" class=" btn btn-danger">抽奖</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{$events->appends($query)->links()}}
@endsection