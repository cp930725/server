var rnd = function rnd(n, m){
	return Math.floor(Math.random()*(m-n+1)+n);
}
var mobile = function(){
	var prefixs = [130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 145, 147, 149, 150, 151, 152, 153, 155, 156, 157, 158, 159, 166, 171, 173, 175, 176, 177, 178, 180, 181, 182, 183, 184, 185, 186, 187, 188, 189, 198, 199];
	var phone = rnd(1000, 9999);
	return prefixs[rnd(0, prefixs.length - 1)] + '****' + phone;
}
var rndItem = function(){
	var m = mobile();
	var r = rewards[rnd(0, rewards.length - 1)];
	var html = '';
	html += '<li class="list-separated-item pt-1 pb-1">';
		html += '<div class="row align-items-center">';
			html += '<div class="col-auto">' + m + '</div>';
			html += '<div class="col text-right">';
				html += '<small class="d-block item-except text-sm text-muted h-1x">获得' + r + '</small>';
			html += '</div>';
		html += '</div>';
	html += '</li>';
	return html;
}
require(['scratch', 'jquery'], function(sc, $){
	$(function(){
		// 初始名单
		var html = '';
		for (var i = 0; i < 30; i++) {
			html += rndItem();
		}
		$('.namelist').append(html);
		// 移动名单
		var timer, time = 0, speed = 400, showlength = 5, itemheight = 31;
		var running = function(){
			$('.namelist').css({
				transitionDuration: speed + 'ms',
				transitionTimingFunction: 'linear',
				transform: 'translateY(0px)'
			});
			time = 0;
			timer = setInterval(function(){
				if ($('.card-result').hasClass('card-collapsed')) {
					return false;
				}
				time += itemheight;
				if (time > itemheight * 30) {
					time = 0;
				}
				$('.namelist').css({
					transform: 'translateY(-' + time + 'px)'
				});
			}, speed * 1.5);
		}
		running();
		$('.namelist').on('transitionend', function(){
			if (time == itemheight * showlength * 4) {
				clearInterval(timer);
				var html = '';
				for (var i = 0; i < showlength * 4; i++) {
					html += rndItem();
				}
				$('.namelist').append(html);
				$('.namelist li:lt(' + (showlength * 4) + ')').remove();
				$('.namelist').attr('style', 'transition-duration: 0ms; transition-timing-function: linear; transform: translateY(0px);')
				setTimeout(function(){
					running();
				});
			}
		});
		// 刮刮卡
		window.scratch = new Scratch({
			canvasId: 'js-scratch-canvas',
			// imageBackground: '/static/image/transaction-1.jpg',
			pictureOver: '/static/image/ggl_mask.jpg',
			radius: 5,
			nPoints: 30,
			percent: 50,
			sceneWidth: 200,
			sceneHeight: 50,
			load: function(){
				$('.scratch-reward').prop('hidden', false);
			},
			reward: function(){
				ajax(api.event.scratch, {}, function(res){
					var myChance = $('.myChance').text();
					if (!isNaN(myChance)) {
						myChance = parseInt(myChance, 10);
						myChance = myChance - 1;
						myChance = myChance < 0 ? 0 : myChance;
						$('.myChance').text(myChance);
					}
					if (res.code == 200) {
						$('.scratch-reward').text(res.data.reward.name);
						$('.reward-text strong').text(res.data.reward.name);
					} else {
						$('.scratch-reward').text('再接再厉');
					}
				});
			},
			callback: function() {
				var rd = $('.scratch-reward').text();
				if (rd != '' && rd != '再接再厉') {
					$('.modal-reward').modal();
				}
				$('.scratch').addClass('scratch-again');
			},
			// pointSize: {x: 3, y: 3}
		});
		// 重置刮刮卡
		$('.scratch-reset').on('click', function(){
			$('.scratch-reward').text('抽奖中...');
			$('.scratch').removeClass('scratch-again');
			scratch.reset();
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
		// 申请提货
		$('.card-myrewards').on('click', '.btn-pickup', function(){
			var tr = $(this).parents('tr');
			var reward = tr.attr('reward');
			window.id = tr.attr('id').substr(2);
			var name = tr.find('td:eq(0)').text();
			if (reward == 3) {
				$('.modal-pickup input[name=name]').parents('.form-group').prop('hidden', true);
				$('.modal-pickup select[name=province]').parents('.form-group').prop('hidden', true);
				$('.modal-pickup input[name=address]').parents('.form-group').prop('hidden', true);
			} else {
				$('.modal-pickup input[name=name]').parents('.form-group').prop('hidden', false);
				$('.modal-pickup select[name=province]').parents('.form-group').prop('hidden', false);
				$('.modal-pickup input[name=address]').parents('.form-group').prop('hidden', false);
			}
			$('.modal-pickup').modal();
		});
		$('.btn-pickup-post').on('click', function(){
			// 姓名
			var name = $('.modal-pickup input[name=name]').val();
			if (!$('.modal-pickup input[name=name]').parents('.form-group').prop('hidden') && name == '') {
				$('.modal-pickup input[name=name]').addClass('state-invalid').focus();
				return false;
			} else {
				$('.modal-pickup input[name=name]').removeClass('state-invalid');
			}
			// 手机
			var mobile = $('.modal-pickup input[name=mobile]').val();
			if (!$('.modal-pickup input[name=mobile]').parents('.form-group').prop('hidden') && mobile == '') {
				$('.modal-pickup input[name=mobile]').addClass('state-invalid').focus();
				return false;
			} else {
				$('.modal-pickup input[name=mobile]').removeClass('state-invalid');
			}
			// 省份
			var province = $('.modal-pickup select[name=province]').val();
			if (!$('.modal-pickup select[name=province]').parents('.form-group').prop('hidden') && province == '') {
				$('.modal-pickup select[name=province]').focus();
				return false;
			}
			province = $('.modal-pickup select[name=province] option:selected').text();
			// 城市
			var city = $('.modal-pickup select[name=city]').val();
			if (!$('.modal-pickup select[name=city]').parents('.form-group').prop('hidden') && city == '') {
				$('.modal-pickup select[name=city]').focus();
				return false;
			}
			city = $('.modal-pickup select[name=city] option:selected').text();
			// 区县
			var county = $('.modal-pickup select[name=county]').val();
			if (!$('.modal-pickup select[name=county]').parents('.form-group').prop('hidden') && county == '') {
				$('.modal-pickup select[name=county]').focus();
				return false;
			}
			county = $('.modal-pickup select[name=county] option:selected').text();
			// 地址
			var address = $('.modal-pickup input[name=address]').val();
			if (!$('.modal-pickup input[name=address]').parents('.form-group').prop('hidden') && address == '') {
				$('.modal-pickup input[name=address]').addClass('state-invalid').focus();
				return false;
			} else {
				$('.modal-pickup input[name=address]').removeClass('state-invalid');
			}
			// 隐藏表单
			$('.modal-pickup').modal('hide');
			// 状态更新
			var td = $('#my' + window.id).find('td:eq(1)');
			td.find('span').removeClass('bg-secondary').addClass('bg-warning');
			td.find('small').text('待发货');
			$('#my' + window.id).find('td:eq(2) button').removeClass('btn-pickup').addClass('btn-look').text('查看');
			// 提交数据
			ajax(api.event.pickup, {id: window.id, name: name, mobile: mobile, province: province, city: city, county: county, address: address}, function(res){
				if (res.code != 200) {
					toast(res.message);
				}
			});
		});
		// 查看发货
		$('.card-myrewards').on('click', '.btn-look', function(){
			if ($(this).hasClass('btn-loading')) {
				return false;
			}
			var tr = $(this).parents('tr');
			window.id = tr.attr('id').substr(2);
			var btn = $(this);
			btn.addClass('btn-loading');
			ajax(api.event.look, {id: window.id}, function(res){
				btn.removeClass('btn-loading');
				if (res.code == 200) {
					var shouhuo = '', fahuo = '';
					if (res.data.type == 3) {
						shouhuo = res.data.receive.mobile;
						fahuo = res.data.send ? res.data.send : '预计3天内到账';
					} else if (res.data.type == 2) {
						shouhuo = res.data.receive.name + ' ' + res.data.receive.mobile + '<br />' + res.data.receive.province + res.data.receive.city + res.data.receive.county + res.data.receive.address;
						fahuo = res.data.send ? res.data.send : '请等待工作人员审核';
					}
					$('.modal-look .shouhuo').html(shouhuo);
					$('.modal-look .fahuo').html(fahuo);
					$('.modal-look').modal();
				} else {
					toast(res.message);
				}
			});
		});
		// 页面滚动
		$('.scratch').on('touchmove', function(ev){
			ev.preventDefault();
			return false;
		});
	});
});