@extends('admin.layouts.default')
@section('title','管理员添加页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">title</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="活动公告" name="title" value="{{old('title')}}">
            </div>
        </div>

活动内容：<!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
            });
        </script>

        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain"></script>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">活动开始时间</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="inputEmail3" placeholder="管理员密码" name="start_time" value="{{old('start_time')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">活动结束时间</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="inputEmail3" placeholder="" name="end_time" value="{{old('end_time')}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>
@endsection
