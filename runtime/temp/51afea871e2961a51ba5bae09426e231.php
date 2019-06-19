<?php /*a:2:{s:73:"D:\phpstudy\PHPTutorial\WWW\test\application\admin\view\market\bonus.html";i:1526989444;s:73:"D:\phpstudy\PHPTutorial\WWW\test\application\admin\view\common\world.html";i:1555177043;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover, shrink-to-fit=no" />
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef" />
    <meta name="theme-color" content="#4188c9" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" href="/favicon.ico?2" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico?2" />
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/css/dashboard.css?3" />
    <title>发放全球交易分红</title>
    <style>
    .toast {
        text-align: center;
    }
    .toast-mask {
        position: fixed; z-index: 2456;
        left: 0;top: 0;right: 0;bottom: 0;
        background: rgba(0, 0, 0, 0.6);
    }
    .toast-body {
        position: fixed;
        z-index: 5000;
        width: 80%;
        max-width: 300px;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        background-color: #FFFFFF;
        text-align: center;
        border-radius: 3px;
        overflow: hidden;
    }
    .toast-icon {
        padding: 1rem;
        min-height: 40px;
        line-height: 1.3;
    }
    .toast-icon i {
        font-size: 5rem;
    }
    .toast-message {
        word-wrap: break-word;
        word-break: break-all;
        font-size: 1.1rem;
    }
    .dropdown-menu {
        z-index: 2200;
    }
    </style>
    
</head>

<body>
<!-- content -->
<div class="page">
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="/admin.html"><img src="/static/image/logo.png" class="header-brand-img" alt="tabler logo"></a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="nav-item">
                            <a href="/signin.html" class="btn btn-sm btn-outline-primary">返回前台</a>
                        </div>
                        <div class="dropdown">
                            <a class="nav-link pr-0 leading-none">
                                <span class="avatar me-avatar" style="background-image: url(/static/image/icon.png);"><span class="avatar-status bg-green"></span></span>
                                <span class="ml-2 d-none d-lg-block">
                                    <span class="text-default">超级管理员</span>
                                    <small class="text-muted d-block mt-1"><?php echo app('request')->ip(); ?></small>
                                </span>
                            </a>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 ml-auto header-search-div">
                        <form class="input-icon my-3 my-lg-0" method="get" action="/admin/account/edit.html">
                            <input type="search" class="form-control header-search" placeholder="用户账号&hellip;" tabindex="1" name="username" />
                            <div class="input-icon-addon">
                                <i class="fe fe-search"></i>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="/admin.html" class="nav-link"><i class="fe fe-home"></i>后台</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="dropdown"><i class="fe fe-list"></i>网站</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <!-- <a href="/admin/index/carousel.html" class="dropdown-item">首页轮播图</a> -->
                                    <a href="/admin/news/index.html" class="dropdown-item">新闻公告</a>
                                    <a href="/admin/index/help.html" class="dropdown-item">帮助内容</a>
                                    <a href="/admin/index/contact.html" class="dropdown-item">用户留言</a>
                                    <a href="/admin/index/popup.html" class="dropdown-item">弹窗公告</a>
                                    <a href="/admin/index/group.html" class="dropdown-item">官方交流群</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/account.html" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i>账户</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="/admin/account.html" class="dropdown-item">用户列表</a>
                                    <a href="/admin/account/create.html" class="dropdown-item">添加用户</a>
                                    <a href="/admin/account/profile.html" class="dropdown-item">用户档案</a>
                                    <a href="/admin/account/audit.html" class="dropdown-item">实名认证</a>
                                    <a href="/admin/account/dashboard.html" class="dropdown-item">仪表盘</a>
                                    <a href="/admin/account/promotion.html" class="dropdown-item">推广数据</a>
                                    <?php if(!(empty(app('config')->get('hello.register_audit')) || ((app('config')->get('hello.register_audit') instanceof \think\Collection || app('config')->get('hello.register_audit') instanceof \think\Paginator ) && app('config')->get('hello.register_audit')->isEmpty()))): ?>
                                        <a href="/admin/account/reg_audit.html" class="dropdown-item">注册审核</a>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/market.html" class="nav-link" data-toggle="dropdown"><i class="fe fe-globe"></i>市场</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="/admin/market/index.html" class="dropdown-item">每日行情</a>
                                    <a href="/admin/market/buy.html" class="dropdown-item">买入订单</a>
                                    <a href="/admin/market/sell.html" class="dropdown-item">卖出订单</a>
                                    <a href="/admin/market/report.html" class="dropdown-item">投诉订单</a>
                                    <a href="/admin/market/bonus.html" class="dropdown-item">发放全球分红</a>
                                    <a href="/admin/market/bonus_log.html" class="dropdown-item">全球分红记录</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/store.html" class="nav-link" data-toggle="dropdown"><i class="fe fe-shopping-cart"></i>商城</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="/admin/store.html" class="dropdown-item">实物商城</a>
                                    <a href="/admin/store/machine.html" class="dropdown-item">矿机商城</a>
                                    <a href="/admin/store/prop.html" class="dropdown-item">道具商城</a>
                                    <a href="/admin/store/create.html" class="dropdown-item">添加商品</a>
                                    <a href="/admin/store/order.html" class="dropdown-item">订单列表</a>
                                    <a href="/admin/store/adjust_price.html" class="dropdown-item">批量调整价格</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/machine.html" class="nav-link" data-toggle="dropdown"><i class="fe fe-cpu"></i>矿机</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="/admin/machine/index.html" class="dropdown-item">用户矿机</a>
                                    <a href="/admin/machine/give.html" class="dropdown-item">批量赠送</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/wallet/index.html" class="nav-link" data-toggle="dropdown"><i class="fe fe-slack"></i>资金</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="/admin/wallet/index.html" class="dropdown-item">钱包概览</a>
                                    <a href="/admin/wallet/record.html" class="dropdown-item">流水列表</a>
                                    <a href="/admin/wallet/transfer.html" class="dropdown-item">转账记录</a>
                                    <a href="/admin/wallet/give.html" class="dropdown-item">批量赠送</a>
                                    <a href="/admin/wallet/imtoken.html" class="dropdown-item">imToken</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/event/index.html" class="nav-link" data-toggle="dropdown"><i class="fe fe-grid"></i>插件</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="/admin/event/scratch.html" class="dropdown-item">刮刮卡</a>
                                    <a href="/admin/event/pool.html" class="dropdown-item">共享矿池</a>
                                    <a href="/admin/event/contract.html" class="dropdown-item">链上合约</a>
                                    <a href="/admin/event/funding.html" class="dropdown-item">创业众筹</a>
                                    <a href="/admin/event/ticket.html" class="dropdown-item">票券</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3 my-md-5">
            <div class="container container-padding">
                
<div class="alert alert-info">
	<div><strong>操作流程</strong></div>
	<div>1. 选择【具体日期】，将自动找到这天的实收总手续费，优先从上一次未发送完的记录中找，各级别配置也是</div>
	<div>2. 设置【实收手续费】(可选)</div>
	<div>3. 设置每个等级的用户的分红比例(可选)</div>
	<div>4. 点击【计算分红】</div>
	<div>5. 审阅并核对右边每个用户的实际分红和状态</div>
	<div>6. 勾选要发放的用户，点击【立即发放】</div>
	<div>7. 每次只会发放一页的用户数量，已发过的用户不会再次发放（即使勾选了该用户）</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="dimmer">
					<div class="loader"></div>
					<div class="dimmer-content">
						<form method="get">
							<div class="form-group">
			                    <label class="form-label">具体日期</label>
			                    <input type="date" class="form-control" name="date" value="<?php echo htmlentities(app('request')->get('date')); ?>" />
			                </div>
			                <div class="form-group">
			                    <label class="form-label">实收手续费</label>
			                    <input type="text" class="form-control" name="charge" placeholder="昨天交易实际收入多少手续费" value="<?php echo htmlentities(app('request')->get('charge')); ?>" />
			                </div>
			                <?php if(is_array(app('config')->get('hello.level')) || app('config')->get('hello.level') instanceof \think\Collection || app('config')->get('hello.level') instanceof \think\Paginator): $i = 0; $__LIST__ = app('config')->get('hello.level');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
				                <div class="form-group">
				                    <label class="form-label"><?php echo htmlentities($item['name']); ?>发放比例</label>
				                    <?php if(array_key_exists('lv' . $key, $param)): ?>
				                    	<input type="text" class="form-control" name="lv<?php echo htmlentities($key); ?>" placeholder="0或是不填则表示不发" value="<?php echo htmlentities($param['lv' . $key]); ?>" />
				                    <?php else: ?>
				                    	<input type="text" class="form-control" name="lv<?php echo htmlentities($key); ?>" placeholder="0或是不填则表示不发" value="<?php echo htmlentities((isset($item['bonus']) && ($item['bonus'] !== '')?$item['bonus']:'')); ?>" />
				                    <?php endif; ?>
				                </div>
			                <?php endforeach; endif; else: echo "" ;endif; ?>
			                <div class="text-right">
			                	<button class="btn btn-success" type="submit">计算分红</button>
			                </div>
		                </form>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header">
				<div class="card-title">用户列表</div>
				<div class="card-options">
					<label class="custom-switch">
						<?php if(!empty(app('request')->get('auto'))): ?>
                    		<input type="checkbox" name="auto" class="custom-switch-input" checked="true" />
                    	<?php else: ?>
                    		<input type="checkbox" name="auto" class="custom-switch-input" />
                    	<?php endif; ?>
                    	<span class="custom-switch-indicator"></span>
                    	<span class="custom-switch-description">自动发放</span>
                    </label>
				</div>
			</div>
			<div class="table-responsive">
			    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
			        <thead>
			            <tr>
			            	<th>
								<label class="custom-control custom-checkbox mb-0">
		                            <input type="checkbox" class="custom-control-input choose" />
		                            <span class="custom-control-label"></span>
	                        	</label>
			            	</th>
			                <th>用户账号</th>
			                <th>类型等级</th>
			                <th>是否已发</th>
			                <th>最终发放</th>
			            </tr>
			        </thead>
			        <tbody>
			        	<?php if(!(empty($users) || (($users instanceof \think\Collection || $users instanceof \think\Paginator ) && $users->isEmpty()))): if(is_array($users) || $users instanceof \think\Collection || $users instanceof \think\Paginator): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
							<tr data-type="<?php echo htmlentities($user['type']); ?>" data-username="<?php echo htmlentities($user['username']); ?>" data-money="<?php echo htmlentities($userProfit[$user['type']]); ?>">
								<td>
									<label class="custom-control custom-checkbox mb-0">
										<?php if($user['status'] == '1'): ?>
			                            	<input type="checkbox" class="custom-control-input" disabled="true" />
			                            <?php else: ?>
			                            	<input type="checkbox" class="custom-control-input" />
			                            <?php endif; ?>
			                            <span class="custom-control-label"></span>
		                        	</label>
								</td>
								<td><?php echo htmlentities($user['username']); ?></td>
								<td><?php echo htmlentities(app('config')->get('hello.level')[$user['type']]['name']); ?></td>
								<td>
									<?php if($user['status'] == '1'): ?>
										<span class="status-icon bg-green"></span> <span class="text-green">已发</span>
									<?php else: ?>
										<span class="status-icon bg-secondary"></span> <span class="text-secondary">待发</span>
									<?php endif; ?>
								</td>
								<td><?php echo htmlentities($userProfit[$user['type']]); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?></td>
							</tr>
						<?php endforeach; endif; else: echo "" ;endif; endif; ?>
			        </tbody>
			    </table>
			</div>
			<div class="card-footer text-right">
				<?php if(!(empty($users) || (($users instanceof \think\Collection || $users instanceof \think\Paginator ) && $users->isEmpty()))): ?>
				<div class="fenye float-left">
					<?php echo $users; ?>
				</div>
				<?php endif; ?>
				<button class="btn btn-primary float-right btn-send" type="button">立即发放</button>
			</div>
		</div>
	</div>
</div>

            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center"><?php echo htmlentities(date('Y-m-d g:i a',time())); ?></div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href="."><?php echo htmlentities(app('config')->get('hello.title')); ?></a>. &#28304;&#30721;&#26469;&#33258;&#23567;&#23627;&#28304;&#30721;&#119;&#119;&#119;&#46;&#109;&#50;&#49;&#51;&#46;&#99;&#110;
                </div>
            </div>
        </div>
    </footer>
</div>
<script type="text/javascript" src="/assets/js/require.min.js"></script>
<script type="text/javascript" src="/static/js/global.js?3"></script>

<script type="text/javascript">
var auto = '<?php echo htmlentities(app('request')->get('auto')); ?>';
require(['jquery'], function($){
	$(function(){
		// 选择日期
		$('input[name=date]').on('change', function(){
			var date = $(this).val();
			$('.dimmer').addClass('active');
			$.post('/admin/market/charge', {date: date}, function(res){
				console.log(res);
				$('.dimmer').removeClass('active');
				if (res.code == 200) {
					$('input[name=charge]').val(res.data.charge);
				} else {
					alert(res.message);
					$('input[name=charge]').val('');
				}
			});
		});
		// 计算分红
		$('form').on('submit', function(){
			// 日期
			var date = $('input[name=date]').val();
			if (!date) {
				alert('很抱歉、请选择日期！');
				return false;
			}
			// 手续费
			var charge = $('input[name=charge]').val();
			if (!charge) {
				alert('很抱歉、请填写手续费！');
				return false;
			}
			// 发放比例
			var rate = 0;
			for (var i = 0; i < $('input[name^="lv"]').length; i++) {
				var val = $('input[name^="lv"]').eq(i).val();
				val = val ? parseFloat(val) : 0;
				rate += val;
				if (val < 0) {
					$('input[name^="lv"]').eq(i).focus();
					alert('很抱歉、' + $('input[name^="lv"]').eq(i).attr('name') + '比例不能小于0！')
					return false;
				}
				if (val >= 1) {
					$('input[name^="lv"]').eq(i).focus();
					alert('很抱歉、' + $('input[name^="lv"]').eq(i).attr('name') + '比例不能大于1！')
					return false;
				}
				if (rate >= 1) {
					alert('很抱歉、累计比例不能超过1！');
					return false;
				}
			}
			// 没问题
			return true;
		});
		// 单行勾选
		$('table tbody tr').on('click', function(){
			var ckb = $(this).find('td').eq(0).find('input[type=checkbox]');
			if (!ckb.prop('disabled')) {
				var checked = ckb.prop('checked');
				ckb.prop('checked', !checked);
			}
		});
		// 全选反选
		$('.choose').on('change', function(){
			var checked = $(this).prop('checked');
			$('table tbody input[type=checkbox]:enabled').prop('checked', checked);
		});
		// 立即发放
		$('.btn-send').on('click', function(){
			return ready();
		});
		// 准备发放
		var ready = function(){
			// 日期
			var date = $('input[name=date]').val();
			if (!date) {
				alert('很抱歉、请选择日期！');
				return false;
			}
			// 手续费
			var charge = $('input[name=charge]').val();
			if (!charge) {
				alert('很抱歉、请填写手续费！');
				return false;
			}
			// 发放比例
			var rate = 0, rateArray = [];
			for (var i = 0; i < $('input[name^="lv"]').length; i++) {
				var name = $('input[name^="lv"]').eq(i).attr('name');
				var val = $('input[name^="lv"]').eq(i).val();
				val = val ? parseFloat(val) : 0;
				rate += val;
				if (val < 0) {
					$('input[name^="lv"]').eq(i).focus();
					alert('很抱歉、' + $('input[name^="lv"]').eq(i).attr('name') + '比例不能小于0！')
					return false;
				}
				if (val >= 1) {
					$('input[name^="lv"]').eq(i).focus();
					alert('很抱歉、' + $('input[name^="lv"]').eq(i).attr('name') + '比例不能大于1！')
					return false;
				}
				if (rate >= 1) {
					alert('很抱歉、累计比例不能超过1！');
					return false;
				}
				rateArray[name] = val;
			}
			console.log(date, charge, rateArray);
			// 循环用户
			if ($('table tbody tr').length) {
				send(date, charge, rateArray, $('table tbody tr').eq(0));
			}
			return false;
		}
		// 继续下一页
		var again = function(){
			console.log('again');
			a = $('.pagination .page-item.active').next().find('a');
			if (a && a.length) {
				var href = a.attr('href');
				if (href.indexOf('auto') == -1) {
					var s = href.indexOf('&page=');
					var before = href.substring(0, s);
					var after = href.substr(s);
					href = before + '&auto=true' + after;
					a.attr('href', href);
				}
				window.location.href = href;
			} else {
				alert('恭喜您、全部发放完成！');
			}
		}
		// 发送数据
		var send = function(date, charge, rateArray, tr){
			// 这一行勾选了
			if (tr.find('td').eq(0).find('input[type=checkbox]').prop('checked')) {
				// 级别
				var type = tr.data('type');
				// 账号
				var username = tr.data('username');
				// 金额
				var money = tr.data('money');
				// 比率
				rate = rateArray['lv' + type];
				// 发送
				$.post('/admin/market/send', {
					date: date,
					charge: charge,
					type: type,
					rate: rate,
					username: username,
					money: money,
				}, function(res){
					// 成功
					if (res.code == 200) {
						tr.find('td').eq(0).find('input[type=checkbox]').prop('checked', false).prop('disabled', true);
						tr.find('td').eq(3).find('.bg-secondary').removeClass('bg-secondary').addClass('bg-green');
						tr.find('td').eq(3).find('.text-secondary').removeClass('text-secondary').addClass('text-green').text('已发');
					}
					// 继续
					var next = tr.next();
					if (next.length) {
						send(date, charge, rateArray, next);
					} else {
						if ($('input[name=auto]').prop('checked')) {
							again();
						}
					}
				});
			} else {
				// 继续
				var next = tr.next();
				if (next.length) {
					send(date, charge, rateArray, next);
				} else {
					if ($('input[name=auto]').prop('checked')) {
						again();
					}
				}
			}
		}
		// 自动发放
		if (auto) {
			$('.choose').prop('checked', true);
			$('table tbody input[type=checkbox]:enabled').prop('checked', true);
			ready();
		}
	});
});
</script>

</body>
</html>