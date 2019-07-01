require(['jquery'], function($){
	var hello = {
		fields: ['username', 'password'],
		marker: function(selector, bool){
			if (bool) {
				$(selector).removeClass('state-invalid').addClass('state-valid');
			} else {
				$(selector).removeClass('state-valid').addClass('state-invalid');
			}
		},
		validate: function(option){
			var val = $(option.selector).val();
			var cfmVal = option.target ? $(option.target).val() : '';
			var bool = option.check(val, cfmVal);
			if (bool && option.next && !option.prevent) {
				bool = option.next(true);
			}
			hello.marker(option.selector, bool);
			return bool ? bool : option.selector;
		},
		username: {
			selector: '.signin input[name="username"]',
			value: '',
			check: function(){
				return hello.validate({
					selector: hello.username.selector,
					check: function(val){
						hello.username.value = val;
						return val != '' && val.length == 11 && !isNaN(val);
					}
				});
			}
		},
		password: {
			selector: '.signin input[name="password"]',
			value: '',
			check: function(prevent){
				return hello.validate({
					selector: hello.password.selector,
					check: function(val){
						hello.password.value = val;
						return val != '' && val.length >= 6;
					},
				});
			}
		},
		bind: function(){
			for (var i = 0; i < hello.fields.length; i++) {
				var field = hello[hello.fields[i]];
				$(field.selector).on('input', field.check);
			}
			$('.signin button[type=submit]').on('click', hello.submit);
		},
		submit: function(){
			for (var i = 0; i < hello.fields.length; i++) {
				var result = hello[hello.fields[i]].check();
				if (result !== true) {
					$(result).focus();
					return false;
				}
			}
			$('.signin button[type=submit]').addClass('btn-loading');
			ajax(api.account.signin, {username: hello.username.value, password: hello.password.value}, function(res){
				$('.signin button[type=submit]').removeClass('btn-loading');
				if (res.code != 200) {
					toast(res.message);
				} else {
					localStorage.hello_account = JSON.stringify(res.data);
					var from = param('from');
					window.location.href = from ? from : '/api';
				}
			});
			return false;
		}
	};
	$(function(){
		var ua = navigator.userAgent.toLowerCase();
		if (ua.indexOf('micromessenger') != -1) {
			$('.btn-wechat').prop('hidden', false);
		} else if (ua.indexOf('qq') != -1) {
			$('.btn-qq').prop('hidden', false);
		}
		hello.bind();
	});
});