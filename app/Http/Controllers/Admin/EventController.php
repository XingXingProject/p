<?php

namespace App\Http\Controllers\Admin;

use App\Mail\OrderShipped;
use App\Models\Event;
use App\Models\Event_member;
use App\Models\Event_prize;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EventController extends BaseController
{
    /**
     * 平台抽奖活动了表展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $query = \request()->query();
        $search = \request()->input('search');
        $events = Event::where('title', 'like', "%$search%")->paginate(10);
        //显示视图
        return view('admin.event.index', compact('query', 'events'));
    }


    /**
     *
     *平台抽奖活动列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'num' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'prize_time' => 'required',
                'is_prize' => 'required'
            ]);
            $data = $request->post();
            Event::create($data);
            //提示信息
            $request->session()->flash('success', '添加成功');
            //跳转
            return redirect()->route('event.index');
        }
        //显示视图
        return view('admin.event.add');
    }

    /**
     * 查看详情
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function see(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        //显示视图
        return view('admin.event.see', compact('event'));
    }

    /**
     * 平台活动编辑修改
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        if ($request->isMethod('post')) {
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
            $event->update($request->post());
            //跳转
            $request->session()->flash('success', '修改成功');
            return redirect()->route('event.index');
        }

        //显示视图
        return view('admin.event.edit', compact('event'));
    }


    public function prize(Request $request, $id)
    {
        //通过活动id找到商户
        $userId=Event_member::where('event_id',$id)->pluck('user_id')->toArray();
        //打乱用户
        shuffle($userId);
        //通过活动id找到奖品
        $prizes=Event_prize::where('event_id',$id)->get()->shuffle();
            //循环奖品
            foreach ($prizes as $k=>$prize){
                //给奖品user_id 赋值
//                if(count($userId)===$k){
//                    break;
//                }
                $prize->user_id=$userId[$k];
                $prize->save();
                //得到中奖用户的id
                $user=User::findOrFail($userId[$k]);
                //当中奖的时候发送邮件
                Mail::to($user)->send(new OrderShipped($prize));
            }
        //修改状态
        $event=Event::findOrFail($id);
        $event->is_prize=1;
        $event->save();
        return redirect()->route('event.index')->with('success','开奖成功');

    }

    public function del(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        if ($event->is_prize != 1) {
            $request->session()->flash('danger', '活动还没有结束，不能删除');
        }
        $event->delete();
        //视图跳转
        return redirect()->route('event.index');

    }


}
