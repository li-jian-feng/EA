
context.ready = function(){
	$('form td:even').attr('style','text-align:right');
	$('#wx_api_save_btn').click(function(){
		context.doSubmit()
	});
}
context.doSubmit = function(){
	$api_form = $('#weixin_api_form');
	if($api_form.form('validate')){
		$.post("{:U('Weixin/Api/doUpdate')}",$api_form.toJson(),function(ret){
			if(ret.status){
				
			}else{
				
			}
		});
	}
}