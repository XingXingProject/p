@extends('admin.layouts.default')
@section('title','平台活动')
@section('content')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="{{route("active.add")}}" class="navbar-brand ">添加</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <form class="navbar-form navbar-right" method="get">

                    <laber>开始时间：</laber>
                    <input type="date" name="start_time" class="form-control" size="2" placeholder="开始时间"
                           value="{{request()->input('start_time')}}">
                    <laber>结束时间：</laber>
                    <input type="date" name="end_time" class="form-control" size="2" placeholder="结束时间"
                           value="{{request()->input('end_time')}}">
                    <div class="form-group">
                        <input type="text" name="search" value="{{request()->input('search')}}" class="form-control" placeholder="活动名称">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </nav>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>id</th>
            <th>title</th>
            <th>content</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($acts as $act)
        <tr class="info">
            <td>
                {{$act->id}}
            </td>
            <td>
                {{$act->title}}
            </td>
            <td>
                <a href="{{route('active.see',$act->id)}}" class=" btn btn-success">查看详情</a>

            </td>

            <td>
                {{$act->start_time}}
            </td>


            <td>
                {{$act->end_time}}
            </td>

            <td>
                <a href="{{route('active.edit',$act->id)}}" class=" btn btn-success">编辑</a>
                <a href="{{route('active.del',$act->id)}}" class=" btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$acts->appends($date)->links()}}
@endsection