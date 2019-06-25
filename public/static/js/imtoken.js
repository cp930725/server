var type = 'recharge', page = 1, size = 20;
var compute = function(currency){
	currency = currency || 1;
	if (charge <= 0) {
		return 0;
	} else if (charge >= 1) {
		return charge;
	} else {
		return charge * currency;
	}
}
var getData = function(){
	var param = {
		page: page,
		size: size,
		type: type,
	}
	ajax(api.imtoken.list, param, function(res){
		if (res.code != 200) {
			toast(res.message);
		} else {
			var html = '';
			for (var i = 0; i < res.data.length; i++) {
				html += '<tr>';
					html += '<td>';
					    html += '<div>' + res.data[i].number + ' ' + unit + '</div>';
					    html += '<div class="small text-muted">' + res.data[i].date + '</div>';
					html += '</td>';
					html += '<td class="text-right">';
						if (res.data[i].status == 1) {
					    	html += '<span class="status-icon bg-success"></span> 成功';
						} else if (res.data[i].status == 2) {
							html += '<span class="status-icon bg-warning"></span> 审核中';
						} else if (res.data[i].status == 0) {
							html += '<span class="status-icon bg-red"></span> 失败';
						}
					html += '</td>';
				html += '</tr>';
			}
			$('.table tbody').append(html);
			if (res.data.length == size) {
				$('.card-more').prop('hidden', false);
				page++;
			} else {
				$('.card-more').prop('hidden', true);
			}
		}
	});
}
require(['jquery'], function($){
	$(function(){
		// 查询数据
		getData();
		// 切换栏目
		$('.card-form .card-options button').on('click', function(){
			if ($(this).hasClass('btn-primary')) {
				return false;
			}
			$('.card-form .card-options button.btn-primary').removeClass('btn-primary').addClass('btn-secondary');
			$(this).removeClass('btn-secondary').addClass('btn-primary');
			type = $(this).data('type');
			$('.card-form .dimmer-content').prop('hidden', true);
			$('.card-form .' + type).prop('hidden', false);
			if (type == 'recharge') {
				$('.card-form .form-title').text('在线充值');
				$('.table-title').text('充值记录');
			} else {
				$('.card-form .form-title').text('申请提现');
				$('.table-title').text('提现记录');
			}
			$('.table tbody').empty();
			page = 1;
			getData();
		});
		// 手续费计算
		$('.withdraw input[name=number]').on('input', function(){
			var number = $(this).val();
			$('.charge').text(compute(number) + unit);
		});
		// 提交申请
		$('.card-form .btn-post').on('click', function(){
			if ($(this).hasClass('btn-loading')) {
				return false;
			}
			var param = {
				type: type
			}
			if (type == 'recharge') {
				// 货币数量
				var number = $('.recharge input[name=number]').val();
				if (number == '' || isNaN(number) || number <= 0) {
					$('.recharge input[name=number]').addClass('state-invalid').focus();
					return false;
				}
				$('.recharge input[name=number]').removeClass('state-invalid');
				param.number = number;
				// 支付凭证
				var certificate = $('.recharge input[name=certificate]').val();
				if (certificate == '' || $('.recharge input[name=certificate]')[0].files.length == 0) {
					toast('很抱歉、请上传截图凭证！');
					return false;
				}
				param.certificate = $('.recharge input[name=certificate]')[0].files[0];
				// 安全密码
				var safeword = $('.recharge input[name=safeword]').val();
				if (safeword == '' || safeword.length < 6) {
					$('.recharge input[name=safeword]').addClass('state-invalid').focus();
					return false;
				}
				$('.recharge input[name=safeword]').removeClass('state-invalid');
				param.safeword = $('.recharge input[name=safeword]').val();
			} else {
				// 钱包地址
				var imtoken_code = $('.withdraw input[name=imtoken_code]').val();
				if (imtoken_code == '' || imtoken_code.length < 6) {
					$('.withdraw input[name=imtoken_code]').addClass('state-invalid').focus();
					return false;
				}
				$('.withdraw input[name=imtoken_code]').removeClass('state-invalid');
				param.imtoken_code = $('.withdraw input[name=imtoken_code]').val();
				// 钱包二维码
				if ($('.withdraw input[name=imtoken_qrcode]')[0].files.length) {
					param.imtoken_qrcode = $('.withdraw input[name=imtoken_qrcode]')[0].files[0];
				}
				// 货币数量
				var number = $('.withdraw input[name=number]').val();
				if (number == '' || isNaN(number) || number <= 0) {
					$('.withdraw input[name=number]').addClass('state-invalid').focus();
					return false;
				}
				$('.withdraw input[name=number]').removeClass('state-invalid');
				param.number = $('.withdraw input[name=number]').val();
				// 安全密码
				var safeword = $('.withdraw input[name=safeword]').val();
				if (safeword == '' || safeword.length < 6) {
					$('.withdraw input[name=safeword]').addClass('state-invalid').focus();
					return false;
				}
				$('.withdraw input[name=safeword]').removeClass('state-invalid');
				param.safeword = $('.withdraw input[name=safeword]').val();
			}
			$(this).addClass('btn-loading');
			$btn = $(this);
			ajax(api.imtoken.post, param, function(res){
				$btn.removeClass('btn-loading');
				if (res.code == 200) {
					toast(res.message, function(){
						window.location.reload();
					});
				} else {
					toast(res.message);
				}
			}, 'file');
		});
	});
});