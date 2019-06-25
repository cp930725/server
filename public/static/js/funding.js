require(['jquery', 'ZeroClipboard'], function($, ZeroClipboard){
	window['ZeroClipboard'] = ZeroClipboard;
	// 全局变量
	var page = 1, size = 20, filter = 'all', catalog = '', timer = null, date = new Date();
	// 首页数据
	var index = function(){
		var param = {
			page: page,
			size: typeof(_size) != 'undefined' ? _size : size,
			filter: filter,
			catalog: catalog,
		}
		ajax(api.funding.list, param, function(res){
			if (res.code == 200) {
				var html = '';
				for (var i = 0; i < res.data.length; i++) {
					var item = res.data[i];
					var ratio = Math.round(item.current / item.target * 100);
					ratio = ratio < 0 ? 0 : ratio;
					html += '<div class="col-md-6 col-lg-4">';
						var mb = ' mb-3';
						if (i == res.data.length - 1) {
							mb = ' mb-0';
						}
						html += '<a class="media' + mb + '" href="/funding/' + item.id + '.html">';
							html += '<img src="/upload/' + item.image + '" class="align-self-start rounded projects-image" />';
							html += '<div class="media-body ml-4 h-100">';
								/*html += '<div class="projects-title text-dark">' + item.title + '</div>';
								html += '<div class="progress progress-xs">';
				                    html += '<div class="progress-bar bg-green" role="progressbar" style="width: ' + ratio + '%" aria-valuenow="' + ratio + '" aria-valuemin="0" aria-valuemax="100"></div>';
				                html += '</div>';
				                html += '<span class="text-' + (ratio == 0 ? 'muted' : 'green') + ' progress-label">' + ratio + '%</span>';
				                html += '<small class="text-muted projects-info">已筹资 <strong class="text-dark">' + number_format(item.current) + '</strong>' + unit + ' | 支持数 <strong class="text-dark">' + item.people + '</strong></small>';*/
				                html += '<div class="d-flex flex-column justify-content-between h-100">';
				                	html += '<div class="font-weight-light text-dark">' + item.title + '</div>';
				                	html += '<div class="position-relative">'
	            						html += '<div class="progress progress-xs mr-7">';
	            		                    html += '<div class="progress-bar bg-green" role="progressbar" style="width: ' + ratio + '%" aria-valuenow="' + ratio + '" aria-valuemin="0" aria-valuemax="100"></div>';
	            		                html += '</div>';
	            		                   html += '<span class="text-' + (ratio == 0 ? 'muted' : 'green') + ' progress-label">' + ratio + '%</span>';
            		                html += '</div>';
				                	html += '<small class="text-muted projects-info">已筹资 <strong class="text-dark">' + number_format(item.current) + '</strong>' + unit + ' | 支持数 <strong class="text-dark">' + item.people + '</strong></small>';
				                html += '</div>';

							html += '</div>';
						html += '</a>';
					html += '</div>';
				}
				$('.projects').append(html);
			} else {
				toast(res.message);
			}
		});
	}
	// 查询记录
	var log = function(){
		var param = {
			id: id,
			page: page,
			size: size,
		}
		ajax(api.funding.log, param, function(res){
			if (res.code == 200) {
				var html = '';
				for (var i = 0; i < res.data.length; i++) {
					var item = res.data[i];
					html += '<li class="timeline-item">';
						html += '<div class="timeline-badge"></div>';
						html += '<div class="d-block w-100">';
							html += '<div class="d-flex">';
								html += '<strong>' + item.nickname + '</strong>';
								if (item.money > 0) {
									html += '<div class="timeline-time text-green">' + number_format(item.money) + unit + '</div>';
								}
							html += '</div>';
							if (item.action == 8) {
								html += '<div class="mt-1 text-blue">项目结束，感谢大家的支持！</div>';
							}
							html += '<small class="d-block text-muted-dark mt-1">' + item.date + '</small>';
						html += '</div>';
					html += '</li>';
				}
				if (res.data.length == size) {
					page++;
					$('.more').prop('hidden', false);
				} else {
					$('.more').prop('hidden', true);
				}
				$('.timeline').append(html);
			} else {
				toast(res.message);
			}
		});
	}
	// 倒计时
	var countdown = function(enddate) {
		var leftTime = (new Date(enddate)) - new Date();
		var days = parseInt(leftTime / 1000 / 60 / 60 / 24, 10);
		var hours = parseInt(leftTime / 1000 / 60 / 60 % 24, 10);
		var minutes = parseInt(leftTime / 1000 / 60 % 60, 10);
		var seconds = parseInt(leftTime / 1000 % 60, 10);
		days = days;
		hours = hours;
		minutes = minutes;
		seconds = seconds;
		if (days > 1) {
			$('.expire_at').prop('hidden', false);
			$('.countdown').text(days + "天");
		} else if (hours >= 0 || minutes >= 0 || seconds >= 0) {
			$('.expire_at').prop('hidden', false);
			var text = '';
			if (hours > 0) {
				text += hours + '小时';
			}
			if (minutes > 0) {
				text += minutes + '分';
			}
			if (seconds > 0) {
				text += seconds + '秒';
			}
			$('.countdown').text(text);
		}
		if (days <= 0 && hours <= 0 && minutes <= 0 && seconds <= 0) {
			$('.expire_at').prop('hidden', true);
			$('.over-status').prop('hidden', false);
			window.clearInterval(timer);
			timer = null;
		}
	}
	$(function(){
		// 项目列表
		if (frame == 'index') {
			// 商店数据
			index();
			// 筛选数据
			$('select[name=filter]').on('change', function(){
				filter = $(this).val();
				page = 1;
				$('.projects').empty();
				index();
			});
			// 筛选数据
			$('select[name=catalog]').on('change', function(){
				catalog = $(this).val();
				page = 1;
				$('.projects').empty();
				index();
			});
		}
		// 项目详情
		if (frame == 'detail') {
			// 倒计时
			var expireDate = new Date(expire_at.replace(/-/g, "/"));
			if (date < expireDate) {
				timer = setInterval(function(){
					countdown(expire_at.replace(/-/g, "/"));
				}, 1000);
			} else {
				$('.over-status').prop('hidden', false);
			}
			// 项目记录
			log();
			$('.more').on('click', function(){
				log();
			});
			// 支持额度
			$('.btn-jiajian').on('click', function(){
				var value = $(this).data('value');
				var current = $('input[name=money]').val();
				if (!current || current == '' || isNaN(current)) {
					current = 1;
				} else {
					current = parseFloat(current, 10);
				}
				current += value;
				$('input[name=money]').val(current);
			});
			$('input[name=money]').on('input', function(){
				var current = $(this).val();
				if (!current || current == '' || isNaN(current)) {
					current = 1;
				} else {
					current = parseFloat(current, 10);
				}
				$('input[name=money]').val(current);
			});
			// 提交支持
			$('.btn-invest').on('click', function(){
				if ($(this).hasClass('btn-loading')) {
					return false;
				}
				var money = $('#modal-invest input[name=money]').val();
				if (!money || money == '' || isNaN(money) || money < 0) {
					$('#modal-invest input[name=money]').focus();
					return false;
				}
				var safeword = $('#modal-invest input[name=safeword]').val();
				if (safeword == '') {
					$('#modal-invest input[name=safeword]').focus();
					return false;
				}
				$('.btn-invest').addClass('btn-loading');
				ajax(api.funding.invest, {id: id, money: money, safeword: safeword}, function(res){
					$('.btn-invest').removeClass('btn-loading');
					if (res.code == 200) {
						toast(res.message, function(){
							window.location.reload();
						});
					} else {
						toast(res.message);
					}
				});
			});
			// 结束项目
			$('.btn-over').on('click', function(){
				if ($(this).hasClass('btn-loading')) {
					return false;
				}
				var safeword = $('#modal-over input[name=safeword]').val();
				if (safeword == '') {
					$('#modal-over input[name=safeword]').focus();
					return false;
				}
				$('.btn-over').addClass('btn-loading');
				ajax(api.funding.over, {id: id, safeword: safeword}, function(res){
					$('.btn-over').removeClass('btn-loading');
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
		// 发布项目
		if (frame == 'publish') {
			// 实例化编辑器
			var ue = UE.getEditor('editor', {
				toolbars: [
					['fullscreen', 'forecolor', 'bold', 'simpleupload']
				],
				serverUrl: '/ueditor.html',
				zIndex: 900,
				elementPathEnabled: false,
				wordCount: false,
				enableAutoSave: false,
				enableContextMenu: false,
			});
			// 表单提交
			$('form').on('submit', function(){
				// 获取名称
				var title = $('input[name=title]').val();
				if (title == '') {
					$('input[name=title]').focus();
					return false;
				}
				// 获取图片
				var files = $('input[name=image]')[0].files;
				if (files.length == 0) {
					toast('很抱歉、请选择项目图片！');
					return false;
				}
				// 目标金额
				var target = $('input[name=target]').val();
				if (target == '' || isNaN(target)) {
					$('input[name=target]').focus();
					return false;
				}
				target = parseFloat(target, 10);
				var max = $('input[name=target]').data('max');
				if (max && max < target) {
					toast('很抱歉、您最多筹集' + max + unit + '！');
					return false;
				}
				// 获取密码
				var safeword = $('input[name=safeword]').val();
				if (safeword == '') {
					$('input[name=safeword]').focus();
					return false;
				}
				// 获取详情
				var content = ue.getContentTxt();
				if (content == '') {
					ue.focus();
					return false;
				}
				// 提交表单
				return true;
			});
		}
		// 编辑项目
		if (frame == 'edit') {
			// 实例化编辑器
			var ue = UE.getEditor('editor', {
				toolbars: [
					['fullscreen', 'forecolor', 'bold', 'simpleupload']
				],
				serverUrl: '/ueditor.html',
				zIndex: 900,
				elementPathEnabled: false,
				wordCount: false,
				enableAutoSave: false,
				enableContextMenu: false,
			});
			// 表单提交
			$('form').on('submit', function(){
				// 获取名称
				var title = $('input[name=title]').val();
				if (title == '') {
					$('input[name=title]').focus();
					return false;
				}
				// 获取密码
				var safeword = $('input[name=safeword]').val();
				if (safeword == '') {
					$('input[name=safeword]').focus();
					return false;
				}
				// 获取详情
				var content = ue.getContentTxt();
				if (content == '') {
					ue.focus();
					return false;
				}
				// 提交表单
				return true;
			});
		}
	});
});