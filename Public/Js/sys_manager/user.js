var $grid = $('#user_grid');
var viewDialog;
context.ready = function(){
	$grid.datagrid({
		url : '{:U("User/getData")}',
		pagination : true,
		fit : true,
		sortName:'create_time',
		border : false,
		toolbar : [{
			text : '新增',
			iconCls : 'icon-add1',
			handler : context.addView
		},{
			text : '删除',
			iconCls : 'icon-remove1',
			handler : context.doDelete
		}],
		columns : [[
			{checkbox : true},
			{field : 'username',title : '账号',width : 110,align : 'center'},
			{field : 'nickname',title : '昵称',width : 110,align : 'center'},
			{field : 'email',title : '邮箱',width : 150,align : 'center'},
			{field : 'create_time',title : '创建时间',width : 130,align : 'center',sortable : true},
			{field : 'login_time',title : '上次登录时间',width : 130,align : 'center',sortable : true},
			{field : 'login_ip',title : '上次登录IP',width : 100,align : 'center'},
			{field : 'sex',title : '性别',width : 60,align : 'center'},
			{field:'status',title:'状态',width:60,align:'center',
				formatter:function(value){if(value != '正常'){
					return '<span style="color:red;">'+value+'</span>';}return value;}},
			{field : 'user_id',title : '操作',width : 60,align : 'center',
				formatter : function(value, row, index){
					return '<span title="编辑" class="img-btn icon-edit1 dont-check" uid="'
							+ value + '"></span>';
				}
			}]],
		onLoadSuccess : function(data){
			var $bodyView = $grid.data('datagrid').dc.view2;
			$bodyView.find('span[uid]').click(function(e){
				e.stopPropagation();
				context.updateView($(this).attr('uid'));
			});
		}
	});

	$('#user_search_btn').click(function(){
		$grid.datagrid('load', $('#user_search_form').toJson());
	});
};
context.addView = function(){
	viewDialog = $.dialog({
		title : '新增用户',
		href : "{:U('User/toAdd')}",
		width : 450,
		height : 300,
		buttons : [{
			text : '提交',
			handler : context.doSubmit
		}]
	});
}
context.updateView = function(uid){
}
context.doDelete = function(){
	var checked = $grid.datagrid('getChecked');
	if (checked && checked.length > 0) {
		$.confirm('确认删除?', function(r){
			if (r) {
				var ids = [];
				$.each(checked, function(){
					ids.push(this.user_id);
				});

				$.post("{:U('User/doDelete')}", {
					ids : ids.join(',')
				}, function(ret){
					if (ret.status) {
						$grid.datagrid('reload');
					} else {
						$.alert(ret.msg);
					}
				});
			}
		});
	}
}
context.doSubmit = function(){
	$ea_user_form = $('#ea_user_form');
	if ($ea_user_form.form('validate')) {
		$.post("{:U('User/doSave')}", $ea_user_form.toJson(), function(ret){
			if (ret.status) {
				$grid.datagrid('reload');
				viewDialog.close();
			} else {
				$.alert(ret.msg);
			}
		});
	}
}