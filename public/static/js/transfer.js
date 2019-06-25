require(['jquery'], function($){
	// 全局变量
    var page = 1, size = 20, type = 'in';
	// 加载数据
	var getData = function(){
		$('.list-switch input[value=' + type + ']').prop('checked', true);
		var param = {
		    page: page,
		    size: size,
		    type: type,
		}
		ajax(api.transfer.list, param, function(res){
		    if (res.code == 200) {
		        var html = '';
		        for (var i = 0; i < res.data.length; i++) {
		            var item = res.data[i];
		            html += '<tr>';
	                    html += '<td>';
	                        html += '<div style="word-break: normal;">' + (type == 'in' ? item.owner : item.target) + '</div>';
	                        html += '<div class="small text-muted" style="word-break: normal;">' + item.date + '</div>';
	                    html += '</td>';
		                html += '<td class="text-right">' + number_format(item.number) + '</td>';
		                html += '<td class="text-right">' + number_format(item.charge) + '</td>';
		            html += '</tr>';
		        }
		        $('.table tbody').append(html);
		        if (res.data.length == size) {
		            $('.card-footer').prop('hidden', false);
		        } else {
		            $('.card-footer').prop('hidden', true);
		        }
		    } else {
		        toast(res.message);
		    }
		});
	}
	$(function(){
		// 列表切换
        $('.list-switch input[name=option]').on('change', function(){
            page = 1;
            type = $(this).val();
            $('.table tbody').html('');
            getData();
        });
		// 对方账号
		$('input[name=target]').on('input', function(){
			var val = $(this).val();
			if (val != '' && val.length == 11 && !isNaN(val)) {
				$(this).removeClass('state-invalid').addClass('state-valid');
			} else {
				$(this).removeClass('state-valid').addClass('state-invalid');
			}
		});
		// 转账数量
		$('input[name=number]').on('input', function(){
			var val = $(this).val();
			if (val != '' && !isNaN(val) && val > 0) {
				$(this).removeClass('state-invalid').addClass('state-valid');
			} else {
				$(this).removeClass('state-valid').addClass('state-invalid');
			}
			if (typeof(charge) == 'number') {
				$('.charge').text(number_format(val * charge));
			} else {
				var charge_number = charge.percent * val;
				if (charge.min && charge_number < charge.min) {
					charge_number = charge.min;
				}
				if (charge.max && charge_number > charge.max) {
					charge_number = charge.max;
				}
				$('.charge').text(number_format(charge_number));
			}
		});
		// 安全密码
		$('input[name=safeword]').on('input', function(){
			var val = $(this).val();
			if (val != '' && val.length >= 6) {
				$(this).removeClass('state-invalid').addClass('state-valid');
			} else {
				$(this).removeClass('state-valid').addClass('state-invalid');
			}
		});
		// 立即转账
		$('.btn-transfer').on('click', function(){
			if ($(this).hasClass('btn-loading')) {
				return false;
			}
			// 账号
			var target = $('input[name=target]').val();
			if (target == '' || target.length != 11 || isNaN(target)) {
				$('input[name=target]').removeClass('state-valid').addClass('state-invalid').focus();
				return false;
			}
			// 数量
			var number = $('input[name=number]').val();
			if (number == '' || isNaN(number) || number <= 0) {
				$('input[name=number]').removeClass('state-valid').addClass('state-invalid').focus();
				return false;
			}
			// 密码
			var safeword = $('input[name=safeword]').val();
			if (safeword == '' || safeword.length < 6) {
				$('input[name=safeword]').removeClass('state-valid').addClass('state-invalid').focus();
				return false;
			}
			$(this).addClass('btn-loading');
			$btn = $(this);
			// 提交转账
			ajax(api.transfer.post, {target: target, number: number, safeword: safeword}, function(res){
				$btn.removeClass('btn-loading');
				if (res.code == 200) {
					toast(res.message, function(res){
						window.location.reload();
					});
				} else {
					toast(res.message);
				}
			});
		});
		// 查询数据
		getData();
	});
});