require(['jquery'], function($){
	var hello = {
		basic: {
			fields: ['username', 'captcha', 'verify_code', 'inviter', 'policy'],
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
										hello.inviter.check(function(){
											if (!hello.inviter.result) {
												toast(hello.inviter.error, hello.inviter.selector);
											} else {
												hello.policy.check(function(){
													if (!hello.policy.result) {
														toast(hello.policy.error, hello.policy.selector);
													} else {
														$('.signup .basic').prop('hidden', true);
														$('.signup .pwd').prop('hidden', false);
														$(hello.password.selector).focus();
													}
												});
											}
										});
									}
								});
							}
						});
					}
				});
			}
		},
		pwd: {
			fields: ['password', 'confirm', 'safeword', 'safewordConfirm'],
			submit: function(){
				hello.password.check(function(){
					if (!hello.password.result) {
						toast(hello.password.error, hello.password.selector);
					} else {
						hello.confirm.check(function(){
							if (!hello.confirm.result) {
								toast(hello.confirm.error, hello.confirm.selector);
							} else {
								hello.safeword.check(function(){
									if (!hello.safeword.result) {
										toast(hello.safeword.error, hello.safeword.selector);
									} else {
										hello.safewordConfirm.check(function(){
											if (!hello.safewordConfirm.result) {
												toast(hello.safewordConfirm.error, hello.safewordConfirm.selector);
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
			selector: '.signup input[name="username"]',
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
								control.result = true;
								control.last = control.value;
								hello.marker(control.selector, true);
							} else {
								control.result = false;
								control.error = '很抱歉、该账号已被注册！';
								hello.marker(control.selector, false);
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
			selector: '.signup input[name="captcha"]',
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
				var src = $('.signup .captcha').attr('src');
				var _src = src.indexOf('?') == -1 ? src : src.substr(0, src.indexOf('?'));
				$('.signup .captcha').attr('src', _src + '?' + ~(new Date));
			}
		},
		verify_code: {
			selector: '.signup input[name="verify_code"]',
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
								if (typeof(callback) != 'function') {
									hello.inviter.check(function(){
										if (!hello.inviter.result) {
											$(hello.inviter.selector).focus();
										}
									});
								}
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
		inviter: {
			selector: '.signup input[name="inviter"]',
			value: '',
			last: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.inviter;
				control.value = $(control.selector).val();
				if (control.result && control.value == control.last) {
					typeof(callback) == 'function' && callback && callback();
					return true;
				}
				if (typeof(invite) != 'undefined' && !invite.enable) {
					control.result = true;
					typeof(callback) == 'function' && callback && callback();
					return true;
				}
				control.status = true;
				if (
					(control.value != '' && control.value.length == 11 && !isNaN(control.value) && control.value != hello.username.value)
					||
					(control.value != '' && typeof(invite) != 'undefined' && invite.anonymous)
				) {
					ajax(api.account.check, {mobile: control.value}, function(res){
						if (res.code == 200) {
							if (res.data.exists == false) {
								control.result = false;
								control.error = '很抱歉、该邀请码不存在！';
								hello.marker(control.selector, false);
							} else {
								control.result = true;
								control.last = control.value;
								hello.marker(control.selector, true);
							}
						} else {
							control.error = '很抱歉、错误的邀请码！';
							control.result = false;
							hello.marker(control.selector, false);
						}
						control.status = false;
						typeof(callback) == 'function' && callback && callback();
					});
				} else {
					control.status = false;
					control.result = false;
					control.error = '很抱歉、请填写正确的邀请码！';
					hello.marker(control.selector, false);
					typeof(callback) == 'function' && callback && callback();
				}
			}
		},
		policy: {
			selector: '.signup input[name="policy"]',
			value: '',
			last: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.policy;
				if (!$(control.selector).length || ($(control.selector).length && $(control.selector).prop('checked'))) {
					control.result = true;
					typeof(callback) == 'function' && callback && callback();
					return true;
				} else {
					control.status = false;
					control.result = false;
					control.error = '很抱歉、您必须同意服务条款才能继续！';
					hello.marker(control.selector, false);
					typeof(callback) == 'function' && callback && callback();
				}
			}
		},
		password: {
			selector: '.signup input[name="password"]',
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
			selector: '.signup input[name="confirm"]',
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
		safeword: {
			selector: '.signup input[name="safeword"]',
			value: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.safeword;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length >= 6 && control.value.length <= 32) {
					control.result = true;
					hello.marker(control.selector, true);
				} else {
					control.error = '很抱歉、安全密码长度必须在6-32位之间！';
					control.result = false;
					hello.marker(control.selector, false);
				}
				typeof(callback) == 'function' && callback && callback();
			}
		},
		safewordConfirm: {
			selector: '.signup input[name="safewordConfirm"]',
			value: '',
			result: false,
			status: false,
			error: '',
			check: function(callback){
				var control = hello.safewordConfirm;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length >= 6 && control.value.length <= 32 && control.value == hello.safeword.value) {
					control.result = true;
					hello.marker(control.selector, true);
				} else {
					control.error = '很抱歉、确认安全密码必须与安全密码一致！';
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
				$('.signup .btn-send').addClass('btn-loading');
				$('.signup .btn-send').text('');
				ajax(api.service.sms, {captcha: number, mobile: hello.username.value, action: 'signup'}, function(res){
					$('.signup .btn-send').removeClass('btn-loading');
					if (res.code == 200 || res.code == 504) {
						hello.sms.time = parseInt(res.data.refresh_in, 10) || hello.sms.duration;
						$(hello.captcha.selector).prop('readonly', true);
						$('.signup .btn-send').text(hello.sms.time + 's');
						hello.sms.timer = setInterval(function(){
							hello.sms.time--;
							$('.signup .btn-send').text(hello.sms.time + 's');
							if (hello.sms.time <= 0) {
								clearInterval(hello.sms.timer);
								hello.sms.timer = null;
								$('.signup .btn-send').text(hello.sms.text);
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
						$('.signup .btn-send').text(hello.sms.text);
					}
				});
			},
		},
		bind: function(){
			for (var i = 0; i < hello.basic.fields.length; i++) {
				var control = hello[hello.basic.fields[i]];
				$(control.selector).on('input', control.check);
			}
			for (var i = 0; i < hello.pwd.fields.length; i++) {
				var control = hello[hello.pwd.fields[i]];
				$(control.selector).on('input', control.check);
			}
			$('.signup button[type=submit]').on('click', hello.submit);
			$('.signup .captcha-touch').on('click', function(){
				if ($(hello.captcha.selector).prop('readonly')) return false;
				hello.captcha.refresh();
			});
			$('.signup .btn-send').on('click', hello.sms.exec);
			$('.signup .btn-skip').on('click', function(){
				hello.post(true);
			});
		},
		submit: function(){
			if ($('.signup .basic').prop('hidden')) {
				hello.pwd.submit();
			} else {
				hello.basic.submit();
			}
			return false;
		},
		post: function(skip){
			$('.signup .dimmer').addClass('active');
			var param = {
				username: hello.username.value,
				verify_code: hello.verify_code.value,
				inviter: hello.inviter.value,
				password: skip ? '123456' : hello.password.value,
				safeword: skip ? '123456' : hello.safeword.value,
			}
			if (o) {
				param.o = o;
			}
			ajax(api.account.signup, param, function(res){
				$('.signup .dimmer').removeClass('active');
				if (res.code == 200) {
					localStorage.hello_account = JSON.stringify(res.data);
					if (skip) {
						$('.signup .pwd').prop('hidden', true);
						$('.signup .success').prop('hidden', false);
						var second = 6;
						$('.signup .success span.s').text(second);
						setInterval(function(){
							second--;
							$('.signup .success span.s').text(second);
							if (second < 1) {
								if (typeof(reg_auto_down) != 'undefined' && reg_auto_down && typeof(isApp) != 'undefined' && !isApp && typeof(appurl) != 'undefined' && appurl) {
									window.location.href = appurl;
								} else {
									window.location.href = api.account.home;
								}
							}
						}, 1000);
					} else {
						if (typeof(reg_auto_down) != 'undefined' && reg_auto_down && typeof(isApp) != 'undefined' && !isApp && typeof(appurl) != 'undefined' && appurl) {
							window.location.href = appurl;
						} else {
							window.location.href = api.account.home;
						}
					}
				} else {
					toast(res.message);
				}
			});
		}
	};
	$(function(){
		// 第三方登录
		var oauthTimer, oauthTime = 6, oauthClock = function(){
			$('.oauth-time').text(oauthTime);
			oauthTimer = setInterval(function(){
				oauthTime--;
				if (oauthTime <= 0) {
					clearInterval(oauthTimer);
					oauthTimer = null;
					$('.oauth').fadeOut(500);
					$('.quick').fadeIn(500);
				} else {
					$('.oauth-time').text(oauthTime);
				}
			}, 1000);
		};
		if (!o) {
			var ua = navigator.userAgent.toLowerCase();
			if (ua.indexOf('micromessenger') != -1) {
				$('.oauth-wechat').prop('hidden', false);
				$('.quick-wechat').prop('hidden', false);
				oauthClock();
			} else if (ua.indexOf('qq') != -1) {
				$('.oauth-qq').prop('hidden', false);
				$('.quick-qq').prop('hidden', false);
				oauthClock();
			}
			$('.oauth-close').on('click', function(){
				$(this).parents('.oauth').fadeOut(500);
				$('.quick').fadeIn(500);
			});
		}
		// 注册完成去下载页面
		if (typeof(reg_auto_down) != 'undefined' && reg_auto_down && typeof(isApp) != 'undefined' && !isApp && typeof(appurl) != 'undefined' && appurl) {
			$('.signup .success a').attr('href', appurl);
		}
		// 事件绑定
		hello.bind();
	});
});
