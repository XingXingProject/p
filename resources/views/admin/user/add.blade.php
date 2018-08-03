@extends('admin.layouts.default')
@section('title','管理员添加页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">管理员名字</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="管理员名字" name="name" value="{{old('name')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">管理员email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" id="inputEmail3" placeholder="管理员email" name="email" value="{{old('email')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">管理员密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="inputEmail3" placeholder="管理员密码" name="password" value="{{old('password')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">角色名称</label>
            <div class="col-sm-10">
                @foreach($roles as $role)
                    <input type="checkbox" name="per[]" value="{{$role->name}}">{{$role->name}}
                @endforeach
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="inputEmail3" class="col-sm-2 control-label">状态</label>--}}
            {{--<div class=" col-sm-6">--}}
                {{--<div class="checkbox">--}}
                    {{--<label>--}}
                        {{--<input type="radio" name="status" value="1"  > 启用--}}
                    {{--</label>--}}
                    {{--<label>--}}
                        {{--<input type="radio" name="status" value="0"  > 禁用--}}
                    {{--</label>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>
@endsection