<?php /*a:2:{s:71:"/Applications/MAMP/htdocs/gec/application/index/view/machine/index.html";i:1531144489;s:70:"/Applications/MAMP/htdocs/gec/application/index/view/common/world.html";i:1532374779;}*/ ?>
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
    <title>数字引擎</title>
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
#speed {
    position: absolute;right: 0rem;top: .45rem;
}
@media (max-width: 640px) {
    .o-auto {
        max-height: 20rem;
    }
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
    <div class="col-lg-6">
        <?php if(empty($machines) || (($machines instanceof \think\Collection || $machines instanceof \think\Paginator ) && $machines->isEmpty())): ?>
            <div class="alert alert-primary alert-dismissible">
                <button data-dismiss="alert" class="close"></button>
                <h4>很抱歉</h4>
                <p>您现在还没有任何在运行中的引擎，这意味着您与数字货币的世界正在并步前行。</p>
                <p>是否前往商城购买？</p>
                <div class="btn-list">
                    <a href="/store.html" class="btn btn-success">好的</a>
                    <button class="btn btn-secondary" data-dismiss="alert" type="button">不，我再想想</button>
                </div>
            </div>
        <?php else: ?>
            <div class="card p-3">
                <div class="d-flex">
                    <div class="text-dark"><i class="fe fe-activity"></i> <b><?php echo htmlentities($profit); ?></b> <?php echo htmlentities(app('config')->get('hello.unit')); ?></div>
                    <button class="btn btn-secondary btn-sm ml-auto btn-profit">一键收矿</button>
                </div>
                <div class="card-body p-0 position-relative">
                    <div class="small mt-2">随机区块：</div>
                    <div id="hash" class="text-muted small mt-2" style="word-break: break-word;">-</div>
                    <div id="speed" class="text-green"><?php echo htmlentities($power); ?>Ghs</div>
                </div>
            </div>
            <div class="card">
                <div class="card-body p-3 o-auto">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th>引擎</th>
                                <th hidden class="d-sm-table-cell d-md-table-cell d-lg-table-cell">收益</th>
                                <th class="text-right pr-4">状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($running) || $running instanceof \think\Collection || $running instanceof \think\Paginator): $i = 0; $__LIST__ = $running;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$machine): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td>
                                    <div class="text-dark mb-1 small"><span class="tag">#<?php echo htmlentities($machine['mid']); ?></span> <?php echo htmlentities($machine['name']); ?></div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-<?php echo htmlentities($machine['color']); ?>" role="progressbar" style="width: <?php echo htmlentities($machine['rate']); ?>%" aria-valuenow="<?php echo htmlentities($machine['rate']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="small"><strong><?php echo htmlentities(app('config')->get('hello.unit')); ?></strong>: <span class="text-<?php echo htmlentities($machine['color']); ?>"><?php echo htmlentities(money($machine['profit'])); ?></span>/HM</div>
                                </td>
                                <td hidden class="d-sm-table-cell d-md-table-cell d-lg-table-cell">
                                    <div><?php echo htmlentities(money($machine['profit'])); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?></div>
                                    <div class="small text-muted"><?php echo htmlentities($machine['profit_at']); ?></div>
                                </td>
                                <td align="right">
                                    <span class="stamp stamp-sm bg-info px-3">
                                        <i class="fa fa-spinner"></i>
                                        <!-- <small>运行中</small> -->
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <?php if(!(empty($expire) || (($expire instanceof \think\Collection || $expire instanceof \think\Paginator ) && $expire->isEmpty()))): ?>
            <div class="card">
                <div class="card-body p-3 o-auto">
                    <!-- <div class="text-center small mb-0" data-toggle="collapse" data-target="#expireTable">查看已过期的引擎</div> -->
                    <div class="text-center small mb-2">已过期的引擎</div>
                    <table id="expireTable" class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <?php if(is_array($expire) || $expire instanceof \think\Collection || $expire instanceof \think\Paginator): $i = 0; $__LIST__ = $expire;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$machine): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td>
                                <div class="text-dark mb-1 small"><span class="tag">#<?php echo htmlentities($machine['mid']); ?></span> <?php echo htmlentities($machine['name']); ?></div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-<?php echo htmlentities($machine['color']); ?>" role="progressbar" style="width: <?php echo htmlentities($machine['rate']); ?>%" aria-valuenow="<?php echo htmlentities($machine['rate']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td hidden class="d-sm-table-cell d-md-table-cell d-lg-table-cell">
                                <div><?php echo htmlentities(money($machine['profit'])); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?></div>
                                <div class="small text-muted"><?php echo htmlentities($machine['profit_at']); ?></div>
                            </td>
                            <td align="right">
                                <span class="stamp stamp-sm bg-yellow px-3">
                                    <i class="fa fa-minus-circle"></i>
                                    <!-- <small>已过期</small> -->
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
            </div>
            <?php endif; endif; ?>
    </div>
    <?php if(!(empty($clocks) || (($clocks instanceof \think\Collection || $clocks instanceof \think\Paginator ) && $clocks->isEmpty()))): ?>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body p-3">
                <ul class="timeline">
                    <?php if(is_array($clocks) || $clocks instanceof \think\Collection || $clocks instanceof \think\Paginator): $i = 0; $__LIST__ = $clocks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clock): $mod = ($i % 2 );++$i;?>
                    <li class="timeline-item pl-5">
                        <div class="timeline-badge bg-info"></div>
                        <div>
                            <div class="small"><span class="tag">#<?php echo htmlentities($clock['mid']); ?></span> <?php echo htmlentities($clock['name']); ?></div>
                            <small class="d-block text-muted"><?php echo htmlentities($clock['create_at']); ?></small>
                        </div>
                        <div class="timeline-time text-green mt-3">+<?php echo htmlentities(money($clock['money'])); ?></div>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
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

<script type="text/javascript">
require(['jquery'], function($){
    var randomStr = function(){
        var array = [];
        for (var i = 97; i <= 122; i++) {
            array.push(String.fromCharCode(i));
        }
        for (var i = 0; i < 10; i++) {
            array.push(i);
        }
        var string = '';
        for (var i = 0; i < 32; i++) {
            string += array[Math.floor(Math.random()*array.length)];
        }
        return string;
    }
    $(function(){
        $('#hash').text(randomStr());
        setInterval(function(){
            $('#hash').text(randomStr());
        }, 100);
        $('.btn-profit').on('click', function(){
            if ($(this).hasClass('btn-loading')) {
                return false;
            }
            $(this).addClass('btn-loading');
            ajax(api.machine.profit, {}, function(res){
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
</script>

</body>
</html>