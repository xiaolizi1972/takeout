@extends('admin.public.form')

@section('content')
    <!-- 主体内容部分 -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <!-- <div class="box-header with-border">
                      <h3 class="box-title">新增角色</h3>
                    </div> -->
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

                                <div class="col-sm-6">
                                    




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