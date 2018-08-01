## 项目日志

###  day1 重点要点 

1、配置数据库

2、建模型和控制器的命令：

​            创建表  php artisan make:model Models/ShopCategory -m

​            创建控制器 php artisan make:controller Admin/ShopCategoryController

3、数据迁移的命令：

​            php artisan migrate

4、视图模板

​             @extends("layouts.default")  ----》模板

​              @section("title","图书添加")

​               @section("content")  

​                        代码块

​                @endsection

5、路由分组

​       Route::domain('admin.ele.com')->namespace('Admin')->group(function () {

​                      Route::get('user/reg',"UserController@reg")->name('user.reg'); 

}）；



#### 第一天遇到的问题

1、建表的时候没有分清表之间的关系（已解决）

2、路由分组不熟悉怎么使用，后来明白了（已解决）









## day2 重点要点

1、登录（步骤）

​       模型继承Basecontroller     Illuminate\Foundation\Auth\User as Authenticatable; （为了方便）

2、config里面配置后台路径

​            'users' => [          

​                              'driver' => 'eloquent',      

​                               'model' => \App\Models\User::class,//验证用户的模型   

​              ],

3、密码在添加的时候都要加密  bcrypt();

4、验证

```
 if (Auth::attempt(['name'=>$request->post('name'),'password'=>$request->post('password')])) {

                //提示
                $request->session()->flash("success","登录成功");
                //echo "登录成功";
                //跳转
                return redirect()->route('user.index');

            }else{
                //提示
                $request->session()->flash("danger","账号或密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
```

 5、登录之后登录换成登录者的信息

```
@auth
    // 用户已经通过身份认证...
    //当前用户对象\Illuminate\Support\Facades\Auth::user()->name;//取到当前用户名称
@endauth

@guest
    // 用户没有通过身份认证...
@endguest

 6、得到当前用户 一般用这个表示：

             Auth::user();

           //当前用户对象\Illuminate\Support\Facades\Auth::user()->name;//取到当前用户名称

```

6、设置中间件

```
 public function __construct()
    {
        //添加保安 验证登录
        $this->middleware('auth',[
            'except'=>['login','index'],
        ]);
        //再添加一个 login只有guest才能访问
        $this->middleware("guest",[
           'only'=>['login']
        ]);
    }
```

7、设置跳转提示 Http/Middleware/RedirectIfAuthenticated.php （重写）

```
 public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            session()->flash('info', '您已登录，无需再次操作。');
            return redirect()->route("user.index");
        }

        return $next($request);
    }
```

8、修改密码   hash

```
if(Hash::check($request->password,$user->password)){
      $user->password=bcrypt($request->re_password);
    $user->save();
    $request->session()->flash('success','密码修改成功');
    return redirect()->route('admin.index');
}
```

#### 遇到的问题

1、登录一直报错：原因是登录验证忘记带上guard（‘Admin’）和忘记继承（已解决）

2、同时操作两张表不用事物做的话，会搞不清楚主从表（已解决）

3、事物超级不喜欢用，但是还是的记住（已解决）





## day3 重点要点

多个搜索功能 ：

```
//接收参数
$minPrice=\request()->input('minPrice');
$maxPrice=\request()->input('maxPrice');
$search=\request()->input('search');
$menuId=\request()->input('category_id');

//$id=Auth::user()->id;
$query=Menu::orderBy('id');

if ($minPrice!==null){
    $query= $query->where('goods_price','>=',$minPrice);
}

if ($maxPrice!==null){
    $query= $query->where('goods_price','<=',$maxPrice);
}

if ($search!==null){
    $query= $query->where('goods_name','like',"%{$search}%");
}
if ($menuId!==null){
    $query= $query->where('category_id','=',$menuId);
}
$menus = $query->paginate(2);
$cates=MenuCategory::all();
```

###  遇到的问题

搜索不了：id错了（已解决）

老是遇到一些奇奇怪怪的错误！！！粗心（慢慢解决）



## day4 重点要点

内容编辑器使用步骤要记住

{{request->input('name')}}--->下拉或者框搜索后回显的值
$request->input('name');--->页面传过来的接收值可以改为get post
$request->query()    ---all();--->页面全部的值

### 遇到的问题

图片上传  步骤太多在看

带条件显示和带条件搜索时会懵逼（已解决）

时间 date datetime  time()   区别是什么    date(now())    (自己百度去了)





## 接口 ：day5 与day6 重点要点

修改密码代码片段

```
if(Hash::check($data['oldPassword'],$member->password)){
    $member->password=bcrypt($data['newPassword']);
    $member->save();
    return [
        "status" => "true",
        "message" => "修改成功"
    ];
}
```



验证码

```
//接收tel
$tel = \request()->input('tel');
//随机产生验证码
$code = rand(1000, 9000);
//存验证码 存Redis里面  ["tel_123456"=>1245];  只能存5分钟
Redis::setex("tel_" . $tel, 300, $code);

//取出验证码
  $sms = Redis::get("tel_" . $data['tel']);
```



登录代码： 因为这个是接口 ，不能用原来的方法登录

```
//1.先通过用户名找当前用户
$member = Member::where('username', $data['username'])->first();

//2.如果用户密码存在 再来验证密码  Hash:check 如果密码也成功 登录成功
if ($member && Hash::check($data['password'], $member['password'])) {
    return [
        'status' => "true",
        'message' => "登陆成功",
        'user_id' => $member->id,
        'username' => $member->name

    ];
    }
```

### 遇到的问题记住：

浏览器报错no message  字段错误   models  要添加修改字段

短信验证码没有接收到：重启redis 

 数据库  密码加密后  varchar 255 

字段要对的上

接口：要对的上字段 ，路由要保持一致，需要什么值就返回什么值

api文档：要用软件，学会写



##  

## day7 day8 重点要点



订单接口 ，加入购物车保存，事物，，，，返回数据格式很重要，记住。



