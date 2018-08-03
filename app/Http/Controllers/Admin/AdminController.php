<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mrgoon\AliSms\AliSms;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{


    //登录
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            //验证是否合格
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required'
            ]);

            //验证登录
            if (Auth::guard('admin')->attempt(['name' => $request->post('name'), 'password' => $request->post('password'),"status"=>1], $request->has('remember'))) {
//提示

                /*if (Auth::user()->status===0) {
                    Auth::logout();
                    return redirect()->route('admin.login')->with('danger',"您登陆的商家商户已被禁用");
                }*/
                $request->session()->flash('success', "登录成功");
                //跳转  intended 从哪来回哪去
                return redirect()->intended(route('admin.index'));
            }else{
                //提示
                $request->session()->flash('danger', "账号或密码错误");
                //跳转  intended 从哪来回哪去
                return redirect()->intended(route('admin.login'));
            }


        }
    //显示页面
        return view('admin.user.login');

    }



    //检验是否审核过
    public function check(Request $request, $id)
    {
        $user = Admin::findOrFail($id);
        if($user->status==0){
            $user->status = 1;
        }else{
            $user->status = 0;
        }
        $user->save();
        return redirect()->route('admin.index');

    }


    //展示所有
    public function index(Request $request)
    {
        //取到所有的值
        $query = $request->query();
        //接受所有的值
        $search = $request->input('search');
        $role=Role::all();

        //显示
        $users = Admin::where('name', 'like', "%$search%")
            ->paginate(5);
        //显示视图
        return view('admin.user.index', compact('users', 'query','role'));
    }


    /**
     * 平台
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        //判断是否是post上传
        if ($request->isMethod('post')) {
            $data=$request->all();
            $data['password']=bcrypt($data['password']);
            //添加数据
           $admin= Admin::create($data);

           //给用户对象添加角色
            $admin->syncRoles($request->post('per'));
            //跳转并提示
            return redirect()->route('admin.index')->with('success','创建'.$admin->name."成功");
            //跳转
            return redirect()->route('admin.index');
        }
          $roles=Role::all();
        //显示视图
        return view('admin.user.add',compact('roles'));

    }


    /**
     * 平台编辑功能
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
//        dd($request->post());
      //判断是否是post提交
        $user = Admin::findOrFail($id);
       $roles=Role::all();
             if($request->isMethod('post')){
                 //修改密码接收所有的值
                 if(Hash::check($request->post('password'),$user->password)){

                     $user->password=bcrypt($request->post('re_password'));
                     //修改所有的值
                     $user->save();
                     $user->syncRoles($request->post('per'));
                     $request->session()->flash('success','修改成功');
                 return redirect()->route('admin.index');
                 }
                 //提示语句
                 $request->session()->flash('danger','密码不对');
                 //跳转
                 return redirect()->route('admin.index');
             }

        //显示视图
        return view('admin.user.edit',compact('user','roles'));

    }

    /**
     * 平台删除
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del(Request $request, $id)
    {
        $shop = Admin::find($id);
        $shop->delete();
        //提示语句
        $request->session()->flash('success', '删除成功');
        //显示视图
        return redirect()->route('admin.index');


    }

    /**
     * 平台管理员退出
     */
    public function logout(Request $request)
    {

        //提示
        Auth::logout();
        $request->session()->flash("success", "退出成功");
        //跳转
        return redirect()->route('admin.login');
    }


}
