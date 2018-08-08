@extends('shop.layouts.default')
@section('title','平台抽奖报名页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="event_id" value="{{old("event_id" )}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">报名人</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="user_id" value="{{old("user_id",$user->name)}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">确定参加</button>
            </div>
        </div>
    </form>
@endsection