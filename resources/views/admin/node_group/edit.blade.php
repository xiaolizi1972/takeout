@extends('admin.public.form')

@section('content')
<!-- 主体内容部分 -->

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form class="form-horizontal" autocomplete="on" id="defaultForm" action="{{url('NodeGroup/update',array('id'=>$node_group->id))}}">
                     @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">名称</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control"  placeholder="分组名称" name="name"  value="{{$node_group->name}}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="icon" class="col-sm-2 control-label">图标</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control"  placeholder="分组图标" name="icon" value="{{$node_group->icon}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sort" class="col-sm-2 control-label">排序</label>

                            <div class="col-sm-6">
                                <input type="number" class="form-control"  placeholder="排序" name="sort" value="{{$node_group->sort}}">
                                <span class="text-success">根据数值倒序排</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">菜单</label>

                            <div class="col-sm-6">
                                <div class="radio">
                                    <label for="visible1">
                                        <input name="visible" type="radio" value="1" @if($node_group->visible == 1) checked="checked" @endif> 是
                                    </label> 
                                    <label for="visible0">
                                        <input name="visible" type="radio" value="0"  @if($node_group->visible == 0) checked="checked" @endif> 否
                                    </label>
                                </div>    
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
                    regexp: {
                        regexp: /^[\u4e00-\u9fa5]+$/,
                        message: '请输入汉字'
                    }
                }
            },
            icon: {
                validators: {
                    notEmpty: {
                        message: '请输入图标'
                    }
                }
            },
        }
    });
    
</script>
@endsection