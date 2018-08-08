<?php

namespace App\Http\Controllers\Shop;

use App\Models\Active;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveController extends BaseController
{
    //查看平台活动
    public function info(Request $request)
    {
        $time = date(now());
        $search = $request->input('search');

        $query = Active::where('end_time', '>=', $time);
        if ($search !== null) {
            $query = $query->where('title', 'like', "%$search%");
        }
        $acts = $query->paginate(2);

        //页面传过来的值

//        $query=$query->paginate(2);
        //显示视图
        return view('shop.active.index', compact('acts'));
    }


    //内容查看详情
    public function show(Request $request, $id)
    {
        $active = Active::findOrFail($id);
        //显示视图
        return view('shop.active.see', compact('active'));
    }
}
