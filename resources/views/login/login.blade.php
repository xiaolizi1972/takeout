<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css" rel="stylesheet">
    <link href="/static/css/login.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <!-- 验证 -->
    <link rel="stylesheet" href="/static/bootstrap-validator/dist/css/bootstrapValidator.min.css">


    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-12">
                <form method="post" action="{{route('login')}}" id="defaultForm">
                    @csrf
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">欢迎登陆</p>
                    <div class="form-group">
                        <input type="text" class="form-control uname" placeholder="用户名" name="username" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control pword m-b" placeholder="密码" name="password" />
                    </div>
                    <!-- <a href="">忘记密码了？</a> -->
                    <button type="submit" class="btn btn-success btn-block">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; hAdmin
            </div>
        </div>
    </div>

<!-- jQuery 3 -->
<script src="/static/js/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/static/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/static/js/layer/layer.min.js"></script>
<script type="text/javascript" src="/static/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
<script type="text/javascript">
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
