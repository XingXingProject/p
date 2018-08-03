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
                    <i class="fa fa-dashboard"></i> <span>平台管理界面</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{route('shop_category.index')}}"><i class="fa fa-circle-o"></i> 商家分类管理</a></li>
                    <li><a href="{{route('shop_info.index')}}"><i class="fa fa-circle-o"></i> 商家店铺信息管理</a></li>
                    <li><a href="{{route('shop_user.index')}}"><i class="fa fa-circle-o"></i> 商家信息管理</a></li>
                    <li><a href="{{route('admin.index')}}"><i class="fa fa-circle-o"></i> 平台管理员</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>平台活动</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('active.index')}}"><i class="fa fa-circle-o"></i>活动告示</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>会员管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('member.index')}}"><i class="fa fa-circle-o"></i>会员列表展示</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>菜品销量统计</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('orders.menu')}}"><i class="fa fa-circle-o"></i> 菜品统计</a></li>
                    <li><a href="{{route('orders.menuDay')}}"><i class="fa fa-circle-o"></i> 菜品按日统计</a></li>
                    <li><a href="{{route('orders.menuMonth')}}"><i class="fa fa-circle-o"></i> 菜品按月统计</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>订单量</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('orders.index')}}"><i class="fa fa-circle-o"></i> 订单量按统计</a></li>
                    <li><a href="{{route('orders.day')}}"><i class="fa fa-circle-o"></i> 订单量按日统计</a></li>
                    <li><a href="{{route('orders.month')}}"><i class="fa fa-circle-o"></i> 订单量按月统计</a></li>


                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>权限</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('per.index')}}"><i class="fa fa-circle-o"></i> 权限添加</a></li>


                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>角色</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('role.index')}}"><i class="fa fa-circle-o"></i> 角色添加</a></li>


                </ul>
            </li>









    </section>
    <!-- /.sidebar -->
</aside>