<?php /*a:2:{s:69:"/Applications/MAMP/htdocs/gec/application/index/view/store/index.html";i:1530536186;s:70:"/Applications/MAMP/htdocs/gec/application/index/view/common/world.html";i:1532374779;}*/ ?>
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
    <title>购物商城</title>
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
.btn-list > .btn, .btn-list > .dropdown {
    width: calc(20% - .4rem) ;
    margin-right: .5rem !important;
}
.btn-list .btn:nth-child(5) {
    margin-right: 0rem !important;
}
.btn-list .btn:nth-child(10) {
    margin-right: 0rem !important;
}
.btn-list .btn:nth-child(15) {
    margin-right: 0rem !important;
}
.btn-list .btn:nth-child(20) {
    margin-right: 0rem !important;
}
.products .card-subtitle img {
    max-height: 2rem;
}
.line-text {
    position: relative;
    text-align: center;
    font-weight: 400;
    margin-top: .75rem;
    color: #999;
}
.line-text::before {
    content: '';
    position: absolute;
    left: 0px;top: 10px;
    width: 40%;
    height: 1px;
    background-color: #eee;
}
.line-text::after {
    content: '';
    position: absolute;
    right: 0px;top: 10px;
    width: 40%;
    height: 1px;
    background-color: #eee;
}
.carousel {
    margin-top: -0.75rem;
    margin-left: -0.75rem;
    margin-right: -0.75rem;
}
.carousel-item {
    max-height: 7rem;
}
@media (min-width: 576px) {
    .carousel {
        margin-top: 0rem;
        margin-left: 0rem;
        margin-right: 0rem;
    }
    .carousel-item {
        max-height: 18rem;
    }
}
.store-dashboard .card-body .item {
    position: relative;
}
.store-dashboard .card-body .item .badge {
    position: absolute;right: 0;top: 0;
}
.store-dashboard .card-body .item .image i {
    font-size: 2rem;
}
.store-dashboard .card-body .item .text {
    margin-top: .3rem;
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
                
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="/static/image/store/b1.jpg" />
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="/static/image/store/b2.jpg" />
        </div>
    </div>
</div>
<div class="card mt-3 store-dashboard">
    <div class="card-header">
        <div class="card-title f1">我的订单</div>
        <div class="card-options">
            <?php if(!(empty(app('config')->get('hello.store.seller.enable')) || ((app('config')->get('hello.store.seller.enable') instanceof \think\Collection || app('config')->get('hello.store.seller.enable') instanceof \think\Paginator ) && app('config')->get('hello.store.seller.enable')->isEmpty()))): ?>
            <a href="/store/seller.html" class="btn btn-success btn-sm mr-2">卖家中心</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="d-flex justify-content-around text-center">
            <a class="item" href="/order.html?role=buyer&status=1">
                <div class="text-azure image"><i class="fa fa-heartbeat"></i></div>
                <div class="text-muted text small">已成交</div>
            </a>
            <a class="item" href="/order.html?role=buyer&status=2">
                <?php if(!(empty($myOrders['2']) || (($myOrders['2'] instanceof \think\Collection || $myOrders['2'] instanceof \think\Paginator ) && $myOrders['2']->isEmpty()))): ?>
                    <span class="badge badge-pill badge-primary"><?php echo htmlentities($myOrders['2']); ?></span>
                <?php endif; ?>
                <div class="text-yellow image"><i class="fa fa-heart-o"></i></div>
                <div class="text-muted text small">待发货</div>
            </a>
            <a class="item" href="/order.html?role=buyer&status=3">
                <?php if(!(empty($myOrders['3']) || (($myOrders['3'] instanceof \think\Collection || $myOrders['3'] instanceof \think\Paginator ) && $myOrders['3']->isEmpty()))): ?>
                    <span class="badge badge-pill badge-primary"><?php echo htmlentities($myOrders['3']); ?></span>
                <?php endif; ?>
                <div class="text-danger image"><i class="fa fa-heart-o"></i></div>
                <div class="text-muted text small">待确认</div>
            </a>
        </div>
    </div>
</div>
<div class="btn-list mt-3">
    <?php if(is_array(app('config')->get('hello.store.catalog')) || app('config')->get('hello.store.catalog') instanceof \think\Collection || app('config')->get('hello.store.catalog') instanceof \think\Paginator): $i = 0; $__LIST__ = app('config')->get('hello.store.catalog');if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key == '1'): ?>
            <button class="btn btn-primary" data-catalog="<?php echo htmlentities($key); ?>"><?php echo htmlentities($item); ?></button>
        <?php else: ?>
            <button class="btn btn-secondary" data-catalog="<?php echo htmlentities($key); ?>"><?php echo htmlentities($item); ?></button>
        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="line-text small">商品列表</div>
<div class="row row-cards products mt-3">
</div>
<div hidden class="more mb-3"><button class="btn btn-secondary btn-sm w-100">加载更多...</button></div>
<div class="modal fade modal-shop" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="store-confirm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">友情提示</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">您确认要<span class="currency"></span>兑换吗？</p>
                    <?php if(!(empty(app('config')->get('hello.store.machine.activation')) || ((app('config')->get('hello.store.machine.activation') instanceof \think\Collection || app('config')->get('hello.store.machine.activation') instanceof \think\Paginator ) && app('config')->get('hello.store.machine.activation')->isEmpty()))): ?>
                    <div hidden class="form-group">
                        <input type="text" name="code" class="form-control" placeholder="请输入激活码" maxlength="32" />
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary btn-buy">确认兑换</button>
                </div>
            </div>
            <div hidden class="store-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">商品详情</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary btn-go-address">确认兑换</button>
                </div>
            </div>
            <div hidden class="store-address">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">请选择收货地址</h5>
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
                    <div class="form-group">
                        <textarea class="form-control" name="remark" cols="30" rows="3" placeholder="选填，可以具体描述您想要的型号、大小、颜色等信息"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary btn-buy">确认兑换</button>
                </div>
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

<script>
var isScore = ('<?php echo htmlentities(app('config')->get('hello.score.enable')); ?>' == 1 ? true : false);
</script>
<script type="text/javascript" src="/static/js/area.js"></script>
<script type="text/javascript" src="/static/js/shop.js"></script>

</body>
</html>