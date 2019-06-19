<?php /*a:2:{s:67:"/www/wwwroot/amadubai.co/application/admin/view/event/contract.html";i:1529752986;s:65:"/www/wwwroot/amadubai.co/application/admin/view/common/world.html";i:1531123936;}*/ ?>
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
    <title>链上合约</title>
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
    
<style type="text/css">
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
                
<div class="d-flex">
    <div class="btn-list">
        <a href="/admin/event/contract.html" class="btn btn-primary">代理商列表</a>
        <a href="/admin/event/contract_store.html" class="btn btn-secondary">商品列表</a>
        <a href="/admin/event/contract_log.html" class="btn btn-secondary">操作记录</a>
    </div>
    <div class="btn-list ml-auto">
        <button class="btn btn-secondary btn-setting" data-toggle="modal" data-target=".modal-agent">设置代理商</button>
    </div>
</div>
<div class="card mt-3">
    <div class="card-body p-0">
        <table class="table table-hover table-outline table-vcenter card-table">
            <thead>
                <tr>
                    <th>账号</th>
                    <th>地区</th>
                    <th>比例</th>
                    <th>收益</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($agent) || $agent instanceof \think\Collection || $agent instanceof \think\Paginator): $i = 0; $__LIST__ = $agent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo htmlentities($item['username']); ?></td>
                    <td><?php echo htmlentities($item['address']); ?></td>
                    <td><?php echo htmlentities($item['ratio']); ?></td>
                    <td><?php echo htmlentities($item['income']); ?><?php echo htmlentities(app('config')->get('hello.unit')); ?></td>
                    <td><a href="?remove=<?php echo htmlentities($item['username']); ?>" onclick="return confirm('确认要删除吗？');"><i class="fe fe-trash"></i></a></td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal modal-agent" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title">代理商设置</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">用户账号</label>
                                <input type="tel" class="form-control" placeholder="手机号码" name="username" maxlength="11" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">收益比例</label>
                                <input type="text" class="form-control" placeholder="例如0.001代表千分之一" name="ratio" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">代理地区</label>
                                <div class="row gutters-xs">
                                    <div class="col-4">
                                        <select name="province" class="form-control custom-select"></select>
                                    </div>
                                    <div class="col-4">
                                        <select name="city" class="form-control custom-select">
                                            <option value="0">所有市</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="county" class="form-control custom-select">
                                            <option value="0">所有区</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary btn-setting-post">保存设置</button>
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
                    Copyright © 2018 <a href="."><?php echo htmlentities(app('config')->get('hello.title')); ?></a>. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
<script type="text/javascript" src="/assets/js/require.min.js"></script>
<script type="text/javascript" src="/static/js/global.js?3"></script>

<script>
// 查询市
var getCity = function(code){
    if (!code) {
        $('select[name=city] option:gt(0)').remove();
        $('select[name=county] option:gt(0)').remove();
        return true;
    }
    ajax(api.service.region, {type: 2, code: code}, function(res){
        if (res.code == 200) {
            var html = ''
            for (var i = 0; i < res.data.length; i++) {
                var item = res.data[i];
                html += '<option value="' + item.code + '">' + item.name + '</option>';
            }
            $('select[name=city] option:gt(0)').remove();
            $('select[name=county] option:gt(0)').remove();
            $('select[name=city]').append(html);
            if (!res.data.length) {
                getCounty(code);
            }
        } else {
            toast(res.message);
        }
    });
}
// 查询区
var getCounty = function(code){
    if (!code) {
        $('select[name=county] option:gt(0)').remove();
        return true;
    }
    var area = $('select[name=city] option').length <= 1;
    ajax(api.service.region, {type: 3, code: code, area: area}, function(res){
        if (res.code == 200) {
            var html = ''
            for (var i = 0; i < res.data.length; i++) {
                var item = res.data[i];
                html += '<option value="' + item.code + '">' + item.name + '</option>';
            }
            $('select[name=county] option:gt(0)').remove();
            $('select[name=county]').append(html);
        } else {
            toast(res.message);
        }
    });
}
require(['jquery'], function($){
    $(function(){
        // 查询省
        ajax(api.service.region, {type: 1}, function(res){
            if (res.code == 200) {
                var html = ''
                for (var i = 0; i < res.data.length; i++) {
                    var item = res.data[i];
                    html += '<option value="' + item.code + '">' + item.name + '</option>';
                }
                $('select[name=province]').html(html);
                getCounty(110000);
            } else {
                toast(res.message);
            }
        });
        // 选择省
        $('select[name=province]').on('change', function(){
            getCity(parseInt($(this).val(), 10));
        });
        // 选择市
        $('select[name=city]').on('change', function(){
            getCounty(parseInt($(this).val(), 10));
        });
        // 保存设置
        $('.modal-agent form').on('submit', function(){
            // 获取手机
            var username = $('.modal-agent input[name=username]').val();
            if (!username) {
                $('.modal-agent input[name=username]').focus();
                return false;
            }
            // 获取比例
            var ratio = $('.modal-agent input[name=ratio]').val();
            if (!ratio) {
                $('.modal-agent input[name=ratio]').focus();
                return false;
            }
            return true;
        });
    });
});
</script>

</body>
</html>