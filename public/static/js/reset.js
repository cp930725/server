require(['jquery'], function($){
	var hello = {
		fields: ['type', 'captcha', 'verify_code', 'password', 'confirm'],
		marker: function(selector, bool){
			if (bool == true) {
				$(selector).removeClass('state-invalid').addClass('state-valid');
			} else if (bool == false) {
				$(selector).removeClass('state-valid').addClass('state-invalid');
			} else {
				$(selector).removeClass('state-valid').removeClass('state-invalid');
			}
		},
		type: {
			selector: '.reset input[name="type"]',
			trigger: 'change',
			between: [1, 2],
			label: '登录',
			value: '',					// 文本框的值
			last: '',					// 最后一次正确的值
			result: false,				// 检查的结果
			status: false,				// 是否在检查中
			error: '',					// 当前的错误描述
			check: function(){
				var control = hello.type;
				control.value = parseInt(this.value, 10);
				if (control.between.indexOf(control.value) == -1) {
					control.error = '很抱歉、您只能选择修改登录或安全密码！';
					control.result = false;
				} else {
					if (control.value == 1) {
						control.label = '登录';
					} else {
						control.label = '安全';
					}
					$(hello.password.selector).attr('placeholder', '请输入新的' + control.label + '密码');
					$(hello.password.selector).prev().text(control.label + '密码');
					$(hello.confirm.selector).attr('placeholder', '再输入一次' + control.label + '密码');
				}
			}
		},
		password: {
			selector: '.reset input[name="password"]',
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
					control.error = '很抱歉、' + hello.type.label + '密码长度必须在6-32位之间！';
					control.result = false;
					hello.marker(control.selector, false);
				}
				typeof(callback) == 'function' && callback && callback();
			}
		},
		confirm: {
			selector: '.reset input[name="confirm"]',
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
					control.error = '很抱歉、确认密码必须与' + hello.type.label + '密码一致！';
					control.result = false;
					hello.marker(control.selector, false);
				}
				typeof(callback) == 'function' && callback && callback();
			}
		},
		captcha: {
			selector: '.reset input[name="captcha"]',
			value: '',
			last: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.captcha;
				control.value = $(control.selector).val();
				if (control.result && control.value == control.last) {
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
				var src = $('.reset .captcha').attr('src');
				var _src = src.indexOf('?') == -1 ? src : src.substr(0, src.indexOf('?'));
				$('.reset .captcha').attr('src', _src + '?' + ~(new Date));
			}
		},
		verify_code: {
			selector: '.reset input[name="verify_code"]',
			value: '',
			last: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.verify_code;
				control.value = $(control.selector).val();
				if (control.result && control.value == control.last) {
					typeof(callback) == 'function' && callback && callback();
					return true;
				}
				control.status = true;
				if (control.value != '' && control.value.length == 6 && !isNaN(control.value)) {
					ajax(api.service.sms_check, {verify_code: control.value}, function(res){
						if (res.code == 200) {
							control.result = true;
							control.last = control.value;
							$(hello.captcha.selector).prop('readonly', true);
							$(control.selector).prop('readonly', true);
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
					control.error = '很抱歉、请填写短信验证码！';
					hello.marker(control.selector, false);
					typeof(callback) == 'function' && callback && callback();
				}
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
				$('.reset .btn-send').addClass('btn-loading');
				$('.reset .btn-send').text('');
				ajax(api.service.sms, {captcha: number}, function(res){
					$('.reset .btn-send').removeClass('btn-loading');
					if (res.code == 200 || res.code == 504) {
						hello.sms.time = parseInt(res.data.refresh_in, 10) || hello.sms.duration;
						$(hello.captcha.selector).prop('readonly', true);
						$('.reset .btn-send').text(hello.sms.time + 's');
						hello.sms.timer = setInterval(function(){
							hello.sms.time--;
							$('.reset .btn-send').text(hello.sms.time + 's');
							if (hello.sms.time <= 0) {
								clearInterval(hello.sms.timer);
								hello.sms.timer = null;
								$('.reset .btn-send').text(hello.sms.text);
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
						$('.reset .btn-send').text(hello.sms.text);
					}
				});
			},
		},
		bind: function(){
			for (var i = 0; i < hello.fields.length; i++) {
				var control = hello[hello.fields[i]];
				$(control.selector).on(control.trigger ? control.trigger : 'input', control.check);
			}
			$('.reset button[type=submit]').on('click', hello.submit);
			$('.reset .captcha-touch').on('click', function(){
				if ($(hello.captcha.selector).prop('readonly')) return false;
				hello.captcha.refresh();
			});
			$('.reset .btn-send').on('click', hello.sms.exec);
		},
		submit: function(){
			hello.password.check(function(){
				if (!hello.password.result) {
					toast(hello.password.error, hello.password.selector);
				} else {
					hello.confirm.check(function(){
						if (!hello.confirm.result) {
							toast(hello.confirm.error, hello.confirm.selector);
						} else {
							hello.captcha.check(function(){
								if (!hello.captcha.result) {
									toast(hello.captcha.error, hello.captcha.selector);
								} else {
									hello.verify_code.check(function(){
										if (!hello.verify_code.result) {
											toast(hello.verify_code.error, hello.verify_code.selector);
										} else {
											hello.post();
										}
									});
								}
							});
						}
					});
				}
			});
			return false;
		},
		post: function(skip){
			$('.reset .dimmer').addClass('active');
			var param = {
				type: hello.type.value,
				verify_code: hello.verify_code.value,
				password: hello.password.value,
				confirm: hello.confirm.value,
			}
			ajax(api.account.reset, param, function(res){
				$('.reset .dimmer').removeClass('active');
				if (res.code == 200) {
					if (hello.type.value == 1) {
						toast('恭喜您、密码重置成功！', function(){
							window.location.href = '/signin.html';
						});
					} else {
						toast('恭喜您、密码重置成功！', function(){
							$(hello.password.selector).val('');
							hello.marker(hello.password.selector, null);
							$(hello.confirm.selector).val('');
							hello.marker(hello.confirm.selector, null);
							$(hello.captcha.selector).val('');
							$(hello.captcha.selector).prop('readonly', false);
							hello.marker(hello.captcha.selector, null);
							$(hello.verify_code.selector).val('');
							$(hello.verify_code.selector).prop('readonly', false);
							hello.marker(hello.verify_code.selector, null);
						});
					}
				} else {
					toast(res.message);
				}
			});
		}
	};
	$(function(){
		hello.bind();
		$(hello.type.selector)[0].click();
	});
});
