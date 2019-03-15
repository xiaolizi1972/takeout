<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> 添加数据 </title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/bootstrap-validator/dist/css/bootstrapValidator.css"/>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        
       
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>列表数据 <small>添加数据</small></h5>
                        
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('admin/store')}}" id="defaultForm">
                             @csrf       
                            <div class="form-group">
                                <label class="col-sm-2 control-label">管理员账号</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="username" placeholder="请输入管理员账号"> 
                                </div>
                            </div>
                           <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">登录密码</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password" placeholder="请输入登录密码"> 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">确认密码</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="请输入"> 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">真实姓名</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="realname" placeholder="请输入真实姓名"> 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">手机号码</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="请输入手机号码" name="mobile"> 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <!-- <div class="form-group">
                                <label class="col-sm-2 control-label">选择角色:</label>

                                <div class="col-sm-6">
                                    <select class="form-control m-b" name="account">
                                        <option>选项 1</option>
                                        <option>选项 2</option>
                                        <option>选项 3</option>
                                        <option>选项 4</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="hr-line-dashed"></div>-->

                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">账号状态:</label>

                                <div class="col-sm-4">
                                    <input type="radio" value="1"  name="status">正常 &nbsp;&nbsp;&nbsp;
									<input type="radio" value="0"  name="status">禁用
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                    <button class="btn btn-white" type="button" onClick="javascript :history.back(-1);" >取消</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 全局js -->
    <script src="/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/js/bootstrap.min.js?v=3.3.6"></script>
	<script src="/static/js/plugins/layer/layer.min.js"></script>
    <!-- 自定义js -->
    <script src="/static/js/content.js?v=1.0.0"></script>

    <!-- iCheck -->
    <script src="/static/js/plugins/iCheck/icheck.min.js"></script>

    <!-- 验证 -->
    <script type="text/javascript" src="/static/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });


            //验证
            $('#defaultForm').bootstrapValidator({
                message: 'This value is not valid',
                live: 'disabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                submitHandler: function(validator, form, submitButton) {
                   
                    $.post(form.attr('action'), form.serialize(), function(rs) {
                        
						layer.msg(rs.message);
						
						setTimeout(function(){
							
							location.href = "{{url('admin/index')}}";
						},1200);

                    }, 'json');

                },
                fields: {
                    username: {
                        message: 'The username is not valid',
                        validators: {
                            notEmpty: {
                                message: '请输入账号'
                            },
                            // remote: {
                            //     url: 'remote.php',
                            //     message: 'The username is not available'
                            // },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: '账号必须是字母和数组'
                            }
                        }
                    },
                    realname: {
                        validators: {
                            notEmpty: {
                                message: '请输入真实姓名'
                            },
                           
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: '请输入密码'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: '请再次确认密码'
                            },
                            identical: {
                                field: 'password',
                                message: '两次密码输入不一致'
                            }
                        }
                    },
					mobile: {
                        validators: {
                            notEmpty: {
                                message: '请输入手机号'
                            }
                        }
                    },
                }
            });
       

        });
    </script>

    
    

</body>

</html>
