@extends('admin.layouts.default')
@section('title','平台抽奖添加页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-6">
                分类：<select name="event_id">
                    <option value="#">请选择活动</option>
                    @foreach($actives as $active)
                        <option value="{{$active->id}}">{{$active->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">奖品名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="name" value="{{old("name")}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">中奖商户名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="" name="user_id" value="">
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
        <script id="container" name="description" type="text/plain">
            {{--{!! $act->content !!}--}}
        </script>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>
@endsection