@extends('admin.layouts.default')
@section('title','商家管理添加页面')
@section('content')
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">角色名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control">
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<label class="col-sm-2 control-label">权限名称</label>--}}
            {{--<div class="col-sm-10">--}}
                {{--@foreach($pers as $per)--}}
                    {{--<input type="checkbox" name="per[]" value="{{$per->name}}">{{$per->name}}--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <label class="col-sm-2 control-label">权限名称</label>
            <div class="col-sm-10">
                    <select name="per[]"  multiple="multiple">
                        <option value="#">请选择</option>
                        @foreach($pers as $per)

                        <option value="{{$per->name}}">{{$per->name}}</option>
                        @endforeach
                    </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
@endsection