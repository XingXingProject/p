@extends('shop.layouts.default')
@section('title','商家管理添加页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="名称" name="goods_name" value="{{old('goods_name')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">评分</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="评分" name="rating" value="{{old('rating')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-6">
                所属商家分类：<select name="shop_info_id">
                    <option value="#">请选择分类</option>
                    @foreach($infos as $info)
                        <option value="{{$info->id}}">{{$info->shop_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-6">
                分类：<select name="category_id">
                    <option value="#">请选择分类</option>
                    @foreach($cates as $cate)
                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">价格</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="价格" name="goods_price" value="{{old('goods_price')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="价格" name="description" value="{{old('description')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">月销量</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="月销量" name="month_sales" value="{{old('month_sales')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">评分数量</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="评分数量" name="rating_count" value="{{old('rating_count')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="提示信息" name="tips" value="{{old('tips')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">满意度数量</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="满意度数量" name="satisfy_count" value="{{old('satisfy_count')}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">图片上传</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="inputEmail3"  name="goods_img">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">状态</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="status"  value="1"   > 显示
                    </label>
                    <label>
                        <input type="radio" name="status" value="0" > 隐藏
                    </label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">添加</button>
            </div>
        </div>
    </form>
@endsection