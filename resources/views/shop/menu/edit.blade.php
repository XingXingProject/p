@extends('shop.layouts.default')
@section('title','菜品编辑页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="名称" name="name" value="{{old('name',$menu->name)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">评分</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="评分" name="rating" value="{{old('rating',$menu->rating)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-6">
                所属商家分类：<select name="shop_info_id">
                    <option value="#">请选择分类</option>
                    @foreach($infos as $info)
                        <option value="{{$info->id}}" @if($info->id===$menu->shop_info_id)selected @endif>{{$info->shop_name}}</option>
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
                        <option value="{{$cate->id}}" @if($cate->id==$menu->category_id) selected @endif>{{$cate->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">价格</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="价格" name="goods_price" value="{{old('goods_price',$menu->goods_price)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="价格" name="description" value="{{old('description',$menu->description)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">月销量</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="月销量" name="month_sales" value="{{old('month_sales',$menu->month_sales)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">评分数量</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="评分数量" name="rating_count" value="{{old('rating_count',$menu->rating_count)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">提示信息</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="提示信息" name="tips" value="{{old('tips',$menu->tips)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">满意度数量</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="满意度数量" name="satisfy_count" value="{{old('satisfy_count',$menu->satisfy_count)}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">图片上传</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="inputEmail3"  name="goods_img"
                       >
                @if($menu->goods_img)
                    <img src="{{$menu->goods_img}}" width="50">
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">状态</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="status"  value="1"  @if($cate->status===1) checked @endif > 显示
                    </label>
                    <label>
                        <input type="radio" name="status" value="0"  @if($cate->status===0) checked @endif> 隐藏
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