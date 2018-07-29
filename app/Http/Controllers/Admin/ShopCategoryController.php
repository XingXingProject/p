<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends BaseController
{
    /**
     * s
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //取到所有的值
        $query = $request->query();
        //接受所有的值
        $search = $request->input('search');

        //显示
        $shops = ShopCategory::where('name', 'like', "%$search%")
            ->paginate(2);
        //显示视图
        return view('admin.category.index', compact('shops', 'query'));
    }


    /**
     * 商家分类
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //判断是否是post上传
        if ($request->isMethod('post')) {
            $data = $request->all();
//             dd($data);
            //判断图片是否上传
            $data['img'] = '';
            if ($request->file('img') !== null) {

                $fileName = $request->file('img')->store("tp", "oss");

//                    dd(env("ALIYUN_OSS_URL").$fileName);//要保存到数据库
                $data['img'] = env("ALIYUN_OSS_URL") . $fileName;

            }
            //添加数据
            ShopCategory::create($data);
            //提示
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('shop_category.index');
        }

        //显示视图
        return view('admin.category.add');

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
        $shop = ShopCategory::find($id);
        //判断是否是post上传
        if ($request->isMethod('post')) {
            $data = $request->all();
//             dd($data);
            //判断图片是否上传
            $data['img'] = '';
            if ($request->file('img') !== null) {
                $fileName = $request->file('img')->store("tp", "oss");
                $data['img'] = env("ALIYUN_OSS_URL") . $fileName;
            }
            //添加数据
            $shop->update($data);
            //提示
            $request->session()->flash('success', '修改成功');
            //跳转
            return redirect()->route('shop_category.index');
        }

        //显示视图
        return view('admin.category.edit', compact('shop'));

    }

    /**
     * 商家分类删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        $shop = ShopCategory::find($id);
        $shop->delete();
        //提示语句
        $request->session()->flash('success', '删除成功');
        //显示视图
        return redirect()->route('shop_category.index');


    }


}
