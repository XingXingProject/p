<?php

namespace App\Http\Controllers\shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\ShopInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoryController extends BaseController
{
    /**
     * 彩品分类
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //取到页面传过来的所有值
        $query = $request->query();
        //接收shop_user_id  与user表是发生关系的
        $shop=ShopInfo::where('shop_user_id',Auth::user()->id)->first();
        //接收传过来搜索的值
        $search = $request->input('search');
        $menuCates = MenuCategory::where('name', 'like', "%$search%")->where('shop_info_id',$shop->id)
            ->paginate(2);

        //展示视图
        return view('shop.menuClass.index', compact('query', 'menuCates'));
    }

    public function add(Request $request)
    {
        $infos=ShopInfo::all();
        if($request->isMethod('post')){
            if($request->post('status')){
                MenuCategory::where('status',1)->where('shop_info_id',$request->post('shop_info_id'))->update(['status'=>0]);


            }
           MenuCategory::create($request->post());
           //提示语句
            $request->session()->flash('success','添加成功');
            //跳转
            return redirect()->route('menuCategory.index');
        }

        //显示视图
        return view('shop.menuClass.add',compact('infos'));
    }


    /**
     *
     * 菜品编辑功能
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request,$id){
        //回显
        $menuCate=MenuCategory::findOrFail($id);
        if($request->isMethod('post')){
            //一个商家只有一个默认的菜品可以显示
            if($request->post('status')){
                MenuCategory::where('status',1)->where('shop_info_id',$request->post('shop_info_id'))->update(['status'=>0]);
            }

            $menuCate->update($request->all());

            //提示语句
            $request->session()->flash('success','修改成功');
            //跳转
            return redirect()->route('menuCategory.index');

        }


        $infos=ShopInfo::all();
        //显示视图
        return view('shop.menuClass.edit',compact('menuCate','infos'));
    }

    //删除
    public function del(Request $request,$id){
        //查询当前表的id
         $cate=MenuCategory::findOrFail($id);

         //查询菜品表是否有
         if(Menu::where('category_id','=',$id)){
             //提示语句
             $request->session()->flash('danger','菜品有商家在使用，不能删除');

        return redirect()->route('menuCategory.index');

         }
         $cate->delete();


    }




}
