@extends('shop.layouts.default')
@section('title','菜品分类添加页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜品分类名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control"  placeholder="菜品分类名称" name="name" value="{{old('name',$menuCate->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜品分类ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$menuCate->type_id}}" placeholder="菜品分类ID" name="type_id">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜品描述</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$menuCate->description}}" placeholder="菜品描述" name="description">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-6">
                分类：<select name="shop_info_id">
                    <option value="#">请选择分类</option>
                    @foreach($infos as $info)
                        <option value="{{$info->id}}" @if($info->id===$menuCate->shop_info_id)
                            selected @endif>{{$info->shop_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">状态</label>
            <div class=" col-sm-6">
                <div class="checkbox">
                    <label>
                        <input type="radio" name="status"  value="1" @if($menuCate->status==1) checked @endif > 显示
                    </label>
                    <label>
                        <input type="radio" name="status" value="0" @if($menuCate->status==0) checked @endif> 隐藏
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