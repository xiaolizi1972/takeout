<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 嵌套列表</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">
        <!-- 验证 -->
    <link rel="stylesheet" href="/static/bootstrap-validator/dist/css/bootstrapValidator.min.css">
    <link href="/static/css/plugins/toastr/toastr.min.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-sm-4">
                <div id="nestable-menu">
                    <button type="button" id="top-fold" data-action="expand-all" data-type="0" class="btn btn-white btn-sm">展开所有</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>节点树</h5>
                    </div>
                    <div class="ibox-content">

                        <p class="m-b-lg text-danger">
                            注：（删除父级节点默认会删除节点下所有子节点）
                        </p>

                        <div class="dd" id="nestable2">
                            <ol class="dd-list">
                                @foreach($lists as $list)
                                    
                                    <li class="dd-item" data-id="{{$list->id}}">
                                        <button data-action="expand" data-type="0" data-id="{{$list->id}}" type="button" class="btn_fold">展开</button>
                                        <div class="dd-handle">
                                            <span class="pull-right">
                                                <button type="button" class="btn btn-info btn-xs btn_create" data-id="{{$list->id}}">
                                                    新增
                                                </button>
                                                <button type="button" class="btn btn-info btn-xs btn_edit" data-id="{{$list->id}}">编辑</button>
                                                <button type="button" class="btn btn-danger btn-xs btn_delete" data-id="{{$list->id}}">删除</button>
                                            </span>
                                            <span class="label label-info">
                                                 {{$list->name}}
                                            </span>
                                        </div>

                                        @foreach($list->child as $child)

                                            <ol class="dd-list dd-child child-list{{$child->pid}}" style="display: none;">
                                                <li class="dd-item" data-id="{{$child->id}}">

                                                    <div class="dd-handle">
                                                        <span class="pull-right"> 
                                                            <button type="button" class="btn btn-info btn-xs">编辑</button>
                                                            <button type="button" class="btn btn-danger btn-xs btn_delete" data-id="{{$child->id}}">删除</button>
                                                        </span>
                                                        <span class="label label-warning">
                                                            {{$child->name}}
                                                        </span> 
                                                    </div>
                                                </li>
                                            </ol>
                                        @endforeach
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>横向表单</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" id="defaultForm" method="post" action="{{url('node/store')}}">
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-3 control-label">名称：</label>

                                <div class="col-sm-8">
                                    <input type="text" placeholder="节点名称" class="form-control" name="name" id="input_name" value=""> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">路由：</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="路由地址" class="form-control" name="route" id="input_route" value="">
                                  <!--   <span class="help-block m-b-none">如：admin/index</span> -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">排序：</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="节点排序" class="form-control" name="sort" value="0" id="input_sort">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">选择分组：</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="group_id" id="input_group_id">
                                        <option value=""></option>
                                        @foreach($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">选择上级：</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="pid" id="parent-select">
                                        <option value="0">无</option>
                                        @foreach($parents as $parent)
                                            <option value="{{$parent->id}}">{{$parent->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">菜单显示：</label>

                                <div class="col-sm-8">
                                   
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="1"  name="visible">是
                                        </label>
                                        <label>
                                            <input type="radio" value="0"  name="visible" checked="" >否
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8">
                                    <button class="btn btn-sm btn-info" type="submit">确定</button>
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
    <!-- 树结构js -->
   <!--  <script src="/static/js/plugins/nestable/jquery.nestable.min.js"></script> -->
    <!-- 插件依赖 -->
    <script src="/static/js/plugins/layer/layer.min.js"></script>
    <script src="/static/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
    <script src="/static/js/plugins/toastr/toastr.min.js"></script>

    <script>

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
                                message: '请输入名称'
                            }
                        }
                    },
                    route: {
                        validators: {
                            notEmpty: {
                                message: '输入路由地址'
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
                    group_id: {
                        validators: {
                            notEmpty: {
                                message: '选择分组'
                            }
                        }
                    },
                    pid: {
                        validators: {
                            notEmpty: {
                                message: '选择上级'
                            }
                        }
                    }  
                }
            });

            //新增选中
            $(".btn_create").click( function () { 

                var url = "{{url('node/store')}}";

                $('#defaultForm').attr('action',url);
                var id = $(this).attr('data-id');

                $('#defaultForm')[0].reset();

                $("#parent-select").find("option[value='"+id+"']").attr("selected",true);
            });

            //编辑数据
            $(".btn_edit").click( function () { 

                var id = $(this).attr('data-id');
                var url = '/node/edit/'+id;

                $('#defaultForm').attr('action','/node/update/'+id);
                $('#defaultForm')[0].reset();

                $.get(url, function(rs){
                         
                    if(rs.status == 200){

                        $('#input_name').val(rs.data.name);
                        $('#input_route').val(rs.data.route);
                        $('#input_sort').val(rs.data.sort);
                        $('#input_group_id').find("option[value='"+rs.data.group_id+"']").attr("selected",true);//.val(rs.data.group_id);
                        $("#parent-select").find("option[value='"+rs.data.pid+"']").attr("selected",true);
                    }
                });
            });

            //删除
            $(".btn_delete").click( function () { 

                var id  = $(this).attr('data-id');

                layer.confirm('确定要删除？', {
                  btn: ['确定','取消'], //按钮
                  skin: 'layui-layer-molv'
                }, function(){
                    
                    var url = '/node/destroy/'+id;

                    $.get(url, function(rs){

                        if(rs.status == 200){

                            toastr.success(rs.message);
                           
                            setTimeout(function(){
                                
                                location.reload();
                            },1200);

                        }else{

                            toastr.error(rs.message);
                        }
                    });


                }, function(){

                  layer.close();
                });



            });


            //父级折叠
            $(".btn_fold").click( function () { 

                var id   =  $(this).attr('data-id');
                var type =  $(this).attr('data-type');

                if(type == 1){

                    $(this).attr('data-action','expand');
                    $(this).attr('data-type', 0);
                    $('.child-list'+id).hide();
                }else{

                    $(this).attr('data-action','collapse');
                    $(this).attr('data-type', 1);
                    $('.child-list'+id).show();
                }
            });

            //全部折叠
            $("#top-fold").click( function () { 

                var id   =  $(this).attr('data-id');
                var type =  $(this).attr('data-type');

                if(type == 1){

                    $(this).text('展开所有');
                    $(this).attr('data-action','expand-all');
                    $(this).attr('data-type', 0);

                    $('.btn_fold').attr('data-type', 0);
                    $('.btn_fold').attr('data-action','expand');

                    $('.dd-child').hide();

                }else{

                    $(this).text('收起所有');
                    $(this).attr('data-action','collapse-all');
                    $(this).attr('data-type', 1);

                    $('.btn_fold').attr('data-type', 1);
                    $('.btn_fold').attr('data-action','collapse');

                    $('.dd-child').show();
                }
            });

        });
    </script>

    
    
</body>

</html>
