require(['jquery', 'ZeroClipboard'], function($, ZeroClipboard){
	window['ZeroClipboard'] = ZeroClipboard;
	var ue;
	$(function(){
	    // 实例化编辑器
	    if ($('#editor').length) {
		    ue = UE.getEditor('editor', {
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
	    }
		// 选择图片
		$('.publish input[name=image]').on('change', function(){
			var file = $(this)[0].files[0];
			var reader = new FileReader();
			$('.preview').prop('hidden', false).addClass('active');
			reader.onload = function(){
				$('.preview img').attr('src', reader.result);
				$('.preview').removeClass('active');
			}
			reader.readAsDataURL(file);
		});
		// 发布商品
		$('.publish .btn-publish').on('click', function(){
			if ($(this).hasClass('btn-loading')) {
				return false;
			}
			// 获取名称
			var title = $('.publish input[name=title]').val();
			if (title == '') {
				toast('很抱歉、请填写宝贝名称！');
				return false;
			}
			// 获取类目
			var catalog = $('.publish select[name=catalog]').val();
			if (catalog == '') {
				toast('很抱歉、请选择所属类目！');
				return false;
			}
			// 获取数量
			var stock = $('.publish input[name=stock]').val();
			if (stock == '' || isNaN(stock) || stock <= 0) {
				toast('很抱歉、请填写库存数量！');
				return false;
			}
			// 获取价格
			var price = $('.publish input[name=price]').val();
			if (price == '' || isNaN(price) || price <= 0) {
				toast('很抱歉、请填写宝贝价格！');
				return false;
			}
			// 获取主图
			var imageFiles = $('.publish input[name=image]')[0].files;
			if (imageFiles.length == 0) {
				toast('很抱歉、请提交宝贝主图！');
				return false;
			}
			// 获取详情
			var content = ue.getContent();
			// 提交数据
			$('.publish .btn-publish').addClass('btn-loading');
			ajax(api.store.publish, {title: title, catalog: catalog, stock: stock, price: price, image: imageFiles[0], content: content}, function(res){
				$('.publish .btn-publish').removeClass('btn-loading');
				if (res.code == 200) {
					window.location.href = '/store/seller.html?c=' + catalog;
				} else {
					toast(res.message);
				}
			}, 'file');
		});
		// 编辑商品
		$('.edit .btn-edit').on('click', function(){
			if ($(this).hasClass('btn-loading')) {
				return false;
			}
			// 获取编号
			var id = $('.edit input[name=id]').val();
			if (id == '' || !id) {
				toast('很抱歉、请刷新页面后再试！');
				return false;
			}
			// 获取名称
			var title = $('.edit input[name=title]').val();
			if (title == '') {
				toast('很抱歉、请填写宝贝名称！');
				return false;
			}
			// 获取类目
			var catalog = $('.edit select[name=catalog]').val();
			if (catalog == '') {
				toast('很抱歉、请选择所属类目！');
				return false;
			}
			// 获取数量
			var stock = $('.edit input[name=stock]').val();
			if (stock == '' || isNaN(stock) || stock <= 0) {
				toast('很抱歉、请填写库存数量！');
				return false;
			}
			// 获取价格
			var price = $('.edit input[name=price]').val();
			if (price == '' || isNaN(price) || price <= 0) {
				toast('很抱歉、请填写宝贝价格！');
				return false;
			}
			// 获取主图
			var imageFiles = $('.edit input[name=image]')[0].files;
			// 获取详情
			var content = ue.getContent();
			// 提交数据
			$('.edit .btn-edit').addClass('btn-loading');
			ajax(api.store.edit, {id: id, title: title, catalog: catalog, stock: stock, price: price, image: imageFiles.length ? imageFiles[0] : '', content: content}, function(res){
				$('.edit .btn-edit').removeClass('btn-loading');
				if (res.code == 200) {
					window.location.href = '/store/seller.html?c=' + catalog;
				} else {
					toast(res.message);
				}
			}, 'file');
		});
		// 上下架
		$('.seller-products .card input[name=status]').on('change', function(){
			if (window.seller_status_timer) {
				clearTimeout(window.seller_status_timer);
				window.seller_status_timer = null;
			}
			var id = $(this).data('id');
			var checked = $(this).prop('checked');
			$(this).prev().text(checked ? '当前：上架中' : '当前：已下架');
			window.seller_status_timer = setTimeout(function(){
				ajax(api.store.status, {id: id, status: checked ? 1 : 0}, function(res){
					window.seller_status_timer = null;
					if (res.code != 200) {
						toast(res.message);
					}
				});
			}, 1000);
		});
		// 删除商品
		$('.seller-products .card .btn-delete').on('click', function(){
			var id = $(this).data('id');
			$('.modal-delete input[name=id]').val(id);
			$('.modal-delete').modal();
		})
		$('.modal-delete form').on('submit', function(){
			var id = $('.modal-delete form input[name=id]').val();
			if (!id) {
				toast('很抱歉、请刷新页面后再试！');
				return false;
			}
			var safeword = $('.modal-delete form input[name=safeword]').val();
			if (!safeword || safeword.length < 6) {
				toast('很抱歉、请输入安全密码！');
				return false;
			}
			return true;
		});
	});
});