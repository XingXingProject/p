@extends('admin.layouts.default')
@section('title','商家分类编辑页面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">分类名称</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="分类名称" name="name" value="{{old('name',$shop->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">图片上传</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" id="inputEmail3" placeholder="" name="img" value="{{old("img")}}">
                @if($shop->img)
                    <img src="{{$shop->img}}" width="50" >
                @endif
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