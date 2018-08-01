<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends BaseController
{
    /**
     * 接收短信
     */
    public function sms()
    {
        //接收tel
        $tel = \request()->input('tel');
        //随机产生验证码
        $code = rand(1000, 9000);
        //存验证码 存Redis里面  ["tel_123456"=>1245];  只能存5分钟
        Redis::setex("tel_" . $tel, 300, $code);

//       dd( Redis::get("tel_" . $tel));
        //测试
        return [
            "status" => "true",
            "message" => "获取短信验证码成功" . $code
        ];

//        $config = [
//            'access_key' => 'LTAIylMWxorh14gn',
//            'access_secret' => 'cA2kpj4Ztn6WiJBZXFkHzkAo8dXrxK',
//            'sign_name' => '邓可星',
//        ];
//          $aliSms = new AliSms();
//       // 调用接口发送短信
//         $response = $aliSms->sendSms($tel, 'SMS_140665170', ['code' => $code], $config);
//        exit;

        //判断
        if ($response->Message === "OK") {

            return [
                "status" => "true",
                "message" => "获取短信验证码成功"
            ];

        } else {
            return [
                "status" => "false",
                "message" => $response->Message

            ];
        }

    }

    /**
     * 用户注册
     */
    public function reg(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //页面验证
            $validate = Validator::make($data, [
                'username' => 'required|unique',
                'password' => 'required|unique',
                'sms' => 'required|integer|min:1000|max:9999',
                'tel' => [
                    'required',
                    'regex:/^0?(13|14|15|18)[0-9]{9}$/',
                    'unique:members'
                ]
            ]);
            //如果验证出错
            if ($validate->failed()) {
                //返回错误信息
                return [
                    'status' => 'false',
                    'message' => $validate->errors()->first()
                ];

            }
//取出验证码
$sms = Redis::get("tel_" . $data['tel']);

            if ($sms !== $data['sms']) {
                return [
                    'status' => 'false',
                    'message' => "验证码错误"
                ];
            }

            //取出密码加密
            $data['password'] = bcrypt($data['password']);

            //入库
            Member::create($data);
            return [
                'status' => "true",
                "message" => "添加成功"
            ];

        }


    }

    /**用户登录
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        //接收页面传过来的数据
        $data = $request->all();
        //接收页面传来的所有数据
        $data['username'] = $request->post('name');
        $data['password'] = $request->post('password');
        //1.先通过用户名找当前用户
        $member = Member::where('username', $data['username'])->first();

        //2.如果用户密码存在 再来验证密码  Hash:check 如果密码也成功 登录成功
        if ($member && Hash::check($data['password'], $member['password'])) {
            return [
                'status' => "true",
                'message' => "登陆成功",
                'user_id' => $member->id,
                'username' => $member->name

            ];
        } else {

            return [
                'status' => "false",
                'message' => "登陆失败"

            ];
        }
    }


    /**
     * 忘记密码
     * @param Request $request
     * @return array
     */
    public function forget(Request $request)
    {
        //得到输入的电话号码
        $data = $request->post();

        //发送短信验证
        //页面验证
        $validate = Validator::make($data, [
            'username' => 'required|unique',
            'password' => 'required|unique',
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|18)[0-9]{9}$/',
                'unique:members'
            ]
        ]);
        //如果验证出错
        if ($validate->failed()) {
            //返回错误信息
            return [
                'status' => 'false',
                'message' => $validate->errors()->first()
            ];

        }
        //取出验证码
        $sms = Redis::get("tel_" . $data['tel']);
        //通过电话号码找到用户
        $member = Member::where('tel', $data['tel'])->first();
//        dd($member);
        if ($sms=$data['sms']) {
            $data['password'] = bcrypt($data['password']);
            $member->password = $data['password'];
            //入库
            $member->save();
            return [
                "status" => "true",
                "message" => "添加成功"
            ];

        }


    }

    /**
     * 修改密码
     * @param Request $request
     * @return array
     */
    public function change(Request $request)
    {
        //接收传过来的password
           $data= $request->post();
         $member= Member::findOrFail($data['id']);
        if(Hash::check($data['oldPassword'],$member->password)){
            $member->password=bcrypt($data['newPassword']);
            $member->save();
            return [
                "status" => "true",
                "message" => "修改成功"
            ];
        }

    }

    /**
     * 商品详细信息
     * @param Request $request
     */
    public function detail(Request $request)
    {
        $id=$request->post('user_id');
         $mem= Member::where('id',$id)->first();
         return $mem;

    }




}
