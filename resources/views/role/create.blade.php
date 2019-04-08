<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 树形视图</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/plugins/jsTree/style.min.css" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <form method="post" class="form-horizontal" id="defaultForm" action="{{url('role/store')}}">
                        @csrf
                        <div class="ibox-content">
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">名称</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">选择节点</label>
                                <div class="col-sm-6">
                                    <div class="tree-lists">
                                        <ul>
                                            @foreach($nodes as $group)
                                                <li class="jstree" >
                                                    <span class="tree-list-group" date-id="{{$group->id}}"> 
                                                        {{$group->name}} 
                                                    </span>
                                                    <input type="checkbox" name="node[]" style="display: none;">
                                                    <ul>
                                                        @foreach($group->parent as $parent)
                                                            <li>
                                                                <span class="tree-list-parent"> 
                                                                   <!--  <i class="jstree-icon jstree-themeicon fa fa-square-o jstree-themeicon-custom" role="presentation"></i> -->
                                                                    {{$parent->name}} 
                                                                </span>
                                                                <input type="checkbox" name="node[]" style="display: none;">
                                                                <ul>
                                                                    @foreach($parent->child as $child)
                                                                        <li>
                                                                            <span> 
                                                                                {{$child->name}} 
                                                                            </span>
                                                                            <input type="checkbox" name="node[]" style="display: none;">
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <script src="/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/js/bootstrap.min.js?v=3.3.6"></script>
    <!-- 自定义js -->
    <script src="/static/js/content.js?v=1.0.0"></script>
    <!-- jsTree plugin javascript -->
    <script src="/static/js/plugins/jsTree/jstree.min.js"></script>

    <style>
        .jstree-open > .jstree-anchor > .fa-folder:before {
            content: "\f07c";
        }

        .jstree-default .jstree-icon.none {
            width: 0;
        }
    </style>

    <script>

        $(document).ready(function () {

            $('.tree-lists').jstree({
                'core': {
                    'check_callback': true
                },
                'plugins': ['types', 'dnd'],
                'types': {
                    'default': {
                        'icon': 'fa fa-square-o'
                    },
                    'html': {
                        'icon': 'fa fa-check-square'
                    },
                }
            });
        });


        //组选中
        $(".tree-lists .tree-list-group").click( function () { 

            console.log(111);

           // $('.tree-list-parent').prop('class','jstree-icon jstree-themeicon fa fa-check-square jstree-themeicon-custom');


            //$(this).hide();

        });


        //父级选中




        //子级选中


    </script>

    
    
</body>

</html>
