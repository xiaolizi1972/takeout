@extends('admin.public.table')

@section('content')
<!--主体内容部分 -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>权限列表</h1>
    </section>
    <!-- 表格 -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <div class="col-sm-2">
                                <a href="javascript:btn_create()" class="btn btn-success" title="添加">
                                    <i class="fa fa-plus"></i> 添加
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-sm" >
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="th-inner ">
                                                    <input name="all_list[]" type="checkbox" onclick="check_all(this)">
                                                </div>
                                            </th>
                                            <th>ID</th>
                                            <th>名称</th>
                                            <th>路由</th>
                                            <th>排序</th>
                                            <th>菜单</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lists as $list)
                                            <tr class="parent-tree{{$list->id}}" parent-show="0" parent-data="{{$list->id}}">
                                                <td>
                                                    <div class="th-inner check-all ">
                                                        <input name="all_list[]" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->name}}</td>
                                                <td>{{$list->route}}</td>
                                                <td>{{$list->sort}}</td>
                                                <td>
                                                    @if($list->visible == 1)
                                                   
                                                        <a href="javascript:;" class="searchit" >
                                                            <span class="text-green">
                                                                <i class="fa fa-circle"></i> 正常
                                                            </span>
                                                        </a>
                                                    @else
                                                       
                                                        <a href="javascript:;" class="searchit" >
                                                            <span class="text-gray">
                                                                <i class="fa fa-circle"></i> 隐藏
                                                            </span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:check_tree({{$list->id}})" data-toggle="tooltip" class="btn btn-xs btn-success btn-node-sub" >
                                                        <i class="fa fa-sitemap"></i>
                                                    </a>

                                                    <a href="{{url('admin/edit',array('id'=>$list->id))}}" class="btn btn-xs btn-success btn-editone">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-xs btn-danger btn-delone" >
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            
                                            @isset($list->child)
                                                @foreach($list->child as $child)
                                                    <tr class="child-tree tree_{{$child->pid}}" style="display: none;">
                                                        <td>
                                                            <div class="th-inner ">
                                                                <input name="all_list[]" type="checkbox">
                                                            </div>
                                                        </td>
                                                        <td>{{$child->id}}</td>
                                                        <td>&emsp;├ {{$child->name}}</td>
                                                        <td>{{$child->route}}</td>
                                                        <td>{{$child->sort}}</td>
                                                        <td>
                                                           @if($child->visible == 1)
                                                   
                                                                <a href="javascript:;" class="searchit" >
                                                                    <span class="text-green">
                                                                        <i class="fa fa-circle"></i> 正常
                                                                    </span>
                                                                </a>
                                                            @else
                                                               
                                                                <a href="javascript:;" class="searchit" >
                                                                    <span class="text-gray">
                                                                        <i class="fa fa-circle"></i> 隐藏
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{url('admin/edit',array('id'=>$child->id))}}" class="btn btn-xs btn-success btn-editone">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="javascript:;" class="btn btn-xs btn-danger btn-delone" >
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('table_js')
    @include('admin.public.table_js')
    <script type="text/javascript">   
        function btn_create()
        {   
            var url = "{{url('node/create')}}";

            layer.open({
              type: 2,
              skin: 'layui-layer-demo', //样式类名
              closeBtn: 1, //不显示关闭按钮
              anim: 2,
              shadeClose: true, //开启遮罩关闭
              content: url,
              area: ['70%', '80%'],
            });   
        }


        //查看树
        function check_tree(val) 
        {
            var show = $('.parent-tree'+val).attr('parent-show');
     
            if(show == 0){

                $('.tree_'+val).show();
                $('.parent-tree'+val).attr('parent-show',1);
            }else{
                $('.tree_'+val).hide();
                $('.parent-tree'+val).attr('parent-show',0);
            }
        }


        //全选
        function check_all(_this)
        {

            if($(_this).is(':checked')) {
                
               $("input[type='checkbox']").attr("checked",true); 

            }else{
                $("input[type='checkbox']").attr("checked",false); 
            }
        }

    </script>
@endsection
