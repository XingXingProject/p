<header class="main-header">
    <!-- Logo -->
    <a href="index2.blade.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ele</b>订餐系统</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->


                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">入口</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Admin image -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                @auth
                                    <a href="#"
                                       class="btn btn-default btn-flat">商家：{{\Illuminate\Support\Facades\Auth::user()->name}}  </a>
                                    <a href="{{route('user.logout')}}" class="btn btn-default btn-flat">退出</a>
                                @endauth
                                @guest
                                    <a href="{{route('user.joins')}}" class="btn btn-default btn-flat">登录</a>
                            </div>

                            <div class="pull-right">
                                <a href="{{route('user.reg')}}" class="btn btn-default btn-flat">注册</a>

                            </div>
                            @endguest
                        </li>

                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>