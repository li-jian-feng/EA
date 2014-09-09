var _tmp;
context.ready = function() {
	context.addMenuEvent();
	context.checkOneMenu();
	$('#menu_save_btn').on('click', context.doSubmit);
	$('#menu_del_btn').on('click', context.doDelete);
	$('#menu_save_server').on('click', context.saveServer);
	$('#menu_close_server').on('click', context.closeServer);

	$('select[name=type]').combobox({
		onChange : function(n, o) {
			if (n == 'VIEW') {
				$('input[name=url]').parents('tr').css('display', '');
			} else {
				$('input[name=url]').parents('tr').css('display', 'none');
			}
		}
	});
}
context.doSubmit = function() {
	$menu_form = $('#weixin_menu_form');
	if ($menu_form.form('validate') && $('input[name=pid]').val() != '') {
		$.post("{:U('Weixin/Menu/doSave')}", $menu_form.toJson(),
				function(ret) {
					if (ret.status) {
						var data = $.parseJSON(ret.data);
						var _new = $('<div>' + data.name + '</div>');
						_new.attr({
							'data-url' : data.url,
							'data-sort' : data.sort,
							'data-type' : data.type,
							'data-id' : data.id,
							'data-pid' : data.pid
						});
						if ('number' == typeof _tmp) { // 第一级菜单
							var _ul = $('<ul></ul>');
							$('div[data-tmp=' + _tmp + ']').parent().html(_new)
									.append(_ul);
							context.checkTwoMenu(_ul);
						} else if ('object' == typeof _tmp) { // 第二级菜单
							if (_tmp.children('li').eq(0).children('div')
									.text() == '添加') {
								var _li = $('<li class="level_two_menu"></li>')
										.append(_new);
								_tmp.find('li:eq(0)').remove();
								_tmp.prepend(_li);
								context.checkTwoMenu(_tmp);
							} else {
								_tmp.html(_new);
							}
						}
						context.addMenuEvent(_new);
						_tmp = undefined;
					} else {
						$.alert(ret.msg);
					}
				});
	}
}
context.doDelete = function() {
	var child_len = $('div[data-id=' + $('input[name=id]').val() + ']').next()
			.children().length;
	if (parseInt($('input[name=id]').val())) {
		// if(!$('input[name=pid]').val() && child_len>1){
		if (!parseInt($('input[name=pid]').val())) {
			$('#menu_form_messager').show();
			setTimeout("$('#menu_form_messager').hide()", 2000);
			return;
		}
		$.get('{:U("Weixin/Menu/doDelete")}', {
			id : $('input[name=id]').val()
		}, function(ret) {
			if (ret.status) {
				var _ul = _tmp.parent();
				_tmp.remove();
				if (_ul.children('li').eq(0).children('div').text() != '添加') {
					context.checkTwoMenu(_ul);
				}
				_tmp = undefined;
				$('input').val('');
			} else {
				$.alert(ret.msg);
			}
		});
	}
}
context.checkOneMenu = function() {
	var num = $('.level_one_menu').length;
	var tmp_sort = 2;
	for (var i = 1; i <= 3; i++) {
		if (i <= num) {
			context.checkTwoMenu($('.level_one_menu > ul').eq(i - 1));
		} else {
			if (i == 1) {
				tmp_sort = 3;
			} else if (i == 3) {
				tmp_sort = 1;
			}
			var _new = $(
					'<li class="level_one_menu"><div data-tmp="' + tmp_sort
							+ '">添加</div></li>').appendTo('.wx_menu > ul');
			context.addMenuEvent(_new);
		}
	}
}
context.checkTwoMenu = function(ul) {
	var num = ul.find('li').length;
	if (num < 5) {
		var _new = $('<li class="level_two_menu"><div>添加</div></li>')
				.prependTo(ul);
		context.addMenuEvent(_new);
	}
}
context.addMenuEvent = function() {
	var element = arguments[0] ? arguments[0] : $('li[class^="level"]');
	var _bind_div;
	if (element.children('div').length) {
		_bind_div = element.children('div');
	} else {
		_bind_div = element;
	}
	_bind_div.on('click', function(e) {
		if ($(this).text() == '添加') {
			$('#menu_type_select').combobox('setValue', 'TEXT');
			if (element.hasClass('level_one_menu')) { // 一级菜单
				$('input[name=sort]').val($(this).data('tmp'));
				$('input[name=pid]').val(0);
				_tmp = $(this).data('tmp');
			} else { // 二级菜单
				_tmp = $(this).parent().parent();
				$('input[name=pid]').val(
						$(this).parent().parent().prev().data('id'));
				$('input[name=sort]').val(element.siblings().length + 1);
			}
			$('input[name=id]').val('');
			$('input[name=name]').val('');
		} else {
			_tmp = $(this).parent();
			$('input[name=name]').val($(this).text());
			$('input[name=id]').val($(this).data('id'));
			$('input[name=pid]').val($(this).data('pid'));
			$('input[name=sort]').val($(this).data('sort'));
			$('input[name=url]').val($(this).data('url'));
			if ($(this).data('type') == 'view') {
				$('#menu_type_select').combobox('setValue', 'VIEW');
			} else {
				$('#menu_type_select').combobox('setValue', 'TEXT');
			}
		}
	});
}
context.closeServer = function() {
	$.get('{:U("Weixin/Menu/doDeleteToServer")}', function(ret) {
		$.alert(ret.msg);
	});
}
context.saveServer = function() {
	$.get('{:U("Weixin/Menu/doSaveToServer")}', function(ret) {
		$.alert(ret.msg);
	});
}