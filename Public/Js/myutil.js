function NameSpace(path,cb){
	var o = {},d;
	d = path.split(".");
	o = window[d[0]] || {};  //My
	for(var k = 0; k < d.slice(1).length; k++){
		o = o[d[k + 1]] || {};  //
	}
	if(cb){
		cb.call(o);
		if(o.ready && typeof o.ready === "function"){
			o.ready.call();
		}
	}
}

/* 去除字符串左右空格 */
String.prototype.trim = function() {
    return this.replace(/^\s*/,"").replace(/\s*$/,"");
};

$.ajaxSetup({
	error:function(xhr,status,e){
		switch(xhr.status){
			case 404:
				$.alert('未找到该页面');
				break;
			case 901:
				$.alert('未登录');
				break;
			default:
				break;
		}
	}
});

/* dialog的封装操作 */
(function($){
	$.dialog = function(options) {
		var _default = {
			top:90,
			modal:true,
			onClose: function(){
				$(this).dialog("destroy");
			}
		};
		option =$.extend(_default, options);
		
		var dialog = $(option.el || '<div/>');
		if(option.bodyCls){
			dialog.css(option.bodyCls);
		}
		
		$.get(option.href,function(ret){
			option.href = null;
			dialog.dialog(option);
			var content = dialog.find('div.dialog-content');
			content.html($.fn.panel.defaults.extractor(ret));
			if($.parser){
				$.parser.parse(content);
			}
			if(option.onLoad){
				option.onLoad.call(dialog);
			}
		},'html');
		
		dialog.close = function(){
			dialog.dialog('destroy');
		}
		return dialog;
	};
	
	$.alert = function(){
		var title = '提示';
		if(arguments.length === 1){
			$.messager.alert(title,arguments[0]);
		}else if(arguments.length === 2 && typeof arguments[1] === 'string'){
			$.messager.alert(title,arguments[0],arguments[1]);
		}else if(arguments.length ===2 && typeof arguments[1] === 'function'){
			$.messager.alert(title,arguments[0],'',arguments[1]);
		}else if(arguments.length === 3){
			$.messager.alert(title,arguments[0],arguments[1],arguments[2]);
		}
	}
	
	$.confirm = function(msg,callback){
		$.messager.confirm('确认',msg,callback);
	}

	$.fn.toJson = function(){
		var arrayValue = $(this).serializeArray();
		var j = {};
		$.each(arrayValue,function(){
			if(j[this['name']]){
				j[this['name']] += ','+this['value'];
			}else{
				j[this['name']] = this['value'];
			}
		});
		return j;
	}

	/* 修改easyui默认值 */
	$.extend($.fn.datagrid.defaults,{
		onLoadSuccess: function(data){
			if(typeof data === 'object' && data.total == 0){
				var body = $(this).data('datagrid').dc.body2;
				body.find('table tbody').append('<tr><td width="'+body.width()+'" style="height:25px;text-align:center;color:red;">没有数据</td></tr>');
			}
		},
		pageList:[20,30,50],
		pageSize:20,
		sortOrder:'desc'
	});
	$.extend($.fn.datetimebox.defaults,{
		editable: false
	});
	$.extend($.fn.combobox.defaults,{
		panelHeight:'auto',
		editable:false
	});
	$.extend($.fn.tree.defaults,{
		animate:true,
		lines:true
	});
})(jQuery);