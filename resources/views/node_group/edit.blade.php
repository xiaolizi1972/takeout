<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 基本表单</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/bootstrap-validator/dist/css/bootstrapValidator.min.css">
    <link href="/static/css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>数据列表 <small>编辑数据</small></h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" id="defaultForm" action="{{url('node_group/update',array('edit'=>$node_group->id))}}">
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-2 control-label">名称</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name" value="{{$node_group->name}}">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">图标</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="input_icon" name="icon" value="{{$node_group->icon}}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" id="btn_icon"  >搜索图标</button> 
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">排序</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  name="sort" value="{{$node_group->sort}}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">菜单显示</label>

                                <div class="col-sm-6">
                                   
                                    <div class="radio">
                                        <label>
                                            <input type="radio"  value="1" id="visible1" name="visible"  @if($node_group->visible == 1) checked="" @endif>显示
                                        </label>
                                        <label>
                                            <input type="radio" value="0" id="visible2" name="visible" @if($node_group->visible == 0) checked="" @endif>隐藏
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                    <button class="btn btn-white" type="reset">取消</button>
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

    <!-- 自定义js -->
    <script src="/static/js/content.js?v=1.0.0"></script>
    <script src="/static/js/plugins/layer/layer.min.js"></script>
    <!-- iCheck -->
    <script src="/static/js/plugins/iCheck/icheck.min.js"></script>
    <script src="/static/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
    <script src="/static/js/plugins/toastr/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });

        //选择图标
        $("#btn_icon").click( function () { 

            url = "{{url('index/icon')}}";

            layer.open({
                type: 2,
                title: '图标列表',
                skin: 'layui-layer-demo', //样式类名
                closeBtn: 1, //不显示关闭按钮
                anim: 2,
                shadeClose: true, //开启遮罩关闭
                area: ['80%', '80%'], //宽高
                content: url
            })
        });

        //初始化处理
        $(document).ready(function () {

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

                        if(rs.status == 200){

                            toastr.success(rs.message);
                           
                            setTimeout(function(){
                                
                                location.reload();
                            },1200);

                        }else{

                            toastr.error(rs.message);
                        }

                    }, 'json');

                },
                fields: {
                    name: {
                        message: 'The username is not valid',
                        validators: {
                            notEmpty: {
                                message: '输入名称'
                            }
                        }
                    },
                    icon: {
                        validators: {
                            notEmpty: {
                                message: '选择图标'
                            }
                        }
                    },
                    visible: {
                        validators: {
                            notEmpty: {
                                message: '选择菜单是否显示'
                            }
                        }
                    },
                    sort: {
                        validators: {
                            notEmpty: {
                                message: '输入排序'
                            }
                        }
                    },
                }
            });
        });

    </script>

</body>

</html>
