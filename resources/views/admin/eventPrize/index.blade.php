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
    <a href="{{route('eventPrize.add')}}" class="btn btn-info">添加</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>活动id</th>
            <th>名称</th>
            <th>详情</th>
            <th>中奖商户id</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr class="info">
                <td>{{$event->id}}</td>
                <td>{{$event->event->title}}</td>
                <td>{{$event->name}}</td>
                <td>
                    <a href="{{route('eventPrize.see',$event->id)}}" class=" btn btn-success">查看详情</a>
                </td>
                @if($event->user_id)
                <td>{{$event->user->name}}</td>
                 @else
                    <td></td>
                @endif
                <td>
                    <a href="{{route('eventPrize.edit',$event->id)}}" class=" btn btn-success">编辑</a>

                    <a href="{{route('eventPrize.del',$event->id)}}" class=" btn btn-danger">删除</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{$events->appends($query)->links()}}
@endsection