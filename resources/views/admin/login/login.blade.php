<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>登录</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- 基础样式-->
  <link rel="stylesheet" href="/admin/static/bootstrap/dist/css/bootstrap.min.css">
  <!-- 字体 -->
  <link rel="stylesheet" href="/admin/static/font-awesome/css/font-awesome.min.css">
  <!--字体图标 -->
  <link rel="stylesheet" href="/admin/static/Ionicons/css/ionicons.min.css">
  <!-- 主题样式 -->
  <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
  <!-- 验证 -->
  <link rel="stylesheet" href="/admin/bootstrap-validator/dist/css/bootstrapValidator.min.css">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background:url(/admin/img/login-background.jpg) no-repeat center">
<div class="login-box">
    <div class="login-logo">
        <span>欢迎登陆</sapn>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">每日密码输错5次将禁止登录</p>
        <form  method="post" id="defaultForm" action="{{route('login')}}">
            @csrf
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="账号">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="box-body ">
                    <button type="submit" class="btn btn-block btn-facebook btn-flat text-center">
                        登录
                    </button> 
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery 3 -->
<script src="/admin/static/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/static/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/admin/layer/layer.min.js"></script>
<script type="text/javascript" src="/admin/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
<script>

    $(function () {

        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' /* optional */
        });
    });


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
                    
                    if(rs.status == 200){
                        setTimeout(function(){
                            
                            location.href= '/';
                        },1200);
                    }
                }, 'json');

            },
            fields: {
                username: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: '请输入账号'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: '账号必须是字母和数组'
                        }
                    }
                },

                password: {
                    validators: {
                        notEmpty: {
                            message: '请输入密码'
                        }
                    }
                }
            }
        });

</script>
</body>
</html>
