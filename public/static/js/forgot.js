require(['jquery'], function($){
	var hello = {
		basic: {
			fields: ['username', 'captcha', 'verify_code'],
			submit: function(){
				hello.username.check(function(){
					if (!hello.username.result) {
						toast(hello.username.error, hello.username.selector);
					} else {
						hello.captcha.check(function(){
							if (!hello.captcha.result) {
								toast(hello.captcha.error, hello.captcha.selector);
							} else {
								hello.verify_code.check(function(){
									if (!hello.verify_code.result) {
										toast(hello.verify_code.error, hello.verify_code.selector);
									} else {
										$('.forgot .basic').prop('hidden', true);
										$('.forgot .reset').prop('hidden', false);
										$(hello.password.selector).focus();
									}
								});
							}
						});
					}
				});
			}
		},
		reset: {
			fields: ['password', 'confirm'],
			submit: function(){
				hello.password.check(function(){
					if (!hello.password.result) {
						toast(hello.password.error, hello.password.selector);
					} else {
						hello.confirm.check(function(){
							if (!hello.confirm.result) {
								toast(hello.confirm.error, hello.confirm.selector);
							} else {
								hello.post();
							}
						});
					}
				});
			}
		},
		marker: function(selector, bool){
			if (bool) {
				$(selector).removeClass('state-invalid').addClass('state-valid');
			} else {
				$(selector).removeClass('state-valid').addClass('state-invalid');
			}
		},
		username: {
			selector: '.forgot input[name="username"]',
			value: '',					// 文本框的值
			last: '',					// 最后一次正确的值
			result: false,				// 检查的结果
			status: false,				// 是否在检查中
			error: '',					// 当前的错误描述
			check: function(callback){
				var control = hello.username;
				control.value = $(control.selector).val();
				if (control.result && control.value == control.last) {
					typeof(callback) == 'function' && callback && callback();
					return true;
				}
				control.status = true;
				if (control.value != '' && control.value.length == 11 && !isNaN(control.value)) {
					ajax(api.account.check, {mobile: control.value}, function(res){
						if (res.code == 200) {
							if (res.data.exists == false) {
								control.result = false;
								control.error = '很抱歉、该账号不存在！';
								hello.marker(control.selector, false);
							} else {
								control.result = true;
								control.last = control.value;
								hello.marker(control.selector, true);
							}
						} else {
							control.error = res.message;
							control.result = false;
							hello.marker(control.selector, false);
						}
						control.status = false;
						typeof(callback) == 'function' && callback && callback();
					});
				} else {
					control.status = false;
					control.result = false;
					control.error = '很抱歉、请填写您的手机号码！';
					hello.marker(control.selector, false);
					typeof(callback) == 'function' && callback && callback();
				}
			}
		},
		captcha: {
			selector: '.forgot input[name="captcha"]',
			value: '',
			last: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.captcha;
				control.value = $(control.selector).val();
				if ((control.result && control.value == control.last) || $(hello.username.selector).prop('readonly')) {
					typeof(callback) == 'function' && callback && callback();
					return true;
				}
				control.status = true;
				if (control.value != '' && control.value.length == 3 && !isNaN(control.value)) {
					ajax(api.service.captcha, {number: control.value}, function(res){
						if (res.code == 200) {
							control.result = true;
							control.last = control.value;
							hello.marker(control.selector, true);
						} else {
							control.result = false;
							control.error = res.message;
							hello.marker(control.selector, false);
						}
						control.status = false;
						typeof(callback) == 'function' && callback && callback();
					});
				} else {
					control.status = false;
					control.result = false;
					control.error = '很抱歉、请填写数字验证码！';
					hello.marker(control.selector, false);
					typeof(callback) == 'function' && callback && callback();
				}
			},
			refresh: function(){
				$(hello.captcha.selector).val('');
				var src = $('.forgot .captcha').attr('src');
				var _src = src.indexOf('?') == -1 ? src : src.substr(0, src.indexOf('?'));
				$('.forgot .captcha').attr('src', _src + '?' + ~(new Date));
			}
		},
		verify_code: {
			selector: '.forgot input[name="verify_code"]',
			value: '',
			last: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.verify_code;
				control.value = $(control.selector).val();
				if ((control.result && control.value == control.last) || $(hello.username.selector).prop('readonly')) {
					typeof(callback) == 'function' && callback && callback();
					return true;
				}
				control.status = true;
				if (control.value != '' && control.value.length == 6 && !isNaN(control.value)) {
					if (hello.username.result) {
						ajax(api.service.sms_check, {mobile: hello.username.value, verify_code: control.value}, function(res){
							if (res.code == 200) {
								control.result = true;
								control.last = control.value;
								$(hello.captcha.selector).prop('readonly', true);
								$(control.selector).prop('readonly', true);
								$(hello.username.selector).prop('readonly', true);
								hello.marker(control.selector, true);
							} else {
								control.result = false;
								control.error = res.message;
								hello.marker(control.selector, false);
							}
							control.status = false;
							typeof(callback) == 'function' && callback && callback();
						});
					} else {
						control.status = false;
						control.result = false;
						control.error = '';
						hello.marker(control.selector, false);
						typeof(callback) == 'function' && callback && callback();
					}
				} else {
					control.status = false;
					control.result = false;
					control.error = '很抱歉、请填写短信验证码！';
					hello.marker(control.selector, false);
					typeof(callback) == 'function' && callback && callback();
				}
			}
		},
		password: {
			selector: '.forgot input[name="password"]',
			value: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.password;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length >= 6 && control.value.length <= 32) {
					control.result = true;
					hello.marker(control.selector, true);
				} else {
					control.error = '很抱歉、登录密码长度必须在6-32位之间！';
					control.result = false;
					hello.marker(control.selector, false);
				}
				typeof(callback) == 'function' && callback && callback();
			}
		},
		confirm: {
			selector: '.forgot input[name="confirm"]',
			value: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.confirm;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length >= 6 && control.value.length <= 32 && control.value == hello.password.value) {
					control.result = true;
					hello.marker(control.selector, true);
				} else {
					control.error = '很抱歉、确认登录密码必须与登录密码一致！';
					control.result = false;
					hello.marker(control.selector, false);
				}
				typeof(callback) == 'function' && callback && callback();
			}
		},
		sms: {
			timer: null,
			duration: 60,
			time: 0,
			text: '获取短信',
			exec: function(){
				if (hello.captcha.check() !== true) {
					$(hello.captcha.selector).focus();
					return false;
				}
				if (hello.sms.timer || hello.verify_code.result) {
					return false;
				}
				var number = $(hello.captcha.selector).val();
				$('.forgot .btn-send').addClass('btn-loading');
				$('.forgot .btn-send').text('');
				ajax(api.service.sms, {captcha: number, mobile: hello.username.value}, function(res){
					$('.forgot .btn-send').removeClass('btn-loading');
					if (res.code == 200 || res.code == 504) {
						hello.sms.time = parseInt(res.data.refresh_in, 10) || hello.sms.duration;
						$(hello.captcha.selector).prop('readonly', true);
						$('.forgot .btn-send').text(hello.sms.time + 's');
						hello.sms.timer = setInterval(function(){
							hello.sms.time--;
							$('.forgot .btn-send').text(hello.sms.time + 's');
							if (hello.sms.time <= 0) {
								clearInterval(hello.sms.timer);
								hello.sms.timer = null;
								$('.forgot .btn-send').text(hello.sms.text);
								$(hello.captcha.selector).prop('readonly', false);
								if (!$(hello.username.selector).prop('readonly')) hello.captcha.refresh();
							}
						}, 1000);
					} else {
						var selector = '';
						if (res.code == 501) {
							selector = hello.captcha.selector;
						} else if (res.code == 502) {
							selector = hello.username.selector;
						}
						toast(res.message, selector);
						hello.captcha.refresh();
						$('.forgot .btn-send').text(hello.sms.text);
					}
				});
			},
		},
		bind: function(){
			for (var i = 0; i < hello.basic.fields.length; i++) {
				var control = hello[hello.basic.fields[i]];
				$(control.selector).on('input', control.check);
			}
			for (var i = 0; i < hello.reset.fields.length; i++) {
				var control = hello[hello.reset.fields[i]];
				$(control.selector).on('input', control.check);
			}
			$('.forgot button[type=submit]').on('click', hello.submit);
			$('.forgot .captcha-touch').on('click', function(){
				if ($(hello.captcha.selector).prop('readonly')) return false;
				hello.captcha.refresh();
			});
			$('.forgot .btn-send').on('click', hello.sms.exec);
		},
		submit: function(){
			if ($('.forgot .basic').prop('hidden')) {
				hello.reset.submit();
			} else {
				hello.basic.submit();
			}
			return false;
		},
		post: function(skip){
			$('.forgot .dimmer').addClass('active');
			var param = {
				username: hello.username.value,
				verify_code: hello.verify_code.value,
				password: hello.password.value,
				confirm: hello.confirm.value,
			}
			ajax(api.account.forgot, param, function(res){
				$('.forgot .dimmer').removeClass('active');
				if (res.code == 200) {
					toast('恭喜您、密码重置成功！', function(){
						window.location.href = '/signin.html';
					});
				} else {
					toast(res.message);
				}
			});
		}
	};
	$(function(){
		hello.bind();
	});
});
