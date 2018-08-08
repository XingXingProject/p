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
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>商家店铺管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('menuCategory.index')}}"><i class="fa fa-circle-o"></i> 菜品分类管理</a></li>
                    <li><a href="{{route('menu.index')}}"><i class="fa fa-circle-o"></i> 菜品表</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>平台公告</span>
                    <span class="pull-right-container">

            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('active.info')}}"><i class="fa fa-circle-o"></i>活动详情</a></li>


                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>订单</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('order.index')}}"><i class="fa fa-circle-o"></i>订单列表展示</a></li>
                    <li><a href="{{route('order.total')}}"><i class="fa fa-circle-o"></i> 订单总计</a></li>
                    <li><a href="{{route('order.day')}}"><i class="fa fa-circle-o"></i> 订单按日统计</a></li>
                    <li><a href="{{route('order.month')}}"><i class="fa fa-circle-o"></i> 订单按月统计</a></li>
                    <li><a href="/pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>菜品销量统计</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('order.menu')}}"><i class="fa fa-circle-o"></i> 菜品总计</a></li>
                    <li><a href="{{route('order.menuDay')}}"><i class="fa fa-circle-o"></i> 菜品销量按日统计</a></li>
                    <li><a href="{{route('order.menuMonth')}}"><i class="fa fa-circle-o"></i>  菜品销量按月统计</a></li>

                    <li><a href="/pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                    <li><a href="/pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                    <li><a href="/pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>抽奖活动</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('eventShop.index')}}"><i class="fa fa-circle-o"></i>查看活动</a></li>
                </ul>
            </li>








    </section>
    <!-- /.sidebar -->
</aside>