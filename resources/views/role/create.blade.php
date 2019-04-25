<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - 树形视图</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/plugins/jsTree/style.min.css" rel="stylesheet">
    <link href="/static/css/animate.css" rel="stylesheet">
    <link href="/static/css/style.css?v=4.1.0" rel="stylesheet">
    <link href="/static/bootstrap-validator/dist/css/bootstrapValidator.min.css" rel="stylesheet" >
    <link href="/static/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="/static/layui-authtree/layui/css/layui.css" rel="stylesheet" type="text/css" >
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="layui-row">
            <div class="layui-col-md12">
                <div class="ibox float-e-margins">
                
                    <form class="layui-form">
                        @csrf
                        <div class="layui-form-item" style="margin:10px;
                        ">
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
    </div>

    <!-- 全局js -->
    <script src="/static/js/jquery.min.js?v=2.1.4"></script>
    <script src="/static/js/bootstrap.min.js?v=3.3.6"></script>
    <!-- 自定义js -->
    <script src="/static/js/content.js?v=1.0.0"></script>
    <!-- jsTree plugin javascript -->
    <script src="/static/bootstrap-validator/dist/js/bootstrapValidator.js"></script>
    <script src="/static/js/plugins/toastr/toastr.min.js"></script>
    <script type="text/javascript" src="/static/layui-authtree/layui/layui.js"></script>

    <style>
        .jstree-open > .jstree-anchor > .fa-folder:before {
            content: "\f07c";
        }

        .jstree-default .jstree-icon.none {
            width: 0;
        }
    </style>

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
					inputname: 'ids[]'
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
				url: 'tree.json',
				dataType: 'json',
				data: obj.field,
				success: function(res){
					layer.alert('提交成功！');
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

</body>

</html>
