@extends('admin.public.form')

@section('content')
    <!-- 主体内容部分 -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <!-- 
                        <div class="box-header with-border">
                          <h3 class="box-title">新增角色</h3>
                        </div> 
                    -->
                    <form class="form-horizontal" autocomplete="on" id="default_form">
                         @csrf
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  placeholder="名称" name="name" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">选择权限</label>
                                <div class="col-sm-12">

                                    @foreach($node_tree as $tree)
                                    <div class="radio">
                                        <i class="fa fa-minus-square-o"></i>
                                        <label for="visible1">
                                           <input name="all_list[]" type="checkbox" onclick="check_group({{$tree->id}}, this)" class="top-group{{$tree->id}}">{{$tree->name}}
                                        </label>
                                    </div>

                                        @foreach($tree->parent as $parent)
                                        <div>
                                            <div class="radio">
                                                &nbsp;&emsp;&emsp;
                                                <i class="fa fa-plus-square-o"></i>
                                                <label for="visible1">
                                                    <input name="all_list[]" type="checkbox" class="tree-group{{$parent->group_id}}" onclick="check_child({{$parent->id}}, {{$parent->group_id}},this)">{{$parent->name}}
                                                </label>
                                            </div>
                                            <div class="radio">
                                                &nbsp;&emsp;&emsp;&emsp;
                                                
                                                @foreach($parent->child as $child)
                                                    <label for="visible1">
                                                        <input name="all_list[]" type="checkbox" class="tree-group{{$child->group_id}} tree-child{{$child->pid}}">{{$child->name}}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <button type="reset" class="btn btn-default">取消</button>
                            <button type="button" class="btn btn-info" onclick="btn_sub()">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('form_js')
    @include('admin.public.form_js')
    <script type="text/javascript">
        function btn_sub()
        {
            var url = "{{url('node/store')}}";

            $.post(url,$("#default_form").serialize(),function(rs){

                layer.msg(rs.message);

                if(rs.status == 200){

                    setTimeout(function(){

                        location.href=document.referrer;
                    },1200)
                }
            });
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


        //选择组
        function check_group(val, _this)
        {
            if($(_this).is(':checked')) {

               $(".tree-group"+val).attr("checked",'checked'); 

            }else{
                console.log(0)
               $(".tree-group"+val).removeAttr("checked"); 
            }
        }

        //选择孩子
        function check_child(val, group_id, _this)
        {

            if($(_this).is(':checked')) {

               $(".tree-child"+val).attr("checked",'checked'); 

               $(".top-group"+group_id).attr("checked",'checked');

            }else{
               $(".tree-child"+val).removeAttr("checked"); 
            }

        }

    </script>
@endsection