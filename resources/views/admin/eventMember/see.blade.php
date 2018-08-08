@extends('admin.layouts.default')
@section('title','平台活动')
@section('content')
    <a href="{{route('event.index')}}"  class=" btn btn-info ">返回</a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>活动内容</th>
        </tr>

        <tr class="info">

            <td>
                    {!!$event->content!!}

            </td>


        </tr>

    </table>

@endsection