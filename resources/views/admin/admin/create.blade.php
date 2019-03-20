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
                    <form class="form-horizontal" autocomplete="on" id="default_form">
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
                                    <input type="password" class="form-control"  placeholder="确认密码" name="sort">
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
                                    <input type="number" class="form-control"  placeholder="排序" name="sort">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">状态</label>

                                <div class="col-sm-8">
                                    <div class="radio">
                                    <label for="status1">
                                        <input  checked="checked" name="status" type="radio" value="1"> 是</label> 
                                    <label for="status0">
                                        <input  checked="checked" name="status" type="radio" value="0"> 否
                                    </label>
                                </div>    
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
    </script>
@endsection