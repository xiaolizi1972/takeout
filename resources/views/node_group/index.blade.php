<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 数据表格</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <!-- 表单 -->
    <link href="/static/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">
    <link href="/static/css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
       
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>数据列表</h5>
                        <div class="ibox-tools">
                            共 {{$lists->total()}} 条记录
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-sm-3 m-b-xs">
                                <a href="javascript:void(0);" class="btn btn-primary" id="btn_create" data-url="{{url('node_group/create')}}">新增</a>
                            </div>
                           <!--  <div class="col-sm-2">
                                <select class="input-sm form-control input-s-sm inline">
                                    <option value="0">请选择</option>
                                    <option value="1">选项1</option>
                                    <option value="2">选项2</option>
                                    <option value="3">选项3</option>
                                </select>
                            </div> -->
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary" > 搜索</button> </span>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover " id="editable">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="">
                                    </th>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>图标</th>
                                    <th>排序</th>
                                    <th>是否显示</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lists as $list)
                                    <tr class="gradeX">
                                        <td>
                                            <input type="checkbox" name="all[]" value="{{$list->id}}">
                                        </td>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->name}}</td>
                                        <td>
                                            <span class="{{$list->icon}}"></span>
                                        </td>
                                        <td>{{$list->sort}}</td>
                                        <td class="center">
                                            <!-- <div class="switch">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" checked class="onoffswitch-checkbox" id="example{{$list->id}}" value="{{$list->visible}}">
                                                    <label class="onoffswitch-label" for="example{{$list->id}}">
                                                        <span class="onoffswitch-inner btn_status" data-id="{{$list->id}}"></span>
                                                        <span class="onoffswitch-switch btn_status" data-id="{{$list->id}}"></span>
                                                    </label>
                                                </div>
                                            </div> -->

                                            <div class="switch">
                                                <div class="onoffswitch">
                                                    @if($list->visible == 1)
                                                        <input type="checkbox" checked class="onoffswitch-checkbox" id="example{{$list->id}}" value="0">
                                                    @else
                                                        <input type="checkbox" class="onoffswitch-checkbox" id="example{{$list->id}}" value="1">
                                                    @endif
                                                    <label class="onoffswitch-label" for="example{{$list->id}}">
                                                        <span class="onoffswitch-inner btn_status" data-id="{{$list->id}}"></span>
                                                        <span class="onoffswitch-switch btn_status" data-id="{{$list->id}}"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="center">
                                            <button type="button" class="btn btn-info btn-xs btn_edit" data-id="{{$list->id}}">编辑</button>
                                            <button type="button" class="btn btn-danger btn-xs btn_delete" data-id="{{$list->id}}">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="editable_paginate">
                                    {{$lists->links()}}
                                </div>
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
    <!-- 表格 -->
    <script src="/static/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/static/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <!-- 自定义js -->
    <script src="/static/js/content.js?v=1.0.0"></script>
    <script src="/static/js/plugins/layer/layer.min.js"></script>

    <!-- 自定义提示 -->
    <script src="/static/js/plugins/toastr/toastr.min.js"></script>

    <!--页面js -->
    <script>

        //编辑
        $("#btn_create").click( function () {
            
            var url = $(this).attr('data-url');//"{{url('node_group/create')}}";

            console.log(url);

            layer.open({
                type: 2,
                title:'新增数据',
                skin: 'layui-layer-demo', //样式类名
                closeBtn: 1, //不显示关闭按钮
                anim: 2,
                shadeClose: true, //开启遮罩关闭
                area: ['80%', '80%'], //宽高
                content: url
            })
        });

        //新增
        $("#btn_edit").click( function () {

            layer.open({
                type: 2,
                skin: 'layui-layer-demo', //样式类名
                closeBtn: 1, //不显示关闭按钮
                anim: 2,
                shadeClose: true, //开启遮罩关闭
                area: ['80%', '80%'], //宽高
                content: url
            })

        });


        $(".btn_status").click( function () {

            var id  =  $(this).attr('data-id');
            var url =  $(this).attr('data-url');
            var status = $('example#'+id).val();

            $.get(url, { name: "John", time: "2pm" } );


            if($('example#'+id).is(":checked")){

                console.log(1);
            }else{

                console.log(0);
            }
            //console.log(0);
        });





        // function btn_notice()
        // {

        //     toastr.success('操作成功!');
        //     toastr.error('操作失败!');
        // }


    </script>

</body>

</html>
