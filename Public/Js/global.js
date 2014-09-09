$(function(){
	$('.my-nav').tree({
		onClick:function(node){
			_addTabs(node.text,node.href);
		}
	});
});
var _tabDblclick = function(){
	var tab = $('#home_tabs').tabs('getSelected');
	var opt = tab.data('panel').options;
	var form = $('#ea_jump_form');
	form.attr('action',opt.href);
	form.find('input').val(opt.title);
	form.submit();
};
var _addTabs = function(title,content_href){
	if($('#home_tabs').tabs('exists',title)){
		$('#home_tabs').tabs('select',title);
	}else{
		$('#home_tabs').tabs('add',{
			title:title,
			href:content_href,
			closable:true
		});
		var tab = $('#home_tabs').tabs('getSelected');
		var index = $('#home_tabs').tabs('getTabIndex',tab);
		$('.tabs-inner').eq(index).on('dblclick',function(){
			_tabDblclick();
		});
	}
};
(function($){
	
})(jQuery);