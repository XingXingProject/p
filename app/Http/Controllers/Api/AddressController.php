<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends BaseController
{
    //添加用户地址
    public function add(Request $request)
    {
        //接收所有的参数
        $data = $request = $request->post();
//        dd($data);
        //验证
        $validate = Validator::make($data, [
            'name' => 'required',
            'tel' => 'required',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'detail_address' => 'required',
        ]);
        //如果验证出错
        if ($validate->failed()) {
            //返回错误信息
            return [
                'status' => 'false',
                'message' => $validate->errors()->first()
            ];
        }

        //添加新地址的时候改默认地址
        if (Address::create($data)) {
            Address::where('user_id', $data['user_id'])->where('is_default', '1')->first()->update(['is_default' => 0]);
        }
        return [
            "status" => "true",
            "message" => "添加成功"
        ];


    }

    //用户地址列表
    public function list(Request $request)
    {
        //得到所有的值
        $id = $request->input('user_id');
        $adds = Address::where('user_id', $id)->get();
        return $adds;


    }

    public function show(Request $request){

       return $data=Address::where('id',$request->post('id'))->first();
       return $data=Address::where('id',$request->post('id'))->first();
    }
    public function edit(Request $request)
    {

        //接收页面传过来的值
        $data=$request->all();
        //验证
        $validate = Validator::make($data, [
            'name' => 'required',
            'tel' => 'required',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'detail_address' => 'required',
        ]);
        //如果验证出错
        if ($validate->failed()) {
            //返回错误信息
            return [
                'status' => 'false',
                'message' => $validate->errors()->first()
            ];
        }
        $id=$data['id'];
        $ad=Address::findOrFail($id);
        $ad->update($data);
        return [
            'status' => 'false',
            'message' => '修改成功'

        ];

    }


}
