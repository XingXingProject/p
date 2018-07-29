<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use App\Models\ShopInfo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopInfoController extends BaseController
{
    //商家信息显示功能
    public function index(Request $request)
    {
        //连表shopCategory查询
        $category=ShopCategory::all();
//        dd($category);

        //取到所有的值
        $query = $request->query();
        //接受所有的值
        $search = $request->input('search');

        //显示
        $shops = ShopInfo::where('shop_name', 'like', "%$search%")
            ->paginate(2);
        //显示视图
        return view('admin.info.info_index', compact('shops', 'query','category'));
    }


    //商家信息查看详情功能
    public function see(Request $request,$id)
    {
        $shop=ShopInfo::find($id);
//         dd($info);

        //显示视图
        return view('admin.info.see_index', compact('shop'));
    }


    /**
     * 商家分类
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $category=ShopCategory::all();
        //判断是否是post上传
        if ($request->isMethod('post')) {


            $data = $request->all();
//            dd($data);
            //判断图片是否上传
            $data['shop_img'] = '';

            if ($request->file('shop_img')!==null) {
//                $fileName = $request->file('shop_img')->store("shopInfo", "public_images");
                    //上传文件
                    $fileName= $request->file('shop_img')->store("tp","oss");

//                    dd(env("ALIYUN_OSS_URL").$fileName);//要保存到数据库
                $data['shop_img'] =  env("ALIYUN_OSS_URL").$fileName;
            }
//            dd($data["shop_img"]);
            //插入数据到表shopInfo
            $data['password']=bcrypt($data['password']);
            $info=ShopInfo::create($data);
            $data['id']=$info->id;

            //插入数据到表User表
            User::create($data);
            $info['shop_user_id']=$info->id;
            $info->save();
            //提示
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('shop_info.index');
        }

       // 显示视图
        return view('admin.info.info_reg',compact('category'));

    }


    /**
     * 商家分类编辑功能
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        //通过id找到数据库具体的数据
        $shop = ShopInfo::find($id);
        $category=ShopCategory::all();
        //判断是否是post上传
        if ($request->isMethod('post')) {

            $data = $request->all();
//             dd($data);
            //判断图片是否上传
            $data['shop_img'] = '';
            if ($request->file('shop_img')!==null) {

                $fileName= $request->file('shop_img')->store("tp","oss");

//                    dd(env("ALIYUN_OSS_URL").$fileName);//要保存到数据库
                $data['shop_img'] =  env("ALIYUN_OSS_URL").$fileName;
            }

            //添加数据
            $shop->update($data);
            //提示
            $request->session()->flash('success', '修改成功');
            //跳转
            return redirect()->route('shop_info.index');
        }

        //显示视图
        return view('admin.info.info_edit',compact('shop','category'));

    }

    /**
     * 商家分类删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request,$id){
        $shop=ShopInfo::find($id);
        $shop->delete();
        $user=User::find($id);
        $user->delete();
        //提示语句
        $request->session()->flash('success','删除成功');
        //显示视图
        return redirect()->route('shop_info.index');



    }




}
