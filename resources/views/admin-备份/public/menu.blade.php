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
            @foreach($menus as $menu)
                <li class="treeview">
                    <a href="#">
                        <i class="{{$menu->icon}}"></i>
                        <span>{{$menu->name}}</span>
                        <span class="pull-right-container">
                            <!-- <span class="label label-primary pull-right">4</span> -->
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($menu->node as $node)
                        <li>
                            <a href="{{url($node->route)}}"><i class="fa fa-circle-o"></i>{{$node->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </section>
</aside>