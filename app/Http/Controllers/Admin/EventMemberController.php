<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Event_member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventMemberController extends Controller
{
    /**
     * 平台抽奖活动了表展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event_member::all();
//        dd($events);
        //显示视图
        return view('admin.eventMember.index',compact('events'));
    }


    /**
     *
     *平台抽奖活动列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
//    public function add(Request $request)
//    {
//        $events=Event::all();
//        if ($request->isMethod('post')) {
//            $this->validate($request, [
//                'event_id' => 'required',
//                'user_id' => 'required'
//            ]);
//            $data = $request->post();
//            Event::create($data);
//            //提示信息
//            $request->session()->flash('success', '添加成功');
//            //跳转
//            return redirect()->route('eventMember.index');
//        }
//        //显示视图
//        return view('admin.eventMember.add',compact('events'));
//    }

    /**
     * 查看详情
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function see(Request $request, $id)
//    {
//        $event = Event::findOrFail($id);
//
//        //显示视图
//        return view('admin.eventMember.see', compact('event'));
//    }

    /**
     * 平台活动编辑修改
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $event=Event_member::findOrFail($id);
        if($request->isMethod('post')){
            //修改具体某一条
            $event->update($request->post());
            //跳转
            $request->session()->flash('success','修改成功');
            return redirect()->route('event.index');
        }

        //显示视图
        return view('admin.eventMember.edit',compact('event'));
    }


//    public function del(Request $request,$id)
//    {
//        $event=Event_member::findOrFail($id);
//        if($event->is_prize!=1){
//            $request->session()->flash('danger','活动还没有结束，不能删除');
//        }
//        $event->delete();
//        //视图跳转
//        return  redirect()->route('event.index');
//
//    }


}
