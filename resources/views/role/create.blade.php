<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>权限树扩展分享</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/bootstrap-validator/dist/css/bootstrapValidator.min.css">
    <link href="/static/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/static/layui-authtree/layui/css/layui.css">
</head>
<body>
<div class="layui-container">
    
    <div class="layui-row">
        <div class="layui-col-md11">
            <div class="layui-elem-field layui-field-title">
                <!-- <legend>权限树操作演示</legend> -->
            </div>
            <div class="layui-form">
                <div class="layui-form-item">
                    <div class="layui-form-label">普通操作</div>
                    <div class="layui-form-block">
                        <button type="button" class="layui-btn layui-btn-primary" onclick="checkAll('#LAY-auth-tree-index')">全选</button>
                        <button type="button" class="layui-btn layui-btn-primary" onclick="uncheckAll('#LAY-auth-tree-index')">全不选</button>
                        <button type="button" class="layui-btn layui-btn-primary" onclick="showAll('#LAY-auth-tree-index')">全部展开</button>
                        <button type="button" class="layui-btn layui-btn-primary" onclick="closeAll('#LAY-auth-tree-index')">全部隐藏</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="layui-col-md11">
            <form class="layui-form">
                @csrf
                <div class="layui-form-item">
                    <label class="layui-form-label">角色名称</label>
                    <div class="layui-input-block">
                        <input class="layui-input" type="text" name="name" placeholder="请输入角色名称" />
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">选择权限</label>
                    <div class="layui-input-block">
                        <div id="LAY-auth-tree-index"></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" type="submit" lay-submit lay-filter="LAY-auth-tree-submit">提交</button>
                        <button class="layui-btn layui-btn-primary" type="reset">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>


<script src="/static/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/js/bootstrap.min.js?v=3.3.6"></script>
<!-- 自定义js -->
<script src="/static/js/content.js?v=1.0.0"></script>
<script src="/static/js/plugins/layer/layer.min.js"></script>
<!-- iCheck -->
<script src="/static/js/plugins/iCheck/icheck.min.js"></script>
<script src="/static/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
<script src="/static/js/plugins/toastr/toastr.min.js"></script>
<script type="text/javascript" src="/static/layui-authtree/layui/layui.js"></script>

<script type="text/javascript">
    layui.config({
        base: '/static/layui-authtree/extends/',
    }).extend({
        authtree: 'authtree',
    });
    layui.use(['jquery', 'authtree', 'form', 'layer'], function(){
        var $ = layui.jquery;
        var authtree = layui.authtree;
        var form = layui.form;
        var layer = layui.layer;
        // 初始化
        $.ajax({
            url: "{{url('role/role_data')}}",
            dataType: 'json',
            success: function(data){
                // 渲染时传入渲染目标ID，树形结构数据（具体结构看样例，checked表示默认选中），以及input表单的名字
                authtree.render('#LAY-auth-tree-index', data.data, {
                    inputname: 'nodes[]'
                    ,layfilter: 'lay-check-auth'
                    ,autowidth: true
                });
            },
            error: function(xml, errstr, err) {
                layer.alert(errstr+'，获取样例数据失败，请检查是否部署在本地服务器中！');
            }
        });
        // 表单提交样例
        form.on('submit(LAY-auth-tree-submit)', function(obj){
            var authids = authtree.getChecked('#LAY-auth-tree-index');
            console.log('Choosed authids is', authids);
            // obj.field.authids = authids;
            $.ajax({
                url: "{{url('role/store')}}",
                dataType: 'json',
                data: obj.field,
                type: "POST",
                success: function(rs){

                     if(rs.status == 200){

                            toastr.success(rs.message);
                           
                            setTimeout(function(){
                                
                                parent.location.reload();
                            },1200);

                        }else{

                            toastr.error(rs.message);
                        }

                }
            });
            return false;
        });
    });

</script>
<script type="text/javascript">


// 全选样例
function checkAll(dst){
    layui.use(['jquery', 'layer', 'authtree'], function(){
        var layer = layui.layer;
        var authtree = layui.authtree;

        authtree.checkAll(dst);
    });
}

// 全不选样例
function uncheckAll(dst){
    layui.use(['jquery', 'layer', 'authtree'], function(){
        var layer = layui.layer;
        var authtree = layui.authtree;

        authtree.uncheckAll(dst);
    });
}
// 显示全部
function showAll(dst){
    layui.use(['jquery', 'layer', 'authtree'], function(){
        var layer = layui.layer;
        var authtree = layui.authtree;

        authtree.showAll(dst);
    });
}
// 隐藏全部
function closeAll(dst){
    layui.use(['jquery', 'layer', 'authtree'], function(){
        var layer = layui.layer;
        var authtree = layui.authtree;

        authtree.closeAll(dst);
    });
}


</script>

</html>
