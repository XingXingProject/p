@extends('admin.layouts.default')
@section('title','管理员编辑页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="商家名称" name="name" value="{{old('name',$user->name)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" id="inputEmail3" placeholder="商家email" name="email" value="{{old('email',$user->email)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">管理员密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="inputEmail3" placeholder="管理员旧密码" name="password" value="">



            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">管理员新密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="inputEmail3" placeholder="管理员新密码" name="re_password" value="">



            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">状态</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="status" value="1" @if($user->status===1) checked @endif> 启用
                    </label>
                    <label>
                        <input type="radio" name="status" value="0" @if($user->status===0) checked @endif> 禁用
                    </label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">修改</button>
            </div>

        </div>
    </form>
@endsection