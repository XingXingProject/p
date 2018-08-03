@extends('shop.layouts.default')
@section('title','订单按月统计显示页面')
@section('content')


    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <form class="navbar-form navbar-right">

                    <input type="date" name="start_time" class="form-control" size="2" placeholder="开始时间"
                           value="{{request()->input('start_time')}}"> -
                    <input type="date" name="end_time" class="form-control" size="2" placeholder="结束时间"
                           value="{{request()->input('end_time')}}">

                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </nav>

    <table class="table table-bordered table-hover">
        <tr class="warning">

            <th>日期date</th>
            <th>money总金额</th>
            <th>数量</th>

        </tr>
        @foreach($acts as $act)
            <tr class="info">

                <td>{{$act->date}}</td>
                <td>{{$act->money}}</td>
                <td>{{$act->count}}</td>

            </tr>
        @endforeach
    </table>

@endsection