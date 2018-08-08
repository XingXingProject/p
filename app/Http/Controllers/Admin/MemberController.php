<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    /**
     * 会员信息列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query=$request->query();
        //接收页面传过来的参数
        $search=$request->input('search');

        $members=Member::where('username','like',"%$search%")->paginate(5);
        //显示页面
        return view('admin.member.index',compact('query','members'));
    }

    /**
     * 会员详细信息
     * @param Request $request
     * @param $id
     */
    public function info(Request $request,$id)
    {

        $member=Member::findOrFail($id);
//        dd($member);
        //显示页面
        return view('admin.member.see',compact('member'));

    }

    //检验是否审核过
    public function check(Request $request, $id)
    {
        $user = Member::findOrFail($id);
        if($user->status==1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        $user->save();
        return redirect()->route('member.index');

    }







}
