<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title> 小李子后台系统</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
    
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="http://ozwpnu2pa.bkt.clouddn.com/profile_small.jpg"></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear">
                                   <span class="block m-t-xs"><strong class="font-bold">Beaut-zihan</strong></span>
                                    <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                    </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                               <!--  <li>
                                    <a class="J_menuItem" href="form_avatar.html" data-index="0">修改头像</a>
                                </li> -->
                                <li>
                                    <a class="J_menuItem" href="{{url('adminLog/action')}}" data-index="1">操作日志</a>
                                </li>
                                <li>
                                    <a class="J_menuItem" href="{{url('adminLog/login')}}" data-index="2">登录日志</a>
                                </li>
                                
                                <li class="divider"></li>
                                <li>
                                    <a href="{{route('logout')}}">安全退出</a>
                                </li>
                            </ul>

                        </div>
                           <div class="logo-element">小李子
                        </div>
                    </li>

                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span class="ng-scope">分类</span>
                    </li>
                    <li>
                        <a class="J_menuItem" href="{{route('welcome')}}">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                        </a>
                    </li>
                    <!--<li>
                        <a href="#">
                            <i class="fa fa fa-gear"></i>
                            <span class="nav-label">系统</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="404.html">404</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="500.html">500</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="{{url('admin/create')}}">管理员</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="create.html">添加</a>
                            </li>
                            <li>
                                <a class="J_menuItem" href="login.html">登陆</a>
                            </li>
                        </ul>
                    </li>
                  
                    <li class="line dk"></li> -->
					
					<li>
                        <a href="#">
                            <i class="fa fa-user-plus"></i>
                            <span class="nav-label">管理员</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="J_menuItem" href="{{url('admin/index')}}">管理员列表</a>
                            </li>
                        </ul>
                    </li>
                  
                    <li class="line dk"></li>
                    
                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>
                       <!--  <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form> -->
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        
                      <!--   <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                            <span class="pull-right text-muted small">4分钟前</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-qq fa-fw"></i> 3条新回复
                                            <span class="pull-right text-muted small">12分钟钱</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="notifications.html">
                                            <strong>查看所有 </strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe id="J_iframe" width="100%" height="100%" src="{{route('welcome')}}" frameborder="0" data-id="{{route('welcome')}}" seamless></iframe>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>

    <!-- 全局js -->
    <script src="/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/static/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/static/js/plugins/layer/layer.min.js"></script>

    <!-- 自定义js -->
    <script src="/static/js/hAdmin.js?v=4.1.0"></script>
    <script type="text/javascript" src="/static/js/index.js"></script>

</body>

</html>
