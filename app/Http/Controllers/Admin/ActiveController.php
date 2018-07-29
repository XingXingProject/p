<?php

namespace App\Http\Controllers\Admin;

use App\Models\Active;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveController extends BaseController
{
    /**
     * 活动公告显示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $start_time=$request->get('start_time');
        $end_time=$request->get('end_time');
        $search=$request->get('search');

       $query=Active::orderBy('id');

        $date=$request->query();

       if($start_time!==null){
          $query=$query->where('start_time','>=',$start_time);
       }

       if($end_time!==null){
           $query=$query->where('end_time','<=',$end_time);

       }
        if($search!==null){
            $query=$query->where('title','like',"%$search%");

        }

        $acts=$query->paginate(2);
        //显示视图
        return view('admin.active.index', compact('acts','date'));
    }

    //内容查看详情
    public function see(Request $request,$id){
        $active=Active::findOrFail($id);
        //显示视图
        return view('admin.active.see',compact('active'));
    }

    /**
     * 活动公告添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            Active::create($request->post());
            //提示语句
            $request->session()->flash('success','添加成功');
            return  redirect()->route('active.index');

        }

        //显示视图
        return view('admin.active.add');
    }


    public function edit(Request $request,$id){
       $act= Active::findOrFail($id);
        //判断是否post上传
        if($request->isMethod('post')){
            //修改具体某一条
             $act->update($request->post());
             //跳转
            $request->session()->flash('success','修改成功');
            return redirect()->route('active.index');

        }
        //显示视图
        return view('admin.active.edit',compact('act'));
    }

    /**
     * 删除
     *
     */

    public function del(Request $request,$id){
         $act=Active::findOrFail($id);
         $act->delete();
         //提示
        $request->session()->flash('success','删除成功');
        //跳转
        return redirect()->route('active.index');

    }


}
