<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use App\Models\ShopInfo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends BaseController
{

    public function index(Request $request)
    {
        //连表shop_info
        $info = ShopInfo::all();
//        dd($info);
        //取到所有的值
        $query = $request->query();
        //接受所有的值
        $search = $request->input('search');

        //显示
        $shops = User::where('name', 'like', "%$search%")
            ->paginate(2);
        //显示视图
        return view('admin.shop.index', compact('shops', 'query', 'info'));
    }


    /**
     * 商家分类
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
//    public function add(Request $request)
//    {
//        ShopCategory::all();
//        //判断是否是post上传
//        if ($request->isMethod('post')) {
//            //添加数据
//            User::create($request->post());
//            //提示
//            $request->session()->flash('success', '添加成功');
//            //跳转
//            return redirect()->route('shop_user.index');
//        }
//
//        //显示视图
//        return view('admin.shop.add');
//
//    }


    /**
     * 商家分类编辑功能
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        //通过id找到数据库具体的数据
        $shop = User::find($id);
        //判断是否是post上传
        if ($request->isMethod('post')) {
            //添加数据

            $shop->update($request->all());
            //提示
            $request->session()->flash('success', '修改成功');
            //跳转
            return redirect()->route('shop_user.index');
        }

        //显示视图
        return view('admin.shop.edit', compact('shop'));

    }

    /**
     * 商家分类删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        $shop = User::find($id);
        $info = ShopInfo::find($id);
        $shop->delete();
        $info->delete();
        //提示语句
        $request->session()->flash('success', '删除成功');
        //显示视图
        return redirect()->route('shop_user.index');


    }
    //重置密码
    public function clear(Request $request,$id){
        //得到数据库的密码
                $user= User::findOrFail($id);
                $user->password=bcrypt('123456');
                $user->save();
        //提示语句
        $request->session()->flash('success', '重置成功');
        //显示视图
        return redirect()->route('shop_user.index');


    }

}
