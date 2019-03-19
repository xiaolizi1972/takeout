@extends('admin.public.mian')
@section('content')

<div class="content-wrapper">
    
    <section class="content-header">
      <h1>添加管理员</h1
    </section>

    <!-- 内容主体-->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form class="form-horizontal" autocomplete="off" id="defaultForm" action="{{url('admin/store')}}">
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label for="username" class="col-sm-2  control-label">
                                    <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">管理员账号</font></font>
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"  name="username" value="" class="form-control name" placeholder="请输入管理员账号">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-2  control-label">
                                    <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">登录密码</font></font>
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-eye-slash fa-fw"></i>
                                        </span>
                                        <input type="password"  name="password"  class="form-control name" placeholder="请输登录密码">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-2  control-label">
                                    <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">确认密码</font></font>
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-eye-slash fa-fw"></i>
                                        </span>
                                        <input type="password"  name="password_confirmation"  class="form-control name" placeholder="请确认密码">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="realname" class="col-sm-2  control-label">
                                    <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">真实姓名</font></font>
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                        <input type="text"  name="realname" class="form-control name" placeholder="请输入管理员真实姓名">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mobile" class="col-sm-2  control-label">
                                    <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">手机号</font></font>
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-mobile fa-fw"></i></span>
                                        <input type="text" name="mobile" class="form-control name" placeholder="请输入手机号码">
                                    </div>
                                </div>
                            </div>
                            <!-- 
                            <div class="form-group">
                                <label for="mobile" class="col-sm-2  control-label">
                                   所属角色
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control">
                                        <option value="">请选择角色</option>
                                        <option>option 2</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label for="mobile" class="col-sm-2  control-label">
                                   账号状态
                                </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="radio">
                                            <label>
                                              <input type="radio" name="status"  value="1" checked="">正常
                                            </label>
                                            <label>
                                                <input type="radio" name="status"  value="0" >禁用
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                     
                        <div class="box-footer text-center">
                            <button type="reset" class="btn btn-default">取消</button>
                            <button type="submit" class="btn btn-info pull-center">提交</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </section>
</div>
<script src="/admin/static/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/admin/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
<script src="/admin/layer/layer.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
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
                        
                        location.href = "{{url('admin/index')}}";
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
});


</script>
@endsection


