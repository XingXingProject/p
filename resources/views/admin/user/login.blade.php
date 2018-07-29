@extends('admin.layouts.default')
@section('title','商家注册页面')
@section('content')
    <form class="form-horizontal" method="post" action="">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">输入姓名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="姓名" name="name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">输入密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> 记住密码
                    </label>
                </div>
            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<div class="col-sm-offset-2 col-sm-10">--}}
                {{--<label for="inputEmail3" class="col-sm-2 control-label">验证码</label>--}}
                {{--<div class="col-sm-5">--}}
                    {{--<input id="captcha" class="form-control" name="captcha" >--}}
                    {{--<img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-group">

        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">登录</button>
            </div>
        </div>
    </form>
@endsection