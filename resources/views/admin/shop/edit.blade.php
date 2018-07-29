@extends('admin.layouts.default')
@section('title','商家编辑页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家老板</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="商家名称" name="name" value="{{old('name',$shop->name)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" id="inputEmail3" placeholder="商家email" name="email" value="{{old('email',$shop->email)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="inputEmail3" placeholder="商家密码" name="password" value="{{old('password')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">状态</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="status" value="1" @if($shop->status===1) checked @endif> 显示
                    </label>
                    <label>
                        <input type="radio" name="status" value="0" @if($shop->status===0) checked @endif> 隐藏
                    </label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="所属店铺" name="shop_name" value="{{$shop->shopInfo->shop_name}}">
            </div><lable>！请去商家信息表修改所属商家</lable>
        </div>




        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">修改</button>
            </div>
        </div>
    </form>
@endsection