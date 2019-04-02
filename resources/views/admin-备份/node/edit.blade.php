@extends('admin.public.form')

@section('content')
<!-- 主体内容部分 -->

    <!-- 主题内容 -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">新增权限</h3>
                    </div>
                    <form class="form-horizontal" autocomplete="on" id="defaultForm" action="{{url('node/update',array('id'=>$node->id))}}">
                         @csrf
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">分组</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="group_id" style="width: 100%;">
                                        @foreach ($node_groups as $group)
                                            <option value="{{$group->id}}" @if($node->group_id == $group->id) selected @endif>{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">父级</label>
                                <div class="col-sm-6">
                                    <select class="form-control " name="pid" style="width: 100%;">

                                        <option value="0">无</option>
                                        @foreach($nodes as $node_val)
                                            <option value="{{$node_val->id}}" @if($node->pid == $node_val->id) selected @endif>{{$node_val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  placeholder="权限名称" name="name" value="{{$node->name}}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="route" class="col-sm-2 control-label">规则</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="权限规则" name="route" value="{{$node->route}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sort" class="col-sm-2 control-label">排序</label>

                                <div class="col-sm-6">
                                    <input type="number" class="form-control"  placeholder="排序" name="sort" value="{{$node->sort}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">显示</label>

                                <div class="col-sm-8">
                                    <div class="radio">
                                    <label for="visible1">
                                        <input name="visible" type="radio" value="1" @if($node->visible == 1)  checked="checked" @endif> 是</label> 
                                    <label for="visible0">
                                        <input name="visible" type="radio" value="0" @if($node->visible == 0)  checked="checked" @endif> 否
                                    </label>
                                </div>    
                                </div>
                            </div>

                        </div>
                        <div class="box-footer text-center">
                            <button type="reset" class="btn btn-default">取消</button>
                            <button type="submit" class="btn btn-info">保存</button>
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
            group_id: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '请选择分组'
                    },
                }
            },
            pid: {
                validators: {
                    notEmpty: {
                        message: '请选择上级'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: '请输入名称'
                    }
                }
            },
             route: {
                validators: {
                    notEmpty: {
                        message: '请输入规则'
                    }
                }
            },
            
        }
    });


    </script>
@endsection