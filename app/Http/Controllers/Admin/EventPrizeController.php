<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Event_prize;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends BaseController
{
    //
    public function index()
    {
        $query = \request()->query();
        $search = \request()->input('search');
        $events = Event_prize::where('name', 'like', "%$search%")->paginate(10);

        //显示视图
        return view('admin.eventPrize.index', compact('query', 'events'));
    }

    public function add(Request $request)
    {
        $actives = Event::all();
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'event_id' => 'required',
                'name' => 'required',
                'description' => 'required'
            ]);
            $data = $request->post();
            Event_prize::create($data);
            //提示信息
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('eventPrize.index');
        }
        //显示视图
        return view('admin.eventPrize.add', compact('prize', 'user', 'actives'));
    }


    public function see(Request $request, $id)
    {
        $event = Event_prize::findOrFail($id);

        //显示视图
        return view('admin.eventPrize.see', compact('event'));
    }



    public function edit(Request $request, $id)
    {

        $event=Event_prize::findOrFail($id);
        $actives = Event::all();
        if($request->isMethod('post')){
//            $this->validate($request, [
//                'title' => 'required',
//                'content' => 'required',
//                'num'=>'required',
//                'start_time' => 'required',
//                'end_time' => 'required',
//                'prize_time' => 'required',
//                'is_prize' => 'required'
//            ]);
            //修改具体某一条
            $event->where('user_id','=','null')->update($request->post());
            //跳转
            $request->session()->flash('success','修改成功');
            return redirect()->route('eventPrize.index');
        }

        //显示视图
        return view('admin.eventPrize.edit',compact('event','actives'));
    }



    public function del(Request $request,$id)
    {
        $event=Event_prize::findOrFail($id);
//        dd($event);
        if($event->user_id!=null){
            $request->session()->flash('danger','活动已经开奖，不能删除');
        }
        $event->delete();

        //视图跳转
        return  redirect()->route('event.index');

    }


}
