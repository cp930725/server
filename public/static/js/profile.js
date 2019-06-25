require(['jquery'], function($){
	var hello = {
		fields: ['nickname', 'wechat', 'qq', 'alipay', 'bankname', 'bankcard', 'bankaddress'],
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
			selector: '.profile input[name="nickname"]',
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
		wechat: {
			selector: '.profile input[name="wechat"]',
			value: '',
			error: '很抱歉、请填写您的微信账号！',
			check: function(){
				var control = hello.wechat;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length > 5) {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		qq: {
			selector: '.profile input[name="qq"]',
			value: '',
			error: '很抱歉、请填写您的qq号码！',
			check: function(){
				var control = hello.qq;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length > 5 && control.value.length < 12) {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		alipay: {
			selector: '.profile input[name="alipay"]',
			value: '',
			error: '很抱歉、请填写您的支付宝账号！',
			check: function(){
				var control = hello.alipay;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length > 5) {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		/*realname: {
			selector: '.profile input[name="realname"]',
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
			selector: '.profile input[name="idcard"]',
			value: '',
			error: '很抱歉、身份证号码不正确！',
			verify: function(code){
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
		},*/
		bankname: {
			selector: '.profile input[name="bankname"]',
			value: '',
			error: '很抱歉、请填写您的开户银行！',
			check: function(){
				var control = hello.bankname;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length >= 2) {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		bankcard: {
			selector: '.profile input[name="bankcard"]',
			value: '',
			error: '很抱歉、请填写您的银行卡号！',
			check: function(){
				var control = hello.bankcard;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length > 6 && !isNaN(control.value)) {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		bankaddress: {
			selector: '.profile input[name="bankaddress"]',
			value: '',
			error: '很抱歉、请填写您的银行地址！',
			check: function(){
				var control = hello.bankaddress;
				control.value = $(control.selector).val();
				if (control.value != '' && control.value.length >= 3) {
					hello.marker(control.selector, true);
					return true;
				} else {
					hello.marker(control.selector, false);
					return false;
				}
			}
		},
		bind: function(){
			for (var i = 0; i < hello.fields.length; i++) {
				var control = hello[hello.fields[i]];
				$(control.selector).on(control.trigger ? control.trigger : 'input', control.check);
			}
			$('.profile button[type=submit]').on('click', hello.submit);
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
			$('.profile .dimmer').addClass('active');
			var param = {
				nickname: hello.nickname.value,
				wechat: hello.wechat.value,
				qq: hello.qq.value,
				alipay: hello.alipay.value,
				bankname: hello.bankname.value,
				bankcard: hello.bankcard.value,
				bankaddress: hello.bankaddress.value,
			}
			ajax(api.account.edit, param, function(res){
				$('.profile .dimmer').removeClass('active');
				if (res.code == 200) {
					toast(res.message);
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