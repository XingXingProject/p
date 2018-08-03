@extends('admin.layouts.default')
@section('title','商家管理添加页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家店铺名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="商家店铺名称" name="shop_name"
                       value="{{old('name')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-6">
                分类：<select name="shop_category_id">
                    <option value="#">请选择分类</option>
                    @foreach($category as $cate)
                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">图片上传</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="inputEmail3" placeholder="" name="shop_img"
                       value="{{old("shop_img")}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店铺评分</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="店铺评分" name="shop_rating"
                       value="{{old('shop_rating')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否是品牌</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="brand" value="1" > 是
                    </label>
                    <label>
                        <input type="radio" name="brand" value="0" > 否
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否准时送达</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="on_time" value="1" > 是
                    </label>
                    <label>
                        <input type="radio" name="on_time" value="0" > 否
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否蜂鸟配送</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="fengniao" value="1" > 是
                    </label>
                    <label>
                        <input type="radio" name="fengniao" value="0" > 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否保标记</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="bao" value="1" > 是
                    </label>
                    <label>
                        <input type="radio" name="bao" value="0" > 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否票标记</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="piao" value="1" > 是
                    </label>
                    <label>
                        <input type="radio" name="piao" value="0" > 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否准标记</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="zhun" value="1" > 是
                    </label>
                    <label>
                        <input type="radio" name="zhun" value="0" > 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">起送金额</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="起送金额" name="start_send"
                       value="{{old('start_send')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="配送费" name="start_cost"
                       value="{{old('start_cost')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店公告</label>
            <div class="col-sm-6">
                <input type="text" name="notice" value="{{old('notice')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-6">
                <input type="text" name="discount" value="{{old('discount')}}">

            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家名字</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="商家名字" name="name" value="{{old('name')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" id="inputEmail3" placeholder="商家email" name="email" value="{{old('email')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="inputEmail3" placeholder="商家密码" name="password" value="{{old('password')}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">注册</button>
            </div>
        </div>
    </form>
@endsection