<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\Event_member;
use App\Models\Event_prize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventShopController extends BaseController
{
    public function index()
    {
        $query = \request()->query();
        $search = \request()->input('search');
        $events = Event::where('title', 'like', "%$search%")->paginate(10);
        //显示视图
        return view('shop.eventShop.index', compact('query', 'events'));
    }

    public function see(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        //显示视图
        return view('shop.eventShop.see', compact('event'));
    }


    /**
     * 商户端我要报名
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request, $id)
    {
        //得到当前的用户
        $user = Auth::user()->id;
        //判断是否已报名
        $eventUsers = Event_member::where('event_id', $id)->pluck('user_id')->toArray();
        if (in_array($user, $eventUsers)) {
            return back()->with('success', '你已参加抽奖活动');
        }
//            dd($user,$id);
        Event_member::create(['event_id' => $id, 'user_id' => $user]);
        //提示信息
        $request->session()->flash('success', '报名成功');

        //跳转
        return redirect()->route('eventShop.index');
    }


    public function read(Request $request, $id)
    {

       $events= Event_prize::where('event_id',$id)->get();
//       dd($events);

        //显示视图
        return view('shop.eventShop.read', compact('events'));

    }
}
