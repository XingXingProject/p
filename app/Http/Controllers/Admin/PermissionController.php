<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
    //
    public function index()
    {

        $pers = Permission::paginate(15);
        //显示视图
        return view('admin.per.index', compact('pers'));
    }


    /**
     * 先添加权限
     * @param Request $request
     */
    public function add(Request $request)
    {
        //1.得到所有路由
        $routes = Route::getRoutes();
        //3.声明一个空数组
        $data = [];
        //2.过滤出命名空间App\Http\Controllers\Admin
        foreach ($routes as $route) {
            if ($route->action['namespace'] === "App\Http\Controllers\Admin") {
//                dump($route->action['as']);
                //判断名字是否存在
                if (isset($route->action['as'])) {
                    //名字存在追加进数组里面
                    $data[] = $route->action['as'];
                }


            }

        }
        foreach ($data as $da) {
            $per = Permission::create(['name' => $da, 'guard_name' => 'admin']);
        }

//        if ($request->isMethod('post')) {
//            //添加一个权限   权限名称必需是路由的名称  后面做权限判断
//
//            $request->session()->flash('success', '添加成功');
//        }

        //显示视图
//        return view('admin.per.add');
    }

    public function edit(Request $request, $id)
    {
        $per = Permission::find($id);
        if ($request->isMethod('post')) {

        }
        //显示视图
        return view('admin.per.edit', compact('per'));
    }


    public function del(Request $request, $id)
    {

        $per = Permission::find($id);
        $per->delete();
        return redirect()->route('per.index');

    }


}
