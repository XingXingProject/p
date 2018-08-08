<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>登录头像</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>


            @foreach(\App\Models\Nav::where('parent_id',0)->get() as $k1=>$v1)

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>{{$v1->name}}</span>
                        <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">

                        @foreach(\App\Models\Nav::where('parent_id',$v1->id)->get() as $k2=>$v2)
                            <li class="active"><a href="{{route($v2->url)}}"><i class="fa fa-circle-o"></i>
                                   {{$v2->name}}</a></li>
                        @endforeach

                    </ul>
                </li>
        @endforeach






    </section>
    <!-- /.sidebar -->
</aside>