require(['jquery'], function($){
	var page = 1, size = 20, catalog = '', role = '', status = '';
	var getData = function(){
		var param = {
			page: page,
			size: size
		}
		if (catalog != '') {
			param.catalog = catalog;
		}
		if (role != '') {
			param.role = role;
		}
		if (status != '') {
			param.status = status;
		}
		ajax(api.store.order, param, function(res){
			if (res.code == 200) {
				var html = '';

				for (var i = 0; i < res.data.length; i++) {
					var item = res.data[i]
					html += '<div class="card" id="' + item.oid + '">';
						html += '<div class="card-header">';
							html += '<div class="card-title f1">' + item.oid + '</div>';
							html += '<div class="card-options">';
								html += '<div class="mr-2">';
								if (item.status == 1) {
									html += '<span class="status-icon bg-success"></span> <span class="small">交易成功</span>';
								} else if (item.status == 2) {
									html += '<span class="status-icon bg-warning"></span> <span class="small">待发货</span>';
								} else if (item.status == 3) {
									html += '<span class="status-icon bg-warning"></span> <span class="small">待确认</span>';
								} else {
									html += '<span class="status-icon bg-danger"></span> <span class="small">失败</span>';
								}
								html += '</div>';
							html += '</div>';
						html += '</div>';
					    html += '<div class="card-body p-3">';
					        html += '<div class="text-center text-green h1 mb-3">' + number_format(item.price) + unit;
					        	if (item.role == 'seller' && item.charge > 0) {
					        		html += '<sup class="charge">手续费：' + number_format(item.charge) + unit + '</sup>';
					        	}
					        html += '</div>';
					        html += '<div class="text-center">' + item.title + '</div>';
					        if (item.address) {
						        html += '<div class="alert alert-info mt-3">';
						        	html += '<div><b>收货信息</b></div>';
						        	html += '<div class="small">' + item.address.name + ' ' + item.address.mobile + '</div>';
						        	if (item.address.province) {
						        		html += '<div class="small">' + item.address.province + item.address.city + item.address.county + item.address.address + '</div>';
						        	}
						        	if (item.address.remark) {
						        		html += '<div class="small">' + item.address.remark + '</div>';
						        	}
						        html += '</div>';
					        }
					        if (item.express) {
						        html += '<div class="alert alert-primary mt-3">';
						        	html += '<div><b>发货信息</b></div>';
						        	html += '<div class="small">' + item.express + '</div>';
						        html += '</div>';
					        }
					    html += '</div>';
						html += '<div class="card-footer text-right">';
							html += '<small class="text-muted float-left date">' + item.date + '</small>';
							if (item.role == 'seller') {
								html += '<a href="tel:' + item.buyer.username + '" class="btn btn-secondary btn-sm">联系买家</a>';
							} else if (item.role == 'buyer' && item.seller.username) {
								html += '<a href="tel:' + item.seller.username + '" class="btn btn-secondary btn-sm">联系卖家</a>';
							}
							if (item.status == 2) {
								if (item.role == 'seller') {
									html += '<button type="button" class="btn btn-secondary btn-sm btn-shipped ml-2">发货</button>';
								}
							}
							if (item.status == 3) {
								if (item.role == 'buyer') {
									html += '<button type="button" class="btn btn-secondary btn-sm btn-confirm ml-2">确认收货</button>';
								}
							}
						html += '</div>';
					html += '</div>';
				}
				$('.orders').append(html);
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
		// 获取身份
		role = param('role');
		// 获取状态
		status = param('status');
		// 获取订单
		getData();
		// 切换类目
		$('select[name=catalog]').on('change', function(){
			catalog = $(this).val();
			page = 1;
			$('.orders').empty();
			// $('.card-table tbody').empty();
			getData();
		});
		// 加载更多
		$('.more').on('click', function(){
			getData();
		});
		// 立即发货
		$('.orders').on('click', '.btn-shipped', function(){
			var id = $(this).parents('.card').attr('id');
			$('.modal-shipped input[name=oid]').val(id);
			$('.modal-shipped').modal();
		});
		// 确认收货
		$('.orders').on('click', '.btn-confirm', function(){
			var id = $(this).parents('.card').attr('id');
			$('.modal-confirm input[name=oid]').val(id);
			$('.modal-confirm').modal();
		});
	});
});