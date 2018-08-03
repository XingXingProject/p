@extends('admin.layouts.default')
@section('title','会员信息显示页面')
@section('content')

   </a>
    <table class="table table-bordered table-hover">
        <tr class="warning">
            <th>会员余额</th>
            <th>会员积分</th>
            <th>会员电话</th>
            <th>操作</th>
        </tr>
            <tr class="info">
                <td>
                    {{$member->money}}
                </td>
                <td>
                    {{$member->jifen}}
                </td>
                <td>{{$member->tel}}</td>

                <td>
                    <a href="{{route('member.index',$member->id)}}" class=" btn btn-success">返回</a>

                </td>

            </tr>
    </table>
@endsection