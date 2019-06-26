<?php /*a:2:{s:75:"D:\phpstudy\PHPTutorial\WWW\test2\application\api\view\funding\welcome.html";i:1561514896;s:74:"D:\phpstudy\PHPTutorial\WWW\test2\application\api\view\common\default.html";i:1561450981;}*/ ?>
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
    <title>创业众筹</title>
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
.projects-image {
	width: 118px;height: 90px;
}
.projects-title {
	font-size: 0.95rem;
	font-weight: bold;
}
.media-body {
	position: relative;
}
.projects-info {
	position: absolute;left: 0;bottom: 0;right: 0;
}
.progress {
	position: absolute;left: 0;bottom:2rem;right: 2.8rem;
}
.progress-label {
	position: absolute;right: 0rem;bottom: 1.5rem;
}
.w-86 {
    width: 86% !important;
}
a.media {
	height: 90px;
	text-decoration: none;
}
.jeishao {
	text-indent: 2rem;
}
.meixin {
	margin-top: -.4rem;
}
.meixin span {
	font-size: 1.3rem;
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
                    <img src="<?php echo htmlentities(app('config')->get('hello.logo')); ?>" class="header-brand-img" alt="tabler logo">
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="nav-item d-xs-flex" style="display: none !important;">
                            <?php if(app('session')->get('platform') != 'app'): if(!(empty(app('config')->get('hello.appurl')) || ((app('config')->get('hello.appurl') instanceof \think\Collection || app('config')->get('hello.appurl') instanceof \think\Paginator ) && app('config')->get('hello.appurl')->isEmpty()))): if($platform == 'android'): ?>
                            <a href="<?php echo htmlentities(app('config')->get('hello.appurl')); ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-app-download">APP 下载</a>
                            <?php endif; else: ?>
                            <a href="javascript:;" class="btn btn-sm btn-outline-primary btn-app-download" data-toggle="tooltip" data-original-title="敬请期待">APP 下载</a>
                            <?php endif; endif; ?>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:;" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar me-avatar" style="background-image: url(<?php echo avatar(app('session')->get('user.profile.avatar'), app('session')->get('user.profile.idcard')); ?>);"><span class="avatar-status bg-green"></span></span>
                                <span class="ml-2 d-none d-lg-block">
                                    <span class="text-default"><?php echo htmlentities(app('session')->get('user.profile.nickname')); ?></span>
                                    <small class="text-muted d-block mt-1"><?php echo htmlentities(app('config')->get('hello.level')[app('session')->get('user.account.type')]['name']); ?></small>
                                </span>
                            </a>
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
                                <a href="/" class="nav-link<?php echo app('request')->path()=='account' || app('request')->path() == ''?' active' : ''; ?>">
                                    <span><i class="fe fe-home"></i></span>
                                    <span>首页</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/market" class="nav-link<?php echo app('request')->path()=='market'?' active' : ''; ?>">
                                    <span><i class="fe fe-globe"></i></span>
                                    <span>市场</span>
                                </a>
                            </li>
                            <li class="nav-item d-md-block d-lg-block">
                                <a href="/account" class="nav-link<?php echo app('request')->path()=='help'?' active' : ''; ?>">
                                    <span><i class="fe fe-user"></i></span>
                                    <span>我的</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="my-3 my-md-5">
            <div class="container container-padding">
                
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<h5 class="font-weight-light">众筹介绍</h5>
			<div class="text-muted jeishao">
				<div>共享人人财富  成就人人梦想</div>
				<div><?php echo htmlentities(app('config')->get('hello.title')); ?>的每个会员可发起项目众筹获得其他会员的美币支持，发起人在项目成功后用产品或服务回馈支持自己的会员，支持其他会员发起的众筹项目越多，自己发布的众筹项目会得到10倍的支持和优先支持权。</div>
			</div>
			<h5 class="font-weight-light mt-3 mb-4">我的情况</h5>
			<div class="alert alert-info">
				<div class="media">
					<img class="align-self-start w-7 h-7 mr-3" src="<?php echo avatar(app('session')->get('user.profile.avatar'), app('session')->get('user.profile.idcard')); ?>" alt="Generic placeholder image" />
					<div class="media-body">
						<h5 class="mt-0 mb-0 clearfix">
							<span class="float-left"><?php echo htmlentities(app('session')->get('user.profile.nickname')); ?></span>
							<div class="meixin ml-1 float-left">
								<?php if(is_array(app('config')->get('hello.funding.level')) || app('config')->get('hello.funding.level') instanceof \think\Collection || app('config')->get('hello.funding.level') instanceof \think\Paginator): $i = 0; $__LIST__ = app('config')->get('hello.funding.level');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($myTotalMoney >= $item[0]): ?>
										<span class="text-blue">ღ</span>
									<?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
						</h5>
						<?php if($myInvestCount <= '0'): ?>
							<div class="text-muted mt-2">您目前尚未参与任何项目</div>
						<?php else: ?>
							<div class="text-muted mt-2 small">共为 <b class="text-red"><?php echo htmlentities($myInvestCount); ?></b> 个项目支持了 <b class="text-green"><?php echo htmlentities($myTotalMoney); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?></b></div>
						<?php endif; if($maxTarget > '0'): ?>
							<div class="text-muted mt-2 small">您当前可发起筹资最多不超过<?php echo htmlentities($maxTarget); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?>的项目</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<h5 class="font-weight-light mt-3">参与众筹</h5>
			<table class="table card-table table-striped table-vcenter">
				<thead>
					<tr>
						<th>支持额度<?php echo htmlentities(app('config')->get('hello.unit')); ?></th>
						<th>奖章(美心)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1000-4999</td>
						<td>ღ</td>
					</tr>
					<tr>
						<td>5000-9999</td>
						<td>ღღ</td>
					</tr>
					<tr>
						<td>10000-49999</td>
						<td>ღღღ</td>
					</tr>
					<tr>
						<td>50000-99999</td>
						<td>ღღღღ</td>
					</tr>
					<tr>
						<td>100000+</td>
						<td>ღღღღღ</td>
					</tr>
				</tbody>
			</table>
			<h5 class="font-weight-light mt-2">发起众筹</h5>
			<table class="table card-table table-striped table-vcenter">
				<thead>
					<tr>
						<th>众筹额度<?php echo htmlentities(app('config')->get('hello.unit')); ?></th>
						<th>发起条件</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>10000-49999</td>
						<td>ღ</td>
					</tr>
					<tr>
						<td>50000-99999</td>
						<td>ღღ</td>
					</tr>
					<tr>
						<td>100000-499999</td>
						<td>ღღღ</td>
					</tr>
					<tr>
						<td>500000-999999</td>
						<td>ღღღღ</td>
					</tr>
					<tr>
						<td>1000000+</td>
						<td>ღღღღღ</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-footer text-right">
		<?php if($maxTarget <= '0'): ?>
			<a href="/funding.html" class="btn btn-success">我知道了</a>
		<?php else: ?>
			<a href="/funding/publish.html" class="btn btn-success">我知道了</a>
		<?php endif; ?>
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
var frame = 'welcome';
</script>
<script src="/static/js/funding.js"></script>

</body>
</html>