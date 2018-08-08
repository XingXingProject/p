<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    public function index()
    {
        $roles = Role::all();
//        Permission::all();

        //显示视图
        return view('admin.role.index', compact('roles'));


    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {

            //接收参数
            $data['name'] = $request->post('name');
            $data['guard_name'] = "admin";

            //创建角色
            $role = Role::create($data);

            //给角色添加权限
            $role->syncPermissions($request->post('per'));
            //跳转并提示
            return redirect()->route('role.index')->with('success', '创建' . $role->name . "成功");


        }
        //得到所有权限
        $pers = Permission::all();
        //显示视图
        return view('admin.role.add', compact('pers'));

    }


    public function edit(Request $request,$id)
    {
        $role=Role::find($id);
        if($request->isMethod('post')){
            $name=  $request->post('name');
            $role->update(['name'=>"$name",'guard_name'=>'admin']);
//        同步更改
            $role->syncPermissions($request->post('per'));

            return redirect()->route('role.index');
        }
         //差找全部权限
        $pers=Permission::all();
        return view('admin.role.edit',compact('pers','role'));



    }



}
