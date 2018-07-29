@extends('shop.layouts.default')
@section('title','平台活动')
@section('content')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="{{route("active.add")}}" class="navbar-brand ">添加</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <form class="navbar-form navbar-right" method="get">

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
                {{$act->start_time}}
            </td>


            <td>
                {{$act->end_time}}
            </td>

            <td>
                <a href="{{route('active.show',$act->id)}}" class=" btn btn-success">查看</a>

            </td>
        </tr>
        @endforeach
    </table>
    {{$acts->links()}}
@endsection