<aside class="main-sidebar">
    <section class="sidebar">

        <!-- 账号状态面板 -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>超级管理员</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <!-- 搜索菜单 -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>

        <!-- 菜单列表-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">主导航</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>管理员</span>
                    <span class="pull-right-container">
                        <!-- <span class="label label-primary pull-right">4</span> -->
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{url('admin/index')}}"><i class="fa fa-circle-o"></i> 管理员列表</a>
                    </li>
                    <li>
                        <a href="{{url('role/index')}}"><i class="fa fa-circle-o"></i> 角色</a>
                    </li>
                    <li>
                        <a href="{{url('node/index')}}"><i class="fa fa-circle-o"></i> 权限</a>
                    </li>
                    <li>
                        <a href="{{url('NodeGroup/index')}}"><i class="fa fa-circle-o"></i>权限组</a>
                    </li>
                </ul>
            </li>

           <!--  <li>
                <a href="../widgets.html">
                    <i class="fa fa-th"></i> <span>单页面</span>
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li> -->
        </ul>
    </section>
</aside>