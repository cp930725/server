require(['core', 'jquery'], function(core, $){
	// 全局参数
	var page = 1, size = 20, catalog = 1, dataset = [];
	// 查询商品
	var products = function(){
		// 切换栏目
		$('.btn-list .btn-primary').removeClass('btn-primary').addClass('btn-secondary');
		$('.btn-list .btn[data-catalog=' + catalog + ']').removeClass('btn-secondary').addClass('btn-primary');
		// 参数整理
		var param = {
			page: page,
			size: size,
			catalog: catalog,
		}
		// 读取数据
		ajax(api.store.list, param, function(res){
			if (res.code == 200) {
				var html = '';
				for (var i = 0;i < res.data.length;i++) {
					var item = res.data[i];
					dataset[item.id] = item;
					html += '<div class="col-sm-12 col-md-6 col-lg-4">';
					    html += '<div class="card card-aside">';
					        html += '<div class="card-aside-column">';
					            html += '<a style="background-image: url(/store/' + item.image + ');"></a>';
					        html += '</div>';
					        html += '<div class="card-body">';
					            html += '<h4 class="card-title" style="font-size: 1rem;"><a href="javascript:void(0)">' + item.title + '</a></h4>';
					            if (item.catalog == 1) {
						            html += '<div class="card-subtitle">产量：' + number_format(item.income / item.cycle) + '/HM</div>';
						            // html += '<div class="card-subtitle">周期：' + item.cycle + ' 小时</div>';
						            if (item.power > 0) {
						            	html += '<div class="card-subtitle">算力：' + number_format(item.power) + ' Ghs</div>';
						            }
					            } else if (item.catalog == 2) {
									html += '<div class="card-subtitle">算力：' + number_format(item.power) + ' Ghs</div>';
					            }
					            if (item.catalog == 1) {
					            	html += '<a href="javascript:void(0)" class="btn btn-primary btn-sm btn-choose" data-currency="' + unit + '" data-id="' + item.id + '"><i class="fe fe-shopping-cart"></i> ' + number_format(item.price) + '美元</a>';
					            } else {
					            	html += '<a href="javascript:void(0)" class="btn btn-primary btn-sm btn-choose" data-currency="' + unit + '" data-id="' + item.id + '"><i class="fe fe-shopping-cart"></i> ' + number_format(item.price) + unit + '</a>';
					            }
					            if (isScore && item.price_score && item.price_score > 0) {
					            	html += '<a href="javascript:void(0)" class="btn btn-success btn-sm btn-choose ml-2" data-currency="' + score_unit + '" data-id="' + item.id + '"><i class="fe fe-shopping-cart"></i> ' + number_format(item.price_score) + score_unit + '</a>';
					            }
					        html += '</div>';
					    html += '</div>';
					html += '</div>';
				}
				$('.products').append(html);
				if (res.data.length == size) {
					page++;
					$('.more').prop('hidden', false);
				} else {
					$('.more').prop('hidden', true);
				}
			} else {
				toast(res.message);
			}
		});
	}
	$(function(){
		// 轮播图
		$('.carousel').carousel({
			interval: 3000
		});
		// 读取商品
		products();
		// 切换类目
		$('.btn-list .btn').on('click', function(){
			catalog = $(this).data('catalog');
			$('.products').empty();
			page = 1;
			products();
		});
		// 加载更多
		$('.more').on('click', function(){
			products();
		});
		// 选择商品
		$('.products').on('click', '.btn-choose', function(){
			window.pid = $(this).data('id') || $(this).attr('data-id');
			if (!dataset[pid]) {
				return false;
			}
			window.pcurrency = $(this).data('currency');
			if (pcurrency != unit) {
				$('.modal-shop .currency').text('使用' + pcurrency);
			} else {
				$('.modal-shop .currency').text('');
			}
			var item = dataset[pid];
			if (item.catalog == 1) {
				$('.store-confirm').prop('hidden', false);
				$('.store-confirm .form-group').prop('hidden', false);
				$('.store-address').prop('hidden', true);
				$('.store-content').prop('hidden', true);
			} else if (item.catalog == 2) {
				$('.store-confirm').prop('hidden', false);
				$('.store-confirm .form-group').prop('hidden', true);
				$('.store-address').prop('hidden', true);
				$('.store-content').prop('hidden', true);
			} else {
				$('.store-confirm').prop('hidden', true);
				$('.store-address').prop('hidden', true);
				$('.store-content').prop('hidden', false);
				$('.store-content .modal-body').html(item.content);
			}
			$('.btn-buy').removeClass('btn-loading');
			$('.modal-shop').modal('show');
		});
		// 选择收货地址
		$('.btn-go-address').on('click', function(){
			$('.store-content').prop('hidden', true);
			$('.store-address').prop('hidden', false);
		});
		// 省市区
		var provinces = area.get('0');
		var html = '';
		for (var i = 0; i < provinces.length; i++) {
			html += '<option value="' + i + '">' + provinces[i] + '</option>';
		}
		$('select[name=province]').append(html);
		$('select[name=province]').on('change', function(){
			// 省份的值
			var province = $('select[name=province]').val();
			// 清空城市
			$('select[name=city] option:gt(0)').remove();
			// 清空区县
			$('select[name=county] option:gt(0)').remove();
			if (province != '') {
				// 加载城市
				var citys = area.get('0_' + province);
				var html = '';
				for (var i = 0; i < citys.length; i++) {
					html += '<option value="' + i + '">' + citys[i] + '</option>';
				}
				$('select[name=city]').append(html);
			}
		});
		$('select[name=city]').on('change', function(){
			// 省份的值
			var province = $('select[name=province]').val();
			// 城市的值
			var city = $('select[name=city]').val();
			// 清空区县
			$('select[name=county] option:gt(0)').remove();
			if (city != '') {
				// 加载区县
				var countys = area.get('0_' + province + '_' + city);
				var html = '';
				for (var i = 0; i < countys.length; i++) {
					html += '<option value="' + i + '">' + countys[i] + '</option>';
				}
				$('select[name=county]').append(html);
			}
		});
		// 兑换商品
		$('.btn-buy').on('click', function(){
			if (!window.pid) {
				toast('很抱歉、服务器繁忙请刷新后再试！');
				return false;
			}
			if ($(this).hasClass('btn-loading')) {
				return false;
			}
			var param = {
				id: window.pid,
				currency: pcurrency,
			}
			var item = dataset[pid];
			if (item.catalog == 1 && $('.store-confirm input[name=code]').length) {
				var code = $('.store-confirm input[name=code]').val();
				if (code == '') {
					toast('很抱歉、请输入激活码！');
					return false;
				}
				param.code = code;
			}
			if (item.catalog != 1 && item.catalog != 2) {
				// 获取姓名
				var name = $('.store-address input[name=name]').val();
				if (name == '') {
					$('.store-address input[name=name]').addClass('state-invalid').focus();
					return false;
				} else {
					$('.store-address input[name=name]').removeClass('state-invalid');
				}
				param.name = name;
				// 获取手机
				var mobile = $('.store-address input[name=mobile]').val();
				if (mobile == '' || isNaN(mobile) || mobile.length != 11) {
					$('.store-address input[name=mobile]').addClass('state-invalid').focus();
					return false;
				} else {
					$('.store-address input[name=mobile]').removeClass('state-invalid');
				}
				param.mobile = mobile;
				// 省份
				var province = $('.store-address select[name=province]').val();
				if (province == '') {
					$('.store-address select[name=province]').focus();
					return false;
				}
				param.province = $('.store-address select[name=province] option:selected').text();
				// 城市
				var city = $('.store-address select[name=city]').val();
				if (city == '') {
					$('.store-address select[name=city]').focus();
					return false;
				}
				param.city = $('.store-address select[name=city] option:selected').text();
				// 区县
				var county = $('.store-address select[name=county]').val();
				if (county == '') {
					$('.store-address select[name=county]').focus();
					return false;
				}
				param.county = $('.store-address select[name=county] option:selected').text();
				// 地址
				var address = $('.store-address input[name=address]').val();
				if (address == '') {
					$('.store-address input[name=address]').addClass('state-invalid').focus();
					return false;
				} else {
					$('.store-address input[name=address]').removeClass('state-invalid');
				}
				param.address = address;
				// 备注
				var remark = $('.store-address textarea[name=remark]').val();
				if (remark && remark != '') {
					param.remark = remark;
				}
			}
			$(this).addClass('btn-loading');
			ajax(api.store.buy, param, function(res){
				if (res.code == 200) {
					toast('恭喜您、' + (item.catalog == 1 ? '激活' : '兑换') + '成功！', function(){
						if (item.catalog == 1) {
							window.location.href = '/machine.html';
						} else {
							window.location.href = '/order.html';
						}
					});
				} else {
					toast(res.message);
				}
				$('.btn-buy').removeClass('btn-loading');
				$('.modal').modal('hide');
			});
		});
	});
});