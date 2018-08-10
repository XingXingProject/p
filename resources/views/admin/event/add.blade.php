@extends('admin.layouts.default')
@section('title','平台抽奖添加页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="名称" name="title">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">报名人数限制</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="num" value="{{old("num")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">报名开始时间</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="inputEmail3" placeholder="" name="start_time" value="{{old("start_time")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">报名结束时间</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="inputEmail3" placeholder="" name="end_time" value="{{old("end_time")}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">开奖时间</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="inputEmail3" placeholder="" name="prize_time" value="{{old("prize_time")}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否开奖</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="is_prize" value="1"> 是
                    </label>
                    <label>
                        <input type="radio" name="is_prize" value="0"> 否
                    </label>
                </div>
            </div>
        </div>


        活动详情：<!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>

        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain">
            {{--{!! $act->content !!}--}}
        </script>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>
@endsection