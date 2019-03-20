@extends('admin.public.form')

@section('content')
<!-- 主体内容部分 -->


   <!--  <section class="content-header">
      <h1>新增权限</h1>
    </section> -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">新增权限</h3>
                    </div>
                    <form class="form-horizontal" autocomplete="on" id="default_form">
                         @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">权限名称</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  placeholder="权限名称" name="name" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="route" class="col-sm-2 control-label">权限规则</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="权限规则" name="route" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">图标</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  placeholder="图标" name="icon">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sort" class="col-sm-2 control-label">排序</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  placeholder="排序" name="sort">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">父级权限</label>
                                <div class="col-sm-6">
                                    <select class="form-control " name="pid" style="width: 100%;">
                                        @foreach($parent_node as $node)
                                        <option value="{{$node->id}}">{{$node->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">权限组</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="group_id" style="width: 100%;">
                                        @foreach ($node_groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">菜单</label>

                                <div class="col-sm-8">
                                    <div class="radio">
                                    <label for="visible1">
                                        <input  checked="checked" name="visible" type="radio" value="1"> 是</label> 
                                    <label for="visible0">
                                        <input  checked="checked" name="visible" type="radio" value="0"> 否
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