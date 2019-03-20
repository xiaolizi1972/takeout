<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>表单</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/admin/static/bootstrap/dist/css/bootstrap.min.css">
    <!-- 字体图标 -->
    <link rel="stylesheet" href="/admin/static/font-awesome/css/font-awesome.min.css">
    <!-- 字体 -->
    <link rel="stylesheet" href="/admin/static/Ionicons/css/ionicons.min.css">
    <!-- 主题 -->
    <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
    <!-- 样式 -->
    <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="/admin/static/select2/dist/css/select2.min.css">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- 顶部导航 -->
   <!--  @include('admin.public.nav') -->
    
    <!-- 左侧菜单栏 -->
   <!--  @include('admin.public.menu') -->

    <!--主体内容部分 -->
    @yield('content')

    <!-- 底部内容 -->
    <!-- @include('admin.public.footer') -->

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
 @yield('form_js')
</body>
</html>
