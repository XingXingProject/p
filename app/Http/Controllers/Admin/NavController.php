<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class NavController extends BaseController
{
    //
    /**
     * nav显示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //取到平台所有的值
        $query=\request()->input();
        //取到要搜索到的值
        $search=\request()->input('search');
        $navs = Nav::where('name','like',"%$search%")->paginate(10);
        //显示视图
        return view('admin.nav.index', compact('navs','query'));

    }

    /**
     * nav添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required'
            ]);
            if ($request->post('url') === null) {
                $data = $request->except('url');
            } else {
                $data = $request->post();
            }
            $nav = Nav::create($data);
            return redirect()->refresh()->with('success', '添加' . $nav->name . '成功');

        }

        //得到所有路由
        $routes = Route::getRoutes();
        //定义数组
        $urls = [];
        foreach ($routes as $k => $value) {
            //dd($value->action);
            if ($value->action['namespace'] === "App\Http\Controllers\Admin") {
                if (isset($value->action['as'])) {
                    $urls[] = $value->action['as'];
                }
            }
        }
        $navs = Nav::where('parent_id', 0)->orderBy('sort')->get();
        return view('admin.nav.add', compact('navs', 'urls'));


    }


    public function edit(Request $request,$id)
    {
       $nav= Nav::findOrFail($id);
        //得到所有路由
        $routes = Route::getRoutes();
        //定义数组
        $urls = [];
        foreach ($routes as $k => $value) {
            //dd($value->action);
            if ($value->action['namespace'] === "App\Http\Controllers\Admin") {
                if (isset($value->action['as'])) {
                    $urls[] = $value->action['as'];
                }
            }
        }

        $na = Nav::where('parent_id', 0)->orderBy('sort')->get();
        if($request->isMethod('post')){
            $nav->update($request->post());
            //提示
            $request->session()->flash('success','修改成功');
            //跳转
            return view('admin.nav.index');

        }

       //显示视图
        return view('admin.nav.edit',compact('nav','urls','na'));
    }


    public function del(Request $request,$id)
    {
        $nav=Nav::findOrFail($id);
        $num=Nav::where('parent_id',$id)->first();

        if ($num) {
            return back()->with('danger','不为空');
        }
        $nav->delete();
        //提示
        $request->session()->flash('success','删除成功');
        //跳转
        return redirect()->route('nav.index');
    }


}
