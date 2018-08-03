@extends('/admin.layouts.default')
@section('title','会员显示页面')
@section('content')
    <form class="form-inline" action="" method="get">
        <div class="form-group navbar-right col-lg-3" >
            <input type="text" class="form-control" name="search" placeholder="搜索">
            <button type="submit" class="btn btn-default">搜索</button>
        </div>
        <div class="form-group">
        </div>
    </form>
    {{--<a href="{{route('shop_info.add')}}" class="btn btn-info">添加</a>--}}
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>会员名称</th>
            <th>是否启用</th>

            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr class="info">
                <td>{{$member->id}}</td>
                <td>{{$member->username}}</td>
                <td>
                    @if($member->status===1)
                        <span class="glyphicon glyphicon-ok" style="color: green"></span>
                    @else
                        <span class="glyphicon glyphicon-remove" style="color: red "></span>
                    @endif

                </td>


                <td>
                    <a href="{{route('member.info',$member->id)}}" class=" btn btn-success">查看详情</a>
                    @if($member->status==1)
                    <a href="{{route('member.check',$member->id)}}" class=" btn btn-danger">禁用</a> @else
                    <a href="{{route('member.check',$member->id)}}" class=" btn btn-info">启用</a>
                    @endif
                    {{--<a href="{{route('shop_info.del',$member->id)}}" class=" btn btn-danger">删除</a>--}}
                </td>

            </tr>
        @endforeach
    </table>
    {{$members->appends($query)->links()}}
@endsection