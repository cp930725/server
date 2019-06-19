<?php /*a:2:{s:75:"D:\phpstudy\PHPTutorial\WWW\test\application\index\view\funding\detail.html";i:1529742390;s:73:"D:\phpstudy\PHPTutorial\WWW\test\application\index\view\common\world.html";i:1555177054;}*/ ?>
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
    <title><?php echo htmlentities($fund['title']); ?></title>
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
.goods .card .image {
	max-height: 12.5rem;
	overflow: hidden;
}
.card-content .card-body p {
	margin-bottom: .3rem;
}
.card-content .card-body p:last-child {
	margin-bottom: 0px;
}
.w-65 {
    width: 65% !important;
}
.project-status {
	position: absolute;right: 1rem;bottom: 1rem;
}
.meixin {
	margin-top: -.2rem;
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
                
<div class="row">
	<div class="col-md-6">
		<div class="card p-3">
			<a href="javascript:;" class="mb-3 text-center image">
				<img src="/upload/<?php echo htmlentities($fund['image']); ?>" class="rounded" />
			</a>
			<div class="d-flex align-items-center px-2">
				<?php if(!(empty($owner) || (($owner instanceof \think\Collection || $owner instanceof \think\Paginator ) && $owner->isEmpty()))): ?>
					<div class="avatar avatar-md mr-3" style="background-image: url(<?php echo avatar($owner['profile']['avatar'], $owner['profile']['idcard']); ?>);"></div>
				<?php else: ?>
					<div class="avatar avatar-md mr-3" style="background-image: url(/static/image/icon.png);"></div>
				<?php endif; ?>
				<div class="w-65">
					<div><?php echo htmlentities($fund['title']); ?></div>
					<?php if(!(empty($owner) || (($owner instanceof \think\Collection || $owner instanceof \think\Paginator ) && $owner->isEmpty()))): ?>
						<small class="text-muted"><?php echo htmlentities($owner['profile']['nickname']); ?></small>
					<?php else: ?>
						<small class="d-block text-muted">官方发布</small>
					<?php endif; ?>
				</div>
			</div>
			<div class="text-muted text-right project-status">
				<?php if($fund['status'] == '3'): ?>
					<div class="text-green over-status">已结束</div>
				<?php else: ?>
					<div hidden class="text-green over-status">已结束</div>
					<div hidden class="expire_at">
						<small>剩余</small>
						<div class="text-green countdown"></div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="card p-3">
			<div class="row">
				<div class="col text-muted text-center">
					<div class="small">目标金额</div>
					<div class="mt-1"><?php echo htmlentities(money($fund['target'])); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?></div>
				</div>
				<div class="col text-green text-center">
					<div class="small">当前金额</div>
					<div class="h4 mt-1 mb-0"><?php echo htmlentities(money($fund['current'])); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?></div>
				</div>
				<div class="col text-muted text-center">
					<div class="small">支持人数</div>
					<div class="mt-1"><?php echo htmlentities(money($fund['people'])); ?></div>
				</div>
			</div>
			<div class="progress progress-xs mt-2">
				<?php if($fund['current'] >= $fund['target']): ?>
					<div class="progress-bar bg-green" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
				<?php else: ?>
                	<div class="progress-bar bg-green" role="progressbar" style="width: <?php echo floor($fund['current']/$fund['target']*100); ?>%" aria-valuenow="<?php echo floor($fund['current']/$fund['target']*100); ?>" aria-valuemin="0" aria-valuemax="100"></div>
				<?php endif; ?>
            </div>
		</div>
		<?php if($fund['status'] != 3): if($fund['expire_at'] < $now): if(app('session')->get('user.account.username') == $fund['owner']): ?>
					<div class="row mb-3 gutters-xs">
						<div class="col">
							<a class="btn btn-secondary btn-block" href="/funding/edit/<?php echo htmlentities($fund['id']); ?>.html">编辑项目</a>
						</div>
						<div class="col">
							<button class="btn btn-danger btn-block btn-go-over">结束项目</button>
						</div>
					</div>
				<?php endif; else: ?>
				<div class="row mb-3 gutters-xs">
					<div class="col">
						<button class="btn btn-green btn-block" data-toggle="modal" data-target="#modal-invest">立即支持</button>
					</div>
					<?php if(app('session')->get('user.account.username') == $fund['owner']): ?>
						<div class="col">
							<a class="btn btn-secondary btn-block" href="/funding/edit/<?php echo htmlentities($fund['id']); ?>.html">编辑项目</a>
						</div>
						<div class="col">
							<button class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-over">结束项目</button>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; endif; ?>
		<div class="card">
			<div class="card-title f1 pl-5 pt-5 mb-0 font-weight-bold">支持记录</div>
			<div class="card-body">
				<ul class="timeline mb-0"></ul>
			</div>
			<div hidden class="card-footer text-center more">点击加载更多</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card card-content">
			<div class="card-title f1 pl-5 pt-5 mb-0 font-weight-bold">项目介绍</div>
			<div class="card-body">
				<?php if(!(empty($owner) || (($owner instanceof \think\Collection || $owner instanceof \think\Paginator ) && $owner->isEmpty()))): ?>
				<div class="alert alert-info">
					<div class="media">
						<img class="align-self-start w-7 h-7 mr-3" src="<?php echo avatar($owner['profile']['avatar'], $owner['profile']['idcard']); ?>" alt="Generic placeholder image" />
						<div class="media-body">
							<h5 class="mt-0 mb-0 clearfix">
								<span class="float-left"><?php echo htmlentities($owner['profile']['nickname']); ?></span>
								<div class="meixin ml-1 float-left">
									<?php if(is_array(app('config')->get('hello.funding.level')) || app('config')->get('hello.funding.level') instanceof \think\Collection || app('config')->get('hello.funding.level') instanceof \think\Paginator): $i = 0; $__LIST__ = app('config')->get('hello.funding.level');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($myTotalMoney >= $item[0]): ?>
											<span class="text-blue">ღ</span>
										<?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</h5>
							<?php if($myInvestCount <= '0'): ?>
								<div class="text-muted mt-2">目前尚未参与任何项目</div>
							<?php else: ?>
								<div class="text-muted mt-2 small">共为 <b class="text-red"><?php echo htmlentities($myInvestCount); ?></b> 个项目支持了 <b class="text-green"><?php echo htmlentities($myTotalMoney); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?></b></div>
							<?php endif; ?>
							<a href="tel:<?php echo htmlentities($owner['account']['username']); ?>" class="btn btn-secondary btn-sm mt-2"><i class="fe fe-phone"></i> 联系我</a>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php echo $fund['content']; ?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-invest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">支持额度</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mb-0">
					<label class="text-muted small form-label font-weight-light text-center mb-2">请输入您想支持的额度</label>
					<div class="row gutters-xs">
						<span class="col-auto">
							<button class="btn btn-secondary btn-jiajian" data-value="-1" type="button"><i class="fe fe-minus"></i></button>
						</span>
						<div class="col">
							<div class="input-group">
								<input type="text" class="form-control text-center" name="money" placeholder="0" />
								<span class="input-group-append" id="basic-addon2">
			                        <span class="input-group-text"><?php echo htmlentities(app('config')->get('hello.unit')); ?></span>
			                    </span>
							</div>
						</div>
						<span class="col-auto">
							<button class="btn btn-secondary btn-jiajian" data-value="1" type="button"><i class="fe fe-plus"></i></button>
						</span>
					</div>
					<div class="form-group mt-2">
						<label class="text-muted small form-label font-weight-light text-center">请输入您的安全密码</label>
						<input type="password" class="form-control" name="safeword" placeholder="安全密码" />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary btn-invest">确认提交</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-over" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">项目结算</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mb-0">
					<div class="form-group mt-2">
						<label class="text-muted small form-label font-weight-light text-center">请输入您的安全密码</label>
						<input type="password" class="form-control" name="safeword" placeholder="安全密码" />
					</div>
					<div class="text-green font-weight-light text-center mt-2">您将获得 <strong><?php echo money($fund['current']-$fund['current']*$charge); ?></strong> <?php echo htmlentities(app('config')->get('hello.unit')); ?></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary btn-over">确认提交</button>
			</div>
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
                    Copyright © 2018 <a href="."><?php echo htmlentities(app('config')->get('hello.title')); ?></a>.&#28304;&#30721;&#26469;&#33258;&#23567;&#23627;&#28304;&#30721;&#119;&#119;&#119;&#46;&#109;&#50;&#49;&#51;&#46;&#99;&#110;
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

<script>
var frame = 'detail', id = '<?php echo htmlentities($fund['id']); ?>', expire_at = '<?php echo htmlentities($fund['expire_at']); ?>';
</script>
<script src="/static/js/funding.js?6"></script>

</body>
</html>