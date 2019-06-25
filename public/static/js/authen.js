require(['jquery'], function($){
	var hello = {
		fields: ['nickname', /*'avatar', */'realname', 'idcard', 'front', 'back', 'hold'],
		marker: function(selector, bool){
			if (bool == true) {
				$(selector).removeClass('state-invalid').addClass('state-valid');
			} else if (bool == false) {
				$(selector).removeClass('state-valid').addClass('state-invalid');
			} else {
				$(selector).removeClass('state-valid').removeClass('state-invalid');
			}
		},
		nickname: {
			selector: '.authen input[name="nickname"]',
			value: '',
			error: '很抱歉、请填写您的个性昵称！',
			check: function(){
				var control = hello.nickname;
				control.value = $(control.selector).val();
				if (control.value != '') {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		avatar: {
			selector: '.authen input[name="avatar"]',
			value: '',
			trigger: 'change',
			error: '很抱歉、请选择您的头像！',
			check: function(){
				var control = hello.avatar;
				if ($(control.selector)[0].files.length) {
					control.value = $(control.selector)[0].files[0];
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		realname: {
			selector: '.authen input[name="realname"]',
			value: '',
			error: '很抱歉、请填写您的真实姓名！',
			check: function(){
				var control = hello.realname;
				control.value = $(control.selector).val();
				if (control.value != '' && /^[\u4E00-\u9FA5]{2,4}$/.test(control.value)) {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		idcard: {
			selector: '.authen input[name="idcard"]',
			value: '',
			error: '很抱歉、身份证号码不正确！',
			verify: function(code){
				code = code.toUpperCase();
				// 港台身份证
				if (code != '' && (code.length == 10 || code.length == 8)) {
					return true;
				}
				var city = {11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"};
				var tip = "";
				var pass = true;
				if (!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[012])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)) {
					tip = "身份证号格式错误";
					pass = false;
				} else if (!city[code.substr(0,2)]) {
					tip = "地址编码错误";
					pass = false;
				} else {
					if (code.length == 18) {
						code = code.split('');
						var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
						var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
						var sum = 0;
						var ai = 0;
						var wi = 0;
						for (var i = 0; i < 17; i++) {
							ai = code[i];
							wi = factor[i];
							sum += ai * wi;
						}
						var last = parity[sum % 11];
						if (parity[sum % 11] != code[17]) {
							tip = "校验位错误";
							pass = false;
						}
					}
				}
				return pass;
			},
			check: function(){
				var control = hello.idcard;
				control.value = $(control.selector).val();
				if (control.value != '' && control.verify(control.value)) {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		front: {
			selector: '.authen input[name="front"]',
			value: '',
			trigger: 'change',
			error: '很抱歉、请选择身份证正面图片！',
			check: function(){
				var control = hello.front;
				if ($(control.selector).length) {
					if ($(control.selector)[0].files.length) {
						control.value = $(control.selector)[0].files[0];
						hello.marker(control.selector, true);
						return true;
					} else {
						hello.marker(control.selector, false);
						return false;
					}
				} else {
					hello.marker(control.selector, true);
					return true;
				}
			}
		},
		back: {
			selector: '.authen input[name="back"]',
			value: '',
			trigger: 'change',
			error: '很抱歉、请选择身份证反面图片！',
			check: function(){
				var control = hello.back;
				if ($(control.selector).length) {
					if ($(control.selector)[0].files.length) {
						control.value = $(control.selector)[0].files[0];
						hello.marker(control.selector, true);
						return true;
					} else {
						hello.marker(control.selector, false);
						return false;
					}
				} else {
					hello.marker(control.selector, true);
					return true;
				}
			}
		},
		hold: {
			selector: '.authen input[name="hold"]',
			value: '',
			trigger: 'change',
			error: '很抱歉、请选择手持身份证图片！',
			check: function(){
				var control = hello.hold;
				if ($(control.selector).length) {
					if ($(control.selector)[0].files.length) {
						control.value = $(control.selector)[0].files[0];
						hello.marker(control.selector, true);
						return true;
					} else {
						hello.marker(control.selector, false);
						return false;
					}
				} else {
					hello.marker(control.selector, true);
					return true;
				}
			}
		},
		bind: function(){
			for (var i = 0; i < hello.fields.length; i++) {
				var control = hello[hello.fields[i]];
				$(control.selector).on(control.trigger ? control.trigger : 'input', control.check);
			}
			$('.authen button').on('click', hello.submit);
		},
		submit: function(){
			for (var i = 0; i < hello.fields.length; i++) {
				var control = hello[hello.fields[i]];
				if (!control.check()) {
					toast(control.error, control.selector);
					return false;
				}
			}
			hello.post();
			return false;
		},
		post: function(){
			$('.authen .dimmer').addClass('active');
			var param = {
				nickname: hello.nickname.value,
				// avatar: hello.avatar.value,
				realname: hello.realname.value,
				idcard: hello.idcard.value,
				front: hello.front.value,
				back: hello.back.value,
				hold: hello.hold.value,
			}
			ajax(api.account.authen, param, function(res){
				$('.authen .dimmer').removeClass('active');
				if (res.code == 200) {
					window.location.reload();
				} else {
					toast(res.message);
				}
			}, 'file');
		}
	};
	$(function(){
		hello.bind();
	});
});