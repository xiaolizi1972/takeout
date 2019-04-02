@extends('admin.public.form')

@section('content')
    <!-- 主体内容部分 -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form class="form-horizontal" autocomplete="on" id="defaultForm" action="{{url('role/store')}}">
                         @csrf
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  placeholder="名称" name="name" >
                                </div>
                            </div>

                            <div class="form-group" id="permission">
                                <label for="password" class="col-sm-2 control-label">选择权限</label>
                                    <div class="col-sm-8">
                                        @foreach($node_tree as $tree)
                                        <div class="radio">
                                            <!-- <i class="fa fa-minus-square-o"></i> -->
                                            <label for="visible1">
                                               <input  type="checkbox"  class="level-tree-group" group-id="{{$tree->id}}">
                                               {{$tree->name}}
                                            </label>

                                            @foreach($tree->parent as $parent)
                                            <div class="permission_p">
                                                <div class="radio">
                                                    &nbsp;&emsp;&emsp;
                                                   <!--  <i class="fa fa-plus-square-o"></i> -->
                                                    <label for="visible1">
                                                        <input name="all_list[]" type="checkbox"  class="level-tree-group{{$parent->group_id}} level-tree-parent" parent-id="{{$parent->id}}"  value="{{$parent->id}}">
                                                        {{$parent->name}}
                                                    </label>
                                                </div>

                                                <div class="radio">
                                                    @foreach($parent->child as $child)
                                                        &nbsp;&emsp;&emsp;
                                                        <label for="visible1">
                                                            <input name="all_list[]" type="checkbox" class="level-tree-group{{$child->group_id}} level-tree-child{{$child->pid}}"  value="{{$child->id}}">
                                                            {{$child->name}}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                        <div class="box-footer text-center">
                            <button type="reset" class="btn btn-default">取消</button>
                            <button type="submit" class="btn btn-info" >保存</button>
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


        //选择组
        $(".level-tree-group").click( function () { 

            var id =  $(this).attr('group-id');
            console.log($(".level-tree-group"+id))
            if($(this).is(':checked')) {

                $(".level-tree-group"+id).prop("checked",true);


            }else{

                $(".level-tree-group"+id).prop("checked",false); 
            }
        });

        //父级选择子级
        $(".level-tree-parent").click( function () { 

            var id =  $(this).attr('parent-id');

            if($(this).is(':checked')) {

                $(".level-tree-child"+id).prop("checked", true);

            }else{

                $(".level-tree-child"+id).prop("checked",false);  
            }
        });


        //提交表单
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
                            
                            parent.location.reload();
                        },1200);
                    }
                }, 'json');

            },
            fields: {
                name: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: '请输入角色名称'
                        },
                    }
                },
            }
        });

    </script>
@endsection