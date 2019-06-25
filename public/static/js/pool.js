require(['jquery'], function($){
	// 倒计时
	var clock = function(){
		window.timer = setInterval(function(){
			$('.second .expire').text(window.expire + 's');
			if (window.expire <= 0) {
				clearInterval(window.timer);
				window.timer = null;
				$('.second').prop('hidden', true);
				$('.profit').prop('hidden', false);
				$('.progress-bar').css('width', '100%').attr('aria-valuenow', 100);
			} else {
				$('.second .expire').text(window.expire + 's');
				window.expire--;
				var iprocess = Math.floor((1 - (window.expire / window.duration).toFixed(2)) * 100);
				$('.progress-bar').css('width', iprocess + '%').attr('aria-valuenow', iprocess);
			}
		}, 1000);
	}
	$(function(){
		// 选择道具
		$('.table-prop tbody tr').on('click', function(){
			$(this).find('td').eq(0).find('input').prop('checked', true);
		});
		// 倒计时
		ajax(api.event.pool, {action: 'countdown'}, function(res){
			if (res.code != 200) {
				toast(res.message);
			} else {
				var last_at = (new Date(res.data.last_at.replace(/-/g, "/"))).getTime() / 1000;
				var current = Math.floor((new Date()).getTime() / 1000);
				window.duration = res.data.duration;
				window.expire = duration - (current - last_at);
				clock();
			}
		});
		// 使用道具
		$('.btn-prop').on('click', function(){
			// 选中的道具
			var prop = $('input[name=prop]:checked').val();
			if (!prop || $(this).hasClass('btn-loading')) {
				return false;
			}
			$(this).addClass('btn-loading');
			// 兑换道具
			ajax(api.store.buy, {id: prop}, function(res){
				$('.btn-prop').removeClass('btn-loading');
				if (res.code == 200) {
					toast(res.message, function(){
						window.location.reload();
					});
				} else {
					toast(res.message);
				}
			});
		});
		// 领取收益
		$('.btn-profit').on('click', function(){
			if ($(this).hasClass('btn-loading')) {
				return false;
			}
			$(this).addClass('btn-loading');
			ajax(api.event.pool, {action: 'profit'}, function(res){
				$('.btn-profit').removeClass('btn-loading');
				if (res.code == 200) {
					toast(res.message, function(){
						window.location.reload();
					});
				} else {
					toast(res.message);
				}
			});
		});
	});
});