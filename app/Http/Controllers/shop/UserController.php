<?php

namespace App\Http\Controllers\shop;

use App\Models\ShopCategory;
use App\Models\ShopInfo;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    //商家登录
    public function joins(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证是否合格
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required'
            ]);

            //验证登录
            if (Auth::attempt(['name' => $request->post('name'), 'password' => $request->post('password')], $request->has('remember'))) {
//提示

                if (Auth::user()->status === 0) {
                    Auth::logout();
                    return redirect()->route('user.joins')->with('danger', "您登陆的商家商户已被禁用");
                }
                $request->session()->flash('success', "登录成功");
                //跳转  intended 从哪来回哪去
                return redirect()->intended(route('menuCategory.index'));
            } else {
                //提示
                $request->session()->flash('danger', "账号或密码错误");
                //跳转  intended 从哪来回哪去
                return redirect()->intended(route('user.joins'));
            }

        }

        //显示视图
        return view('shop.shopuser.join');
    }


    //商家注册
    public function reg(Request $request)
    {
        //连表
        $category = ShopCategory::all();
        //判断是否是post提交
        if ($request->isMethod('post')) {
//            echo "11";exit;
            //判断图片是否上传
            $data = $request->all();
//            dd($data);
            $data['shop_img'] = '';

            if ($request->file('shop_img') !== null) {
//                $fileName = $request->file('shop_img')->store("shopInfo", "public_images");
                //上传文件
                $fileName = $request->file('shop_img')->store("tp", "oss");

//                    dd(env("ALIYUN_OSS_URL").$fileName);//要保存到数据库
                $data['shop_img'] = env("ALIYUN_OSS_URL") . $fileName;
            }
            //插入数据到表shopInfo
            $data['password'] = bcrypt($data['password']);
            $info = ShopInfo::create($data);
            $data['id'] = $info->id;
            //插入数据到表shopUser
            User::create($data);
            $info['shop_user_id'] = $info->id;
            //跳转
            return redirect()->route('user.joins');
        }


        return view('shop.shopuser.reg', compact('category'));
    }

//商户退出
    public function logout(Request $request)
    {

        //提示
        Auth::logout();
        $request->session()->flash("success", "退出成功");
        //跳转
        return redirect()->route('user.reg');
    }


}
