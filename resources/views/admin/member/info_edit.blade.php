@extends('admin.layouts.default')
@section('title','商家管理编辑页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="商家名称" name="shop_name"
                       value="{{old('name',$shop->shop_name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-6">
                分类：<select name="shop_category_id">
                    <option value="#">请选择分类</option>
                    @foreach($category as $cate)
                        <option value="{{$cate->id}}"<?php if ($cate->id === $shop->shop_category_id) {
                            echo "selected";
                        }?>>{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">图片上传</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="inputEmail3" placeholder="" name="shop_img"
                       value="{{old("shop_img")}}">
                @if($shop->shop_img)
                    <img src="{{$shop->shop_img}}" width="50">
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店铺评分</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="店铺评分" name="shop_rating"
                       value="{{old('shop_rating',$shop->shop_rating)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否是品牌</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="brand" value="1" @if($shop->brand===1) checked @endif> 是
                    </label>
                    <label>
                        <input type="radio" name="brand" value="0" @if($shop->brand===0) checked @endif> 否
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否准时送达</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="on_time" value="1" @if($shop->on_time===1) checked @endif> 是
                    </label>
                    <label>
                        <input type="radio" name="on_time" value="0" @if($shop->on_time===0) checked @endif> 否
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否蜂鸟配送</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="fengniao" value="1" @if($shop->fengniao===1) checked @endif> 是
                    </label>
                    <label>
                        <input type="radio" name="fengniao" value="0" @if($shop->fengniao===0) checked @endif> 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否保标记</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="bao" value="1" @if($shop->bao===1) checked @endif> 是
                    </label>
                    <label>
                        <input type="radio" name="bao" value="0" @if($shop->bao===0) checked @endif> 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否票标记</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="piao" value="1" @if($shop->piao===1) checked @endif> 是
                    </label>
                    <label>
                        <input type="radio" name="piao" value="0" @if($shop->piao===0) checked @endif> 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否准标记</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="zhun" value="1" @if($shop->zhun===1) checked @endif> 是
                    </label>
                    <label>
                        <input type="radio" name="zhun" value="0" @if($shop->zhun===0) checked @endif> 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">起送金额</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="起送金额" name="start_send"
                       value="{{old('start_send',$shop->start_send)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="配送费" name="start_cost"
                       value="{{old('start_cost',$shop->start_cost)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店公告</label>
            <div class="col-sm-6">
                <textarea name="notice" >
                    {{old('notice',$shop->notice)}}
                </textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-6">
                <textarea name="discount" >
                    {{old('discount',$shop->discount)}}
                </textarea>
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
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">修改</button>
            </div>
        </div>
    </form>
@endsection