<?php /*a:2:{s:61:"C:\Users\lwg\Desktop\2\application\admin\view\event\pool.html";i:1529817000;s:63:"C:\Users\lwg\Desktop\2\application\admin\view\common\world.html";i:1554996932;}*/ ?>
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
    <title>共享矿池</title>
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
                
<form method="get" class="">
	<div class="row">
		<div class="col-md-6 col-lg-3 mb-3">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">用户账号</span>
				</div>
				<input type="text" class="form-control" name="username" value="<?php echo htmlentities(app('request')->get('username')); ?>" />
			</div>
		</div>
		<div class="col-md-6 col-lg-3 mb-3">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">操作类型</span>
				</div>
				<select class="custom-select input-group-text" name="action">
					<option value="">全部</option>
					<?php if(is_array($actions) || $actions instanceof \think\Collection || $actions instanceof \think\Paginator): $i = 0; $__LIST__ = $actions;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;if(is_null(app('request')->get('action')) || app('request')->get('action') == ''): ?>
							<option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($action); ?></option>
						<?php else: if(app('request')->get('action') == $key): ?>
								<option selected="true" value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($action); ?></option>
							<?php else: ?>
								<option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($action); ?></option>
							<?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
			    </select>
			</div>
		</div>
		<div class="col-md-6 col-lg-3 mb-3">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">具体道具</span>
				</div>
				<select class="custom-select input-group-text" name="prop">
					<option value="">全部</option>
					<?php if(is_array($props) || $props instanceof \think\Collection || $props instanceof \think\Paginator): $i = 0; $__LIST__ = $props;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if(is_null(app('request')->get('prop')) || app('request')->get('prop') == ''): ?>
							<option value="<?php echo htmlentities($item['title']); ?>"><?php echo htmlentities($item['title']); ?></option>
						<?php else: if(app('request')->get('prop') == $item['title']): ?>
								<option selected="true" value="<?php echo htmlentities($item['title']); ?>"><?php echo htmlentities($item['title']); ?></option>
							<?php else: ?>
								<option value="<?php echo htmlentities($item['title']); ?>"><?php echo htmlentities($item['title']); ?></option>
							<?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
			    </select>
			</div>
		</div>
		<div class="col-lg-3 mb-3">
			<button class="btn btn-primary w-100" type="submit">立即查询</button>
		</div>
		<div class="col-lg-2 mb-3">
			<button class="btn btn-info w-100" data-toggle="modal" data-target="#pool_config" type="button">矿池配置</button>
		</div>
	</div>
</form>
<div class="card">
	<div class="table-responsive">
	    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
	        <thead>
	            <tr>
	                <th>用户</th>
	                <th>操作</th>
	                <th>当前算力</th>
	                <th>消费货币</th>
	                <th>道具名称</th>
	                <th>奖励算力</th>
	                <th>奖励货币</th>
	                <th>时间</th>
	            </tr>
	        </thead>
	        <tbody>
			<?php if(is_array($logs) || $logs instanceof \think\Collection || $logs instanceof \think\Paginator): $i = 0; $__LIST__ = $logs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?>
				<tr>
					<td><?php echo htmlentities($log['username']); ?></td>
					<td>
						<?php if($log['action'] == '1'): ?>
							领取收益
						<?php else: ?>
							使用道具
						<?php endif; ?>
					</td>
					<td><?php echo htmlentities($log['power']); ?></td>
					<td><?php echo htmlentities($log['spend']); ?></td>
					<td><?php echo htmlentities($log['prop']); ?></td>
					<td>
						<?php if($log['action'] == '1'): ?>
							0
						<?php else: ?>
							<?php echo htmlentities($log['reward']); endif; ?>
					</td>
					<td>
						<?php if($log['action'] == '1'): ?>
							<?php echo htmlentities($log['reward']); else: ?>
							0
						<?php endif; ?>
					</td>
					<td><?php echo htmlentities($log['create_at']); ?></td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
	        </tbody>
	    </table>
	</div>
	<div class="card-footer"><?php echo $logs; ?></div>
</div>
<div class="modal fade" id="pool_config" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="action" value="pool" />
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">矿池配置</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-label">是否开启该功能</label>
								<div class="selectgroup w-50">
									<label class="selectgroup-item">
			                            <input type="radio" name="enable" value="1" class="selectgroup-input" <?php echo !empty($config['enable']) ? 'checked' : ''; ?>/>
			                            <span class="selectgroup-button">开启</span>
			                        </label>
			                        <label class="selectgroup-item">
			                            <input type="radio" name="enable" value="0" class="selectgroup-input" <?php echo !empty($config['enable']) ? '' : 'checked'; ?>/>
			                            <span class="selectgroup-button">关闭</span>
			                        </label>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
				                <label class="form-label">矿池总量</label>
				                <input type="text" class="form-control" name="volume" placeholder="目前矿池总共可以产出的收益总量" value="<?php echo htmlentities($config['volume']); ?>" />
			                </div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
				                <label class="form-label">初始难度(没有任何用，仅作展示)</label>
				                <input type="text" class="form-control" name="complexity" placeholder="实际上没什么用" value="<?php echo htmlentities($config['complexity']); ?>" />
			                </div>
						</div>
						<div class="col-lg-12">
			                <div class="form-group">
				                <label class="form-label">收益比例</label>
				                <div class="input-group">
				                	<div class="input-group-prepend">
										<span class="input-group-text">1点算力每秒钟可得</span>
									</div>
				                	<input type="text" class="form-control" name="percent" placeholder="算力和货币的比例，例如0.0001比1，填0.0001" value="<?php echo htmlentities($config['percent']); ?>" />
				                	<div class="input-group-append">
				                		<span class="input-group-text"><?php echo htmlentities(app('config')->get('hello.unit')); ?></span>
				                	</div>
				                </div>
				                <div class="form-text small text-red">计算公式</div>
				                <div class="form-text small text-red">1 - (已领总矿 / 矿池总量) = 已领比例(保留最多8位小数)</div>
				                <div class="form-text small text-red">用户总算力 * 已等待秒数 * 收益比例 * 已领比例 = 最终收益</div>
			                </div>
						</div>
						<div class="col-lg-12">
			                <div class="form-group">
				                <label class="form-label">时间间隔，每次领矿的时间间隔</label>
				                <div class="input-group">
				                	<input type="text" class="form-control" name="interval" placeholder="单位是秒" value="<?php echo htmlentities($config['interval']); ?>" />
				                	<div class="input-group-append">
				                		<span class="input-group-text">秒</span>
				                	</div>
				                </div>
			                </div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
				                <label class="form-label">背景图片</label>
				                <div class="custom-file">
			                      	<input type="file" class="custom-file-input" name="background" accept="image/*" />
			                      	<label class="custom-file-label">选择图片，不修改就不选</label>
			                    </div>
			                    <?php if(!(empty($config['background']) || (($config['background'] instanceof \think\Collection || $config['background'] instanceof \think\Paginator ) && $config['background']->isEmpty()))): ?>
			                    	<div class="form-text"><img src="<?php echo htmlentities($config['background']); ?>" style="max-height: 10rem;" /></div>
			                    <?php endif; ?>
			                </div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
					<button type="submit" class="btn btn-primary">保存设置</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="prop_config" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<form method="post" enctype="multipart/form-data">
				<input type="hidden" name="action" value="prop" />
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">道具配置</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body p-0 px-2">
					<table class="table table-hover table-outline table-vcenter text-nowrap table-prop">
						<thead>
							<tr>
								<th>名称</th>
								<th>算力</th>
								<th>价格</th>
								<th>每天总限量</th>
								<th>每人限量</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php if(empty($config['prop']) || (($config['prop'] instanceof \think\Collection || $config['prop'] instanceof \think\Paginator ) && $config['prop']->isEmpty())): ?>
							<tr>
								<td><input type="text" class="form-control" name="name[]" /></td>
								<td><input type="text" class="form-control" name="power[]" /></td>
								<td><input type="text" class="form-control" name="price[]" /></td>
								<td><input type="text" class="form-control" name="day[]" /></td>
								<td><input type="text" class="form-control" name="person[]" /></td>
								<td><a href="javascript:;" class="btn-remrow"><i class="fe fe-trash"></i></a></td>
							</tr>
							<?php else: if(is_array($config['prop']) || $config['prop'] instanceof \think\Collection || $config['prop'] instanceof \think\Paginator): $i = 0; $__LIST__ = $config['prop'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
									<tr>
										<td><input type="text" class="form-control" name="name[]" value="<?php echo htmlentities($item['name']); ?>" /></td>
										<td><input type="text" class="form-control" name="power[]" value="<?php echo htmlentities($item['power']); ?>" /></td>
										<td><input type="text" class="form-control" name="price[]" value="<?php echo htmlentities($item['price']); ?>" /></td>
										<td><input type="text" class="form-control" name="day[]" value="<?php echo htmlentities($item['limit']['day']); ?>" /></td>
										<td><input type="text" class="form-control" name="person[]" value="<?php echo htmlentities($item['limit']['person']); ?>" /></td>
										<td><a href="javascript:;" class="btn-remrow"><i class="fe fe-trash"></i></a></td>
									</tr>
								<?php endforeach; endif; else: echo "" ;endif; endif; ?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary btn-addrow">再添加一行</button>
					<button type="submit" class="btn btn-primary">保存设置</button>
				</div>
			</form>
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
require(['jquery'], function($){
	$(function(){
		$('.btn-addrow').on('click', function(){
			var html = $('.table-prop tbody tr').last().html();
			$('.table-prop tbody').append('<tr>' + html + '</tr>');
		});
		$('.table').on('click', '.btn-remrow', function(){
			$(this).parents('tr').remove();
		});
	});
});
</script>

</body>
</html>