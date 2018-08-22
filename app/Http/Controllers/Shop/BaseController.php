<?php

namespace App\Http\Controllers\Shop;

use App\Models\ShopCategory;
use App\Models\ShopInfo;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{

    public function __construct()
    {

        //添加保安 验证登录
        $this->middleware('auth', [
            'except' => ['joins','reg'],
        ]);
//再添加一个 login只有guest才能访问
//        $this->middleware("guest", [
//            'only' => ['joins']
//        ]);


    }



}
