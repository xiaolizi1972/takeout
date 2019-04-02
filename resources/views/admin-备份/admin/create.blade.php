@extends('admin.public.form')

@section('content')
<!-- 主体内容部分 -->

    <!-- 主题内容 -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <!-- <div class="box-header with-border">
                      <h3 class="box-title">新增权限</h3>
                    </div> -->
                    <form class="form-horizontal" autocomplete="on" id="defaultForm" action="{{url('admin/store')}}">
                         @csrf
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">账号</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  placeholder="登录账号" name="username" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">密码</label>

                                <div class="col-sm-6">
                                    <input type="password" class="form-control" placeholder="登录密码" name="password" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sort" class="col-sm-2 control-label">确认密码</label>

                                <div class="col-sm-6">
                                    <input type="password" class="form-control"  placeholder="确认密码" name="password_confirmation">
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="sort" class="col-sm-2 control-label">手机号码</label>

                                <div class="col-sm-6">
                                    <input type="number" class="form-control"  placeholder="管理员手机号码" name="mobile">
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="sort" class="col-sm-2 control-label">真实姓名</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  placeholder="真实姓名" name="realname">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mobile" class="col-sm-2  control-label">
                                   所属角色
                                </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="role">

                                        <option value="">请选择角色</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">状态</label>

                                <div class="col-sm-8">
                                    <div class="radio">
                                    <label for="status1">
                                        <input  checked="checked" name="status" type="radio" value="1" > 是</label> 
                                    <label for="status0">
                                        <input   name="status" type="radio" value="0"> 否
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
                            
                            parent.location.href=document.referrer;
                        },1200);
                    }
                }, 'json');

            },
            fields: {
                username: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: '请输入账号'
                        },
                        // remote: {
                        //     url: 'remote.php',
                        //     message: 'The username is not available'
                        // },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: '账号必须是字母和数组'
                        }
                    }
                },
                realname: {
                    validators: {
                        notEmpty: {
                            message: '请输入真实姓名'
                        },
                       
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: '请输入密码'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        notEmpty: {
                            message: '请再次确认密码'
                        },
                        identical: {
                            field: 'password',
                            message: '两次密码输入不一致'
                        }
                    }
                },
                mobile: {
                    validators: {
                        notEmpty: {
                            message: '请输入手机号'
                        }
                    }
                },
            }
        });

    </script>
@endsection