<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>表格列表</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- 基础样式 -->
  <link rel="stylesheet" href="/admin/static/bootstrap/dist/css/bootstrap.min.css">
  <!-- 字体 -->
  <link rel="stylesheet" href="/admin/static/font-awesome/css/font-awesome.min.css">
  <!-- 图标 -->
  <link rel="stylesheet" href="/admin/static/Ionicons/css/ionicons.min.css">
  <!-- 数据表格 -->
  <link rel="stylesheet" href="/admin/static/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- 主题风格 -->
  <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
  <!-- 皮肤 -->
  <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">

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
    @include('admin.public.nav')
    
    <!-- 左侧菜单栏 -->
    @include('admin.public.menu')

    <!--主体内容部分 -->
    @yield('content')

    <!-- 底部内容 -->
    @include('admin.public.footer')
</div>

<!-- 基础  -->
<script src="/admin/static/jquery/dist/jquery.min.js"></script>
<script src="/admin/static/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- 表格 -->
<script src="/admin/static/datatables.net/js/jquery.dataTables.min.js"></script>
<!-- SlimScroll -->
<script src="/admin/static/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/static/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>
</body>
</html>
