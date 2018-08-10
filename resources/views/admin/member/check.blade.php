@extends('admin.layouts.default')
@section('title','充值界面')
@section('content')
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">充值</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="inputEmail3" placeholder="充值" name="money"
                       value="{{old('money')}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">确定</button>
            </div>
        </div>

    </form>
@endsection