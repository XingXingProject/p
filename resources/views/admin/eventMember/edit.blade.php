@extends('admin.layouts.default')
@section('title','平台编辑页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-6">
                <input type="text"  id="inputEmail3" placeholder="名称" value="{{old('title',$event->eve->title)}}" name="event_id">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">参与老板名字</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" name="user_id" value="{{old("user_id",$event->user->name)}}">
            </div>
        </div>





        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">编辑</button>
            </div>
        </div>
    </form>
@endsection