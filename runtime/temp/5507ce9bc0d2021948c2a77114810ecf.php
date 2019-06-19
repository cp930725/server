<?php /*a:2:{s:66:"D:\wwwroot\kj.hmyzyw.com\application\index\view\event\scratch.html";i:1531316426;s:65:"D:\wwwroot\kj.hmyzyw.com\application\index\view\common\world.html";i:1532374780;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="format-detection" content="telephone=no, email=no"/>
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
    <link rel="stylesheet" href="/static/css/global.css?3" />
    <title>刮刮乐</title>
    <style>
    @media (max-width: 360px) {
        .icon-group {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .icon-news {
            display: none !important;
        }
    }
    </style>
    
<style>
.scratch {
	position: relative;
	height: 10rem;
	background-color: #467fcf;
	background-image: url(/static/image/ggl.jpg);
	background-size: auto 100%;
	border-radius: .5rem;
	box-shadow: 1px 1px 1px #999;
	/*background-position: right center;*/
}
.scratch-reward {
	position: absolute;left: 0px;top: 0px;
	width: 100%;height: 100%;text-align: center;
	color: #fff;font-size: 1.2rem;line-height: 50px;
	background-color: #333;
	border-radius: 5px;
}
.scratch_viewport {
	position: absolute;
	left: 50%; top: 50%;
	width: 200px; height: 50px;
	margin: -25px 0 0 -100px;
 	z-index: 0;overflow: hidden;
}
.scratch_picture-under {
	position: absolute;top: 0;left: 0;
	width: 100%;height: 100%; border-radius: 5px;
	/*display: block;*/
	z-index: -1;
	display: none;
}
.scratch_viewport canvas {
	position: relative;
	width: 100%; height: auto;
	border-radius: 5px;
	z-index: 1;
}
.scratch_go {
	position: absolute;left: 0px;top: 0px;
	width: 100%;height: 100%;
	z-index: 5;
	line-height: 2.2;
	font-size: 1rem;
	/*background-color: #9fa1a0;*/
}
.scratch-tips {
	position: absolute;right: 0.5rem;bottom: 0.5rem;
	text-shadow: 1px 1px 1px #fff;
}
.scratch-reset {
	position: absolute;left: 50%;top: 65px;
	margin-left: 70px;
	display: none;
}
.scratch-reset i {
	color: white;font-size: 2rem;
}
@-webkit-keyframes scratch_viewport-out {
	0% {
		transform: translateX(0px) scale3d(1, 1, 1);
	}
	100% {
		transform: translateX(-20px) scale3d(.8, .8, .8);
	}
}
.scratch-again .scratch_viewport {
	animation: scratch_viewport-out 1s both;
}
@-webkit-keyframes scratch-reset-init {
	0% {
		opacity: 0;
		transform: scale3d(0, 0, 0) rotate(0deg);
	}
	100% {
		opacity: 1;
		transform: scale3d(1, 1, 1) rotate(360deg);
	}
}
.scratch-again .scratch-reset {
	animation: scratch-reset-init 1s both;
	display: block;
}
.modal-reward .modal-content {
	background: transparent;
}
.modal-reward .reward-text {
	position: absolute;
	left: 0;top: 62%;width: 100%;
	text-align: center;
}
.modal-reward .reward-close {
	position: absolute;left: 0;width: 100%;bottom: 0;
	height: 100px;
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
                    <a class="header-brand" href="/account.html"><img src="/static/image/logo.png" class="header-brand-img" alt="tabler logo"></a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="nav-item d-xs-flex icon-group">
                            <a data-toggle="modal" data-target="#modal-group" style="color: #c7a85e;">官方交流群</a>
                        </div>
                        <div class="nav-item d-xs-flex" style="display: none !important;">
                            <?php if(app('session')->get('platform') != 'app'): if(!(empty(app('config')->get('hello.appurl')) || ((app('config')->get('hello.appurl') instanceof \think\Collection || app('config')->get('hello.appurl') instanceof \think\Paginator ) && app('config')->get('hello.appurl')->isEmpty()))): if($platform == 'android'): ?>
                                    <a href="<?php echo htmlentities(app('config')->get('hello.appurl')); ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-app-download">APP 下载</a>
                                <?php endif; else: ?>
                                <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-app-download" data-toggle="tooltip" data-original-title="敬请期待">APP 下载</a>
                            <?php endif; endif; ?>
                        </div>
                        <div class="d-xs-flex icon-news">
                            <a class="nav-link icon" href="/news.html"><i class="fe fe-bell"></i></a>
                        </div>
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar me-avatar" style="background-image: url(<?php echo avatar(app('session')->get('user.profile.avatar'), app('session')->get('user.profile.idcard')); ?>);"><span class="avatar-status bg-green"></span></span>
                                <span class="ml-2 d-none d-lg-block">
                                    <span class="text-default"><?php echo htmlentities(app('session')->get('user.profile.nickname')); ?></span>
                                    <small class="text-muted d-block mt-1"><?php echo htmlentities(app('config')->get('hello.level')[app('session')->get('user.account.type')]['name']); ?></small>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="/account/profile.html">
                                    <i class="dropdown-icon fe fe-user"></i> 个人资料
                                </a>
                                <a class="dropdown-item" href="/account/reset.html">
                                    <i class="dropdown-icon fe fe-lock"></i> 修改密码
                                </a>
                                <a class="dropdown-item" href="/account/authen.html">
                                    <i class="dropdown-icon fe fe-shield"></i> 实名认证
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/help.html">
                                    <i class="dropdown-icon fe fe-help-circle"></i> 帮助文档
                                </a>
                                <a class="dropdown-item" href="/signout.html">
                                    <i class="dropdown-icon fe fe-log-out"></i> 退出登录
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a> -->
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <!-- <div class="col-lg-3 ml-auto header-search-div">
                        <form class="input-icon my-3 my-lg-0">
                            <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                            <div class="input-icon-addon">
                                <i class="fe fe-search"></i>
                            </div>
                        </form>
                    </div> -->
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="/account.html" class="nav-link<?php echo app('request')->path()=='account' || app('request')->path() == ''?' active' : ''; ?>">
                                    <span><i class="fe fe-home"></i></span>
                                    <span>首页</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/team.html" class="nav-link<?php echo app('request')->path()=='team'?' active' : ''; ?>">
                                    <span><i class="fe fe-users"></i></span>
                                    <span>团队</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/market.html" class="nav-link<?php echo app('request')->path()=='market'?' active' : ''; ?>">
                                    <span><i class="fe fe-globe"></i></span>
                                    <span>市场</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/machine.html" class="nav-link<?php echo app('request')->path()=='machine'?' active' : ''; ?>">
                                    <span><i class="fe fe-cpu"></i></span>
                                    <span>矿机</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/store.html" class="nav-link<?php echo app('request')->path()=='store'?' active' : ''; ?>">
                                    <span><i class="fe fe-shopping-cart"></i></span>
                                    <span>商城</span>
                                </a>
                            </li>
                            <li hidden class="nav-item d-md-block d-lg-block">
                                <a href="/help.html" class="nav-link<?php echo app('request')->path()=='help'?' active' : ''; ?>">
                                    <span><i class="fe fe-help-circle"></i></span>
                                    <span>帮助</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="my-3 my-md-5">
            <div class="container container-padding">
                
<div class="wrapper mb-3">
	<div class="scratch">
		<?php if($myChance == '-1'): ?>
			<div class="scratch-count p-2 text-white">机会无限，试试运气吧！</div>
		<?php else: ?>
			<div class="scratch-count p-2 text-white">您还剩余 <span class="badge badge-dark myChance"><?php echo htmlentities($myChance); ?></span> 次机会</div>
		<?php endif; ?>
		<div class="scratch_viewport">
			<div hidden class="scratch-reward">抽奖中...</div>
			<!-- result picture -->
			<canvas id="js-scratch-canvas"></canvas>
		</div>
		<div class="scratch-reset"><i class="fa fa-rotate-right"></i></div>
		<div class="scratch-tips text-blue"><a class="text-blue" href="/team/inviter.html">邀请朋友加入获得更多的机会</a></div>
	</div>
</div>
<div class="card card-myrewards">
	<div class="card-header">
		<div class="card-title f1">我的奖品</div>
		<div class="card-options">
			<a href="#" class="card-options-collapse mr-1" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
		</div>
	</div>
	<div class="card-body o-hidden p-0">
		<table class="table table-hover table-outline table-vcenter text-nowrap card-table">
			<tbody>
				<?php if(is_array($myRewardLog) || $myRewardLog instanceof \think\Collection || $myRewardLog instanceof \think\Paginator): $i = 0; $__LIST__ = $myRewardLog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
				<tr id="my<?php echo htmlentities($item['id']); ?>" reward="<?php echo htmlentities($item['reward_type']); ?>">
					<td class="text-left">
						<div class="small"><?php echo htmlentities($item['reward']); ?></div>
						<div class="small"><?php echo htmlentities($item['date']); ?></div>
					</td>
					<td>
						<?php switch($item['status']): case "1": ?>
								<span class="status-icon bg-success"></span> <small>已发货</small>
							<?php break; case "2": ?>
								<span class="status-icon bg-warning"></span> <small>待发货</small>
							<?php break; case "0": ?>
								<span class="status-icon bg-secondary"></span> <small>待提货</small>
							<?php break; endswitch; ?>
					</td>
					<td class="text-right">
						<?php if($item['status'] == '0'): ?>
							<button class="btn btn-secondary btn-sm btn-pickup">提货</button>
						<?php else: switch($item['reward_type']): case "1": ?>
									<a class="btn btn-secondary btn-sm" href="/machine.html">查看</a>
								<?php break; case "8": ?>
									<a class="btn btn-secondary btn-sm" href="/wallet/record.html">查看</a>
								<?php break; default: ?>
									<button class="btn btn-secondary btn-sm btn-look">查看</button>
							<?php endswitch; endif; ?>
					</td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="card card-result">
	<div class="card-header">
		<div class="card-title f1">中奖名单</div>
		<div class="card-options">
			<a href="#" class="card-options-collapse mr-1" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
		</div>
	</div>
	<div class="card-body o-hidden pt-0 pr-3 pb-0 pl-3" style="height: 9.7rem;">
		<ul class="list-unstyled list-separated namelist">
		</ul>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<div class="card-title f1">活动规则</div>
	</div>
	<div class="card-body pt-3 pr-3 pb-3 pl-0">
		<ol class="pl-6">
			<?php if(is_array(app('config')->get('hello.event.scratch.rule')) || app('config')->get('hello.event.scratch.rule') instanceof \think\Collection || app('config')->get('hello.event.scratch.rule') instanceof \think\Paginator): $i = 0; $__LIST__ = app('config')->get('hello.event.scratch.rule');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$text): $mod = ($i % 2 );++$i;?>
			<li><?php echo htmlentities($text); ?></li>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</ol>
		<!-- 1. -->
	</div>
</div>
<div class="modal modal-pickup" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="margin-top: -100px;">
			<div class="modal-header">
				<h5 class="modal-title">申请提货</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="您的姓名" />
                </div>
				<div class="form-group">
                    <input type="tel" class="form-control" name="mobile" placeholder="手机号码" maxlength="11" />
                </div>
                <div class="form-group">
                	<div class="row gutters-xs">
                		<div class="col">
                			<select name="province" class="form-control custom-select">
								<option value="">省份</option>
                            </select>
                		</div>
                		<div class="col">
                			<select name="city" class="form-control custom-select">
								<option value="">城市</option>
                            </select>
                		</div>
                		<div class="col">
                			<select name="county" class="form-control custom-select">
								<option value="">区县</option>
                            </select>
                		</div>
                	</div>
                </div>
                <div class="form-group">
                    <input type="address" class="form-control" name="address" placeholder="详细地址" />
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary btn-pickup-post">提交申请</button>
			</div>
		</div>
	</div>
</div>
<div class="modal modal-look" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content" style="margin-top: -100px;">
			<div class="modal-header">
				<h5 class="modal-title">发货信息</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<h5>收货信息：</h5>
				<div class="shouhuo"></div>
				<h5 class="mt-2">发货信息：</h5>
				<div class="fahuo">预计3天内到账</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-reward" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<img src="/static/image/reward.png" />
				<div class="reward-text text-danger">
					<p>恭喜您获得</p>
					<p><strong></strong></p>
				</div>
			</div>
			<a class="reward-close" data-dismiss="modal"></a>
		</div>
	</div>
</div>

            </div>
        </div>
    </div>
    <footer class="footer d-xs-none d-sm-none d-lg-block">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center"><?php echo htmlentities(date('Y-m-d g:i a',time())); ?></div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2018 <a href="."><?php echo htmlentities(app('config')->get('hello.title')); ?></a>. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
<div class="modal fade modal-group" id="modal-group" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">官方交流群</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $group['content']; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">我知道了</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/assets/js/require.min.js"></script>
<script type="text/javascript" src="/static/js/global.js?3"></script>

<script type="text/javascript" src="/static/js/area.js"></script>
<script type="text/javascript" src="/static/js/event_scratch.js?3"></script>
<script type="text/javascript">
var rewards = JSON.parse('<?php echo $rewards; ?>');
</script>

</body>
</html>