<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class BaseController extends Controller
{
   public function __construct()
   {
       //解决跨域的方法
       header('Access-Control-Allow-Origin:*');

   }


}
