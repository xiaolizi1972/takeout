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
                <form method="post" action="{{route('login')}}" id="login_form">
                    @csrf
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">欢迎登录</p>
                    <input type="text" class="form-control uname" placeholder="用户名" name="username" />
                    <input type="password" class="form-control pword m-b" placeholder="密码" name="password" />
                    <button class="btn btn-info btn-block" type="button" onclick="btn_sub()">登录</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="/static/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/js/plugins/layer/layer.min.js"></script>
<script type="text/javascript">
    

    function btn_sub()
    {

        $.post("{{route('login')}}",$('#login_form').serialize(), function(res){

            layer.msg(res.message);

            if(res.status == 200){

                setTimeout(function(){

                    location.href ="{{url('/')}}";
                    
                },1200);    
            }
        });  
    }
</script>

</html>
