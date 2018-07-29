@extends('admin.layouts.default')
@section('title','商家页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="商家名称" name="name" value="{{old('name')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" id="inputEmail3" placeholder="商家email" name="email" value="{{old('email')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家email</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="inputEmail3" placeholder="商家密码" name="password" value="{{old('password')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">状态</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="status" value="1"  > 显示
                    </label>
                    <label>
                        <input type="radio" name="status" value="0"  > 隐藏
                    </label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-6">

                <input type="shop_id" class="form-control" id="inputEmail3" placeholder="所属商家" name="shop_id" value="{{old('shop_id')}}">
            </div>
        </div>




        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">修改</button>
            </div>
        </div>
    </form>
@endsection