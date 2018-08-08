<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\ShopInfo;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BaseController;
use Illuminate\Support\Facades\Auth;

class MenuController extends BaseController
{
    //展示
    public function index(Request $request)
    {
        //接收参数
        $minPrice = \request()->input('minPrice');
        $maxPrice = \request()->input('maxPrice');
        $search = \request()->input('search');
        $menuId = \request()->input('category_id');
        //$shop_user_id=Auth::user()->id;
        $shop = ShopInfo::where("shop_user_id", Auth::user()->id)->first();
        //$id=Auth::user()->id;
        $query = Menu::orderBy('id')->where('shop_info_id', $shop->id);

        if ($minPrice !== null) {
            $query = $query->where('goods_price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query = $query->where('goods_price', '<=', $maxPrice);
        }

        if ($search !== null) {
            $query = $query->where('goods_name', 'like', "%{$search}%");
        }
        if ($menuId !== null) {
            $query = $query->where('category_id', '=', $menuId);
        }
        $menus = $query->paginate(2);
        $cates = MenuCategory::all();


        //显示视图
        return view('shop.menu.index', compact('menus', 'cates'));

    }

    /**
     * 菜单添加
     */
    public function add(Request $request)
    {
        //连表
        $cates = MenuCategory::all();
        $infos = ShopInfo::all();
        if ($request->isMethod('post')) {
            //判断图片是否上传
            $data = $request->post();
            $au=Auth::user();
//            dd($au);
            $data['shop_info_id']=$au->id;
            $data['goods_img'] = '';
            if ($request->file('goods_img') !== null) {
                $fileName = $request->file('goods_img')->store("tp", "oss");
                $data['goods_img'] = env("ALIYUN_OSS_URL") . $fileName;
            }
            Menu::create($data);
            //提示语句
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('menu.index');

        }
        //显示视图
        return view('shop.menu.add', compact('cates', 'infos'));

    }

    public function edit(Request $request, $id)
    {
        //菜品表menu
        $menu = Menu::findOrFail($id);
        //商品表shop_info
        $infos = ShopInfo::all();
        //菜品分类表MenuCategory
        $cates = MenuCategory::all();

        if ($request->isMethod('post')) {
            $data = $request->post();
//            dd($data);
            $data['goods_img'] = '';
            if ($request->file('goods_img') !== null) {
                $fileName = $request->file('goods_img')->store("tp", "oss");
                $data['goods_img'] = env("ALIYUN_OSS_URL") . $fileName;
            }
            $menu->update($data);
            //提示信息
            $request->session()->flash('success', '修改成功');
            return redirect()->route('menu.index');

        }

        //显示页面
        return view('shop.menu.edit', compact('menu', 'infos', 'cates'));
    }


    public function del(Request $request, $id)
    {

        $menu = Menu::findOrFail($id);

        File::delete(public_path($menu->goods_img));
        $menu->delete();


    }


}
