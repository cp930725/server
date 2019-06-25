require(['jquery'], function($){
	var page = 1, size = 20, type = '', cid = 1;
	var data = function(){
		var param = {
			page: page,
			size: size,
			cid: cid,
		}
		if (type != '') {
			param.type = type;
		}
		ajax(api.wallet.record, param, function(res){
			if (res.code == 200) {
				$('.total').text(res.data.total);
				$('.unit').text(res.data.unit);
				var html = '';
				if ($('select[name=type] option').length == 1 && res.data.businesses) {
					html = '';
					for (var key in res.data.businesses) {
						if (key == type) {
							html += '<option selected="true" value="' + key + '">' + res.data.businesses[key] + '</option>';
						} else {
							html += '<option value="' + key + '">' + res.data.businesses[key] + '</option>';
						}
					}
					$('select[name=type]').append(html);
				}
				html = '';
				for (var i = 0; i < res.data.list.length; i++) {
					html += '<tr>';
					    /*html += '<td>';
					        html += '<span>' + res.data.list[i].rid + '</span>';
					        html += '<div class="text-muted small">' + res.data.list[i].create_at + '</div>';
					    html += '</td>';*/
					    html += '<td>';
					        html += '<span>' + res.data.businesses[res.data.list[i].business] + '</span>';
					        html += '<div class="text-muted small">' + res.data.list[i].create_at + '</div>';
					    html += '</td>';
					    if (res.data.list[i].now > 0) {
					    	html += '<td class="text-right text-green">+' + number_format(res.data.list[i].now) + '</td>';
					    } else {
					    	html += '<td class="text-right text-red">' + number_format(res.data.list[i].now) + '</td>';
					    }
					html += '</tr>';
				}
				$('.table tbody').append(html);
				if (res.data.list.length == size) {
					$('.card-more').prop('hidden', false);
				} else {
					$('.card-more').prop('hidden', true);
				}
			}
		});
	}
	$(function(){
		// 默认货币
		if (currency) {
			cid = currency;
		}
		// 默认业务
		if (business) {
			type = business;
		}
		// 查询数据
		data();
		// 加载更多
		$('.card-more').on('click', function(res){
			page++;
			data();
		});
		// 切换类型
		$('select[name=type]').on('change', function(){
			type = $(this).val();
			page = 1;
			$('.table tbody').html('');
			data();
		});
	});
});