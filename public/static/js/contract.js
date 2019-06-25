require(['jquery'], function($){
	// 全局变量
	var page = 1, size = 20, filter = 'all', catalog = '';
	// 商店数据
	var store = function(){
		var param = {
			page: page,
			size: size,
			filter: filter,
			catalog: catalog,
		}
		ajax(api.contract.list, param, function(res){
			if (res.code == 200) {
				var html = '';
				for (var i = 0; i < res.data.length; i++) {
					var item = res.data[i]
					html += '<div class="col-md-6 col-lg-4">';
						html += '<div class="card p-3">';
							html += '<a href="/contract/' + item.id + '.html" class="mb-3 text-center image align-middle">';
								html += '<img src="/upload/' + item.image + '" class="rounded" />';
							html += '</a>';
							html += '<div class="d-flex align-items-center px-2">';
								html += '<div class="avatar avatar-md mr-3" style="background-image: url(' + (item.avatar ? item.avatar : '/static/image/icon.png') + ')"></div>';
								html += '<div>';
									html += '<div>' + item.title + '</div>';
									if (item.loop <= 1) {
										html += '<small class="d-block text-muted">新品上市</small>';
									} else {
										html += '<small class="d-block text-muted">当前第 ' + (item.loop) + ' 轮</small>';
									}
								html += '</div>';
								html += '<div class="ml-auto text-muted">';
									html += '<a href="/contract/' + item.id + '.html" class="icon"><i class="fe fe-shopping-cart mr-1"></i> ' + number_format(item.now_price) + unit + '</a>';
								html += '</div>';
							html += '</div>';
						html += '</div>';
					html += '</div>';
				}
				$('.goods').append(html);
			} else {
				toast(res.message);
			}
		});
	}
	// 更新价格
	var price = function(ratio){
		var money = 0, surplus = 100 - percent;
		if (surplus >= ratio) {
			money = number_format(ratio / 100 * now_price);
		} else {
			for (var i = 0; i < holder.length; i++) {
				if (holder[i].owner == 'me') {
					ratio -= holder[i].ratio;
					continue;
				}
				if (holder[i].loop < loop) {
					if (ratio > holder[i].ratio) {
						money += holder[i].ratio / 100 * now_price;
						ratio -= holder[i].ratio;
					} else {
						money += (ratio) / 100 * now_price;
						break;
					}
				} else {
					if (ratio > holder[i].ratio) {
						money += holder[i].ratio / 100 * next_price;
						ratio -= holder[i].ratio;
					} else {
						money += (ratio) / 100 * next_price;
						break;
					}
				}
			}
		}
		$('.need_price').text(number_format(money));
	}
	$(function(){
		// 商品列表
		if (frame == 'store') {
			// 商店数据
			store();
			// 筛选数据
			$('.filter .btn').on('click', function(){
				$('.filter .btn-primary').removeClass('btn-primary').addClass('btn-secondary');
				$(this).removeClass('btn-secondary').addClass('btn-primary');
				filter = $(this).data('option');
				page = 1;
				$('.goods').empty();
				store();
			});
			// 分类数据
			$('.catalog').on('change', function(){
				catalog = $(this).val();
				page = 1;
				$('.goods').empty();
				store();
			});
		}
		// 商品详情
		if (frame == 'goods') {
			// 团购比例
			$('.btn-jiajian').on('click', function(){
				var value = $(this).data('value');
				var current = $('input[name=percent]').val();
				if (!current || current == '' || isNaN(current) || current.indexOf('.') != -1) {
					current = 1;
				} else {
					current = parseInt(current, 10);
				}
				current += value;
				if (current < 1) {
					current = 1;
				} else if (current > 100) {
					current = 100;
				}
				price(current);
				$('input[name=percent]').val(current);
			});
			$('input[name=percent]').on('input', function(){
				var current = $(this).val();
				if (!current || current == '' || isNaN(current) || current.indexOf('.') != -1) {
					current = 1;
				} else {
					current = parseInt(current, 10);
				}
				if (current < 1) {
					current = 1;
				} else if (current > 100) {
					current = 100;
				}
				price(current);
				$('input[name=percent]').val(current);
			});
			// 点击一口价
			$('.btn-go-purchase').on('click', function(){
				$('input[name=percent]').val(100);
				price(100);
				$('#modal-purchase').modal();
			});
			// 立即购买
			$('.btn-buy').on('click', function(){
				if ($(this).hasClass('btn-loading')) {
					return false;
				}
				var ratio = $(this).data('percent');
				if (!ratio || ratio == '') {
					ratio = $('input[name=percent]').val();
					if (ratio == '0') {
						$('input[name=percent]').focus();
						return false;
					}
					if (!ratio || ratio == '' || isNaN(ratio) || ratio.indexOf('.') != -1) {
						ratio = 1;
					} else {
						ratio = parseInt(ratio, 10);
					}
					if (ratio < 1) {
						ratio = 1;
					} else if (ratio > 100) {
						ratio = 100;
					}
				}
				var safeword = '';
				if ($(this).data('percent') == '100') {
					safeword = $('#modal-purchase input[name=safeword]').val();
					if (safeword == '') {
						$('#modal-purchase input[name=safeword]').focus();
						return false;
					}
				} else {
					safeword = $('#modal-group input[name=safeword]').val();
					if (safeword == '') {
						$('#modal-group input[name=safeword]').focus();
						return false;
					}
				}
				$('.btn-buy').addClass('btn-loading');
				ajax(api.contract.buy, {id: id, ratio: ratio, safeword: safeword}, function(res){
					$('.btn-buy').removeClass('btn-loading');
					if (res.code == 200) {
						toast(res.message, function(){
							window.location.reload();
						});
					} else {
						toast(res.message);
					}
				});
			});
			// 点击转让
			$('.btn-go-transfer').on('click', function(){
				var money = 0;
				for (var i = 0; i < holder.length; i++) {
					if (holder[i].loop < loop) {
						money += holder[i].ratio / 100 * now_price * charge;
					} else {
						money += holder[i].ratio / 100 * next_price * charge;
					}
				}
				$('.need_charge').text(number_format(money));
				$('#modal-transfer').modal();
			});
			// 立即转让
			$('.btn-transfer').on('click', function(){
				if ($(this).hasClass('btn-loading')) {
					return false;
				}
				// 获取账号
				var mobile = $('#modal-transfer input[name=mobile]').val();
				if (mobile == '' || mobile.length != 11) {
					$('#modal-transfer input[name=mobile]').focus();
					return false;
				}
				// 获取密码
				var safeword = $('#modal-transfer input[name=safeword]').val();
				if (safeword == '') {
					$('#modal-transfer input[name=safeword]').focus();
					return false;
				}
				$('.btn-transfer').addClass('btn-loading');
				ajax(api.contract.transfer, {id: id, mobile: mobile, safeword: safeword}, function(res){
					$('.btn-transfer').removeClass('btn-loading');
					if (res.code == 200) {
						toast(res.message, function(){
							window.location.reload();
						});
					} else {
						toast(res.message);
					}
				});
			});
		}
	});
});