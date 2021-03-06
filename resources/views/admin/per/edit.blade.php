@extends('admin.layouts.default')
@section('title','商家管理添加页面')
@section('content')
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">权限名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="{{old('name',$per->name)}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">guard_name</label>
            <div class="col-sm-10">
                <input type="text" name="guard_name" class="form-control" value="{{old('guard_name',$per->guard_name)}}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
@endsection