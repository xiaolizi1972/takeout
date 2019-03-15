<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 数据列表 </title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">
    <!-- 表格样式 -->
    <link href="/static/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/static/css/plugins/iCheck/custom.css" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
       
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>数据列表</h5>
                        <div class="ibox-tools">
                            共 {{$lists->total()}} 条
                        </div>
                    </div>
                    <div class="ibox-content">
                        
                        <div class="row">
							<div class="col-sm-4">
								<a class="btn btn-default" href="{{url('admin/index')}}"><i class="fa fa-refresh"></i>刷新</a>
								<a class="btn btn-info " href="{{url('admin/create')}}"><i class="fa fa-plus"></i> 新增</a>
								<a class="btn btn-danger " href="{{url('admin/store')}}"><i class="fa fa-trash"></i> 删除</a>
							</div>
                            <div class="col-sm-4">

                                <div class="input-group">
                                    <input type="text" placeholder="请输入您要搜索的管理员" class="input form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn btn-primary"> 
                                            <i class="fa fa-search"></i> 搜索
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover " id="editable">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox i-checks">
                                           <input type="checkbox" value="">
                                        </div>
                                    </th>
                                    <th>id</th>
                                    <th>账号</th>
                                    <th>真实姓名</th>
                                    <th>手机号码</th>
                                    <th>账号状态</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lists as $list)
                                <tr class="gradeX">
                                     <td>
                                        <div class="checkbox i-checks">
                                           <input type="checkbox" value="">
                                        </div>
                                    </td>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->username}}</td>
                                    <td>{{$list->realname}}</td>
                                    <td>{{$list->mobile}}</td>
                                    <td>
										@if($list->status == 1)
											<span class="badge badge-info" >
												<i class="fa fa-circle"></i>正常
											</span>
										@else 
											<span class="badge">
												<i class="fa fa-circle"></i>禁用
											</span>
										@endif
									</td>
                                    <td>{{$list->created_at}}</td>
                                    <td class="center">
                                        <a href="" class=" " title="查看">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        </a>&nbsp;
                                       
                                        <a href="" class="" title="删除">
                                             <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </a>&nbsp;
                                    </td>
                                </tr>
                                @endforeach   
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-6">
                                {{$lists->links()}}      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 全局js -->
    <script src="/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/static/js/plugins/jeditable/jquery.jeditable.js"></script>

    <!-- 自定义js -->
    <script src="/static/js/plugins/layer/layer.min.js" ></script>
    <script src="/static/js/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        
        //删除
        function  del(id)
        {

            layer.confirm('您确定要删除？', {
              btn: ['确定','取消'] //按钮
            }, function(){
             // layer.msg('的确很重要', {icon: 1});

                $.get(url,{id:id},function(rs){

                    if(rs.status == 200){
                        setTimeout(function(){
                            window.location.reload();
                        },1500);
                    }

                    layer.msg('的确很重要', {icon: 1});

                });

            });
        }

        //状态
        function  status(id,status)
        {
            $.get(url,{id:id,status:status},function(rs){

                if(rs.status == 200){
                    layer.msg(rs.msg);
                    window.location.reload();
                }

            });
        }

        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
         });

    </script>

</body>

</html>
