require(['jquery'], function($){
    // 全局变量
    var trade, logs, role, profile, timer, duration, safeword, owner, target;
    // 高度设置
    var resize = function(){
        var ww = $(window).outerWidth() ? $(window).outerWidth() : $(window).width();
        var wh = $(window).height();
        var hh = 65, bmt = 12, chh = 49, cfh = $('.chat-option').outerHeight(), cmb = 15, fh = 61;
        if (ww > 767) {
            bmt = 24;
            cmb = 27;
        }
        if (wh == 812 || wh == 724) {
            // fh += 24;
        }
        if (ww > 991) {
            hh += 55;
            fh = 67;
        }
        var height = wh - hh - bmt - chh - cfh - cmb - fh;
        $('.card-message .card-body').css('height', height + 'px');
    }
    // 当前时间
    window.now = function(){
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        month = month < 10 ? '0' + month : month;
        var day = date.getDate();
        day = day < 10 ? '0' + day : day;
        var hour = date.getHours();
        hour = hour < 10 ? '0' + hour : hour;
        var min = date.getMinutes();
        min = min < 10 ? '0' + min : min;
        var sec = date.getSeconds();
        sec = sec < 10 ? '0' + sec : sec;
        return year + '-' + month + '-' + day + ' ' + hour + ':' + min + ':' + sec;
    }
    // 倒计时
    var clock = function(){
        if (!timer) {
            timer = setInterval(function(){
                min = Math.floor(duration / 60);
                sec = duration % 60;
                if (min == '00') {
                    $('.chat-option .count-down-time').text(sec + '秒');
                } else {
                    $('.chat-option .count-down-time').text(min + '分' + sec + '秒');
                }
                duration--;
                if (duration < 0) {
                    clearInterval(timer);
                    timer = null;
                    if (trade.type == 2) {
                        $('.chat-option .btn-cancel').prop('hidden', false);
                    } else {
                        $('.chat-option .btn-quit').prop('hidden', false);
                    }
                    $('.chat-option .count-down').prop('hidden', true);
                }
            }, 1000);
        }
    }
    // 按钮调整
    var toolbar = function(status){
        var statuses = ['已取消', '匹配中', '待付款', '待确认', '投诉中', '', '', '', '交易成功'];
        $('.tag-status').text(statuses[status]);
        if (!window.guest) {
            $('.chat-option .btn').prop('hidden', true);
            $('.chat-option .tips').prop('hidden', true);
            $('.chat-option .count-down').prop('hidden', true);
            switch(status){
                case 0:
                    $('.chat-option .tips').prop('hidden', false);
                    break;
                case 1:
                    if (role.indexOf('owner') != -1) {
                        $('.chat-option .btn-cancel').prop('hidden', false);
                    } else {
                        $('.chat-option .btn-receive').prop('hidden', false);
                    }
                    break;
                case 2:
                    $('.chat-option .btn-call').prop('hidden', false);
                    if (role.indexOf('buyer') != -1) {
                        $('.chat-option .btn-payment').prop('hidden', false);
                        if (trade.type == 2) {
                            $('.chat-option .btn-quit').prop('hidden', false);
                        } else {
                            $('.chat-option .btn-cancel').prop('hidden', false);
                        }
                    } else {
                        if (trade.status == 2) {
                            var now = Math.floor((new Date()).valueOf() / 1000);
                            var start = Math.floor((new Date(trade.date)).valueOf() / 1000);
                            duration = safetime - (now - start);
                        }
                        duration = duration || safetime;
                        if (trade.type == 2) {
                            $('.chat-option .count-down-label').text('取消订单');
                        }
                        if (duration <= 0) {
                            if (trade.type == 2) {
                                $('.chat-option .btn-cancel').prop('hidden', false);
                            } else {
                                $('.chat-option .btn-quit').prop('hidden', false);
                            }
                        } else {
                            clock();
                            $('.chat-option .count-down').prop('hidden', false);
                        }
                    }
                    break;
                case 3:
                    $('.chat-option').addClass('btn-list');
                    $('.chat-option .btn-call').prop('hidden', false);
                    $('.chat-option .btn-proof').prop('hidden', false);
                    if (role.indexOf('seller') != -1) {
                        $('.chat-option .btn-confirm').prop('hidden', false);
                        $('.chat-option .btn-urge').prop('hidden', false);
                    }
                    $('.chat-option .btn-report').prop('hidden', false);
                    break;
                case 4:
                    $('.chat-option').addClass('btn-list');
                    $('.chat-option .btn-call').prop('hidden', false);
                    $('.chat-option .btn-proof').prop('hidden', false);
                    if (role.indexOf('seller') != -1) {
                        $('.chat-option .btn-confirm').prop('hidden', false);
                    }
                    break;
                case 8:
                    $('.chat-option .btn-call').prop('hidden', false);
                    break;
            }
        }
        resize();
    }
    // 模板信息
    window.template = {
        owner: function(nickname, avatar, right, content, date){
            var html = '';
            html += '<div class="media">';
                html += '<span class="media-object avatar avatar-md mr-4" style="background-image: url(' + avatar + ');"></span>';
                html += '<div class="media-body">';
                    html += '<div class="media-heading">';
                        html += '<span class="float-right text-muted small">' + (right ? right : '') + '</span>';
                        html += '<h5>' + nickname + ' <span class="badge badge-info">' + (trade.type == 1 ? '买家' : '卖家') + '</span>' + '</h5>';
                    html += '</div>';
                    html += '<div class="alert alert-primary p-3">';
                        if (typeof(content) == 'object') {
                            for (var i = 0; i < content.length; i++) {
                                html += '<div>' + content[i] + '</div>';
                            }
                        } else {
                            html += content;
                        }
                    html += '</div>';
                html += '</div>';
            html += '</div>';
            html += this.date(date || now());
            return html;
        },
        target: function(nickname, avatar, right, content, date){
            var html = '';
            html += '<div class="media">';
                html += '<div class="media-body">';
                    html += '<div class="media-heading">';
                        html += '<span class="float-right text-muted small">' + (right ? right : '') + '</span>';
                        html += '<h5 class="text-right">' + '<span class="badge badge-success">' + (trade.type == 1 ? '卖家' : '买家') + '</span> ' + nickname + '</h5>';
                    html += '</div>';
                    html += '<div class="alert alert-success p-3">';
                        if (typeof(content) == 'object') {
                            for (var i = 0; i < content.length; i++) {
                                html += '<div>' + content[i] + '</div>';
                            }
                        } else {
                            html += content;
                        }
                    html += '</div>';
                html += '</div>';
                html += '<span class="media-object avatar avatar-md ml-4" style="background-image: url(' + avatar + ');"></span>';
            html += '</div>';
            html += this.date(date || now());
            return html;
        },
        order_info: function(){
            var nickname = window.guest ? trade.owner : owner.nickname;
            var data = [
                '数量：' + trade.number + ' ' + unit,
                '单价：￥' + trade.price,
                '总价：￥' + number_format(trade.number * trade.price),
                '服务费：' + (trade.charge) + ' ' + unit + '（由卖家支付）',
                '手机号码：' + owner.username,
            ];
            if (owner.qq) {
                data.push('qq：' + owner.qq);
            }
            if (owner.wechat) {
                data.push('微信：' + owner.wechat);
            }
            if (owner.alipay) {
                data.push('支付宝：' + owner.alipay);
            }
            if (owner.realname) {
                data.push('真实姓名：' + owner.realname);
            }
            if (owner.bankname) {
                data.push('银行名称：' + owner.bankname);
            }
            if (owner.bankcard) {
                data.push('银行卡号：' + owner.bankcard);
            }
            if (owner.bankaddress) {
                data.push('银行地址：' + owner.bankaddress);
            }
            return this.owner(nickname, owner.avatar, (trade.type == 1 ? '求购' : '出售') + '订单', data, trade.create_at);
        },
        system: function(text, cls){
            var html = '';
            html += '<div class="alert alert-icon alert-secondary ' + (cls ? cls.join(' ') : 'mb-3') + '"><i class="fe fe-bell mr-2"></i><span class="small">' + text + '<span></div>';
            return html;
        },
        date: function(text){
            var html = '';
            html += '<div class="date"><span class="tag">' + text + '</span></div>';
            return html;
        },
        waiting_for_the_seller: function(){
            return this.system('系统正在为您寻找合适的卖方，您可以等待或主动出击。');
        },
        waiting_for_the_buyer: function(){
            return this.system('系统正在为您寻找合适的买方，您可以等待或主动出击。');
        },
        do_you_sell_it: function(){
            var html = '';
            html += '<div class="alert alert-success alert-doyou">';
                html += '<div><strong>是否与对方交易？</strong></div>';
                html += '<p class="small mt-2">如果您同意，交易金额将自动转入冻结' + unit + '，并提示对方进行付款，当然您也可以主动与之联系！</p>';
                html += '<div class="btn-list">';
                    html += '<button class="btn btn-success btn-sm" type="button" data-option="1">与之交易</button>';
                    html += '<a class="btn btn-secondary btn-sm" href="javascript:window.history.back();">不, 我再想想！</a>';
                html += '</div>';
            html += '</div>';
            return html;
        },
        do_you_buy_it: function(){
            var html = '';
            html += '<div class="alert alert-success alert-doyou">';
                html += '<div><strong>是否与对方交易？</strong></div>';
                html += '<p class="small mt-2">对方的资金已交予系统托管，您可以放心的与之交易，如果您同意，请在接下来的' + safetime_label + '内与对方沟通付款流程并上传凭证！</p>';
                html += '<div class="btn-list">';
                    html += '<button class="btn btn-success btn-sm" type="button" data-option="1">与之交易</button>';
                    html += '<a class="btn btn-secondary btn-sm" href="javascript:window.history.back();">不, 我再想想！</a>';
                html += '</div>';
            html += '</div>';
            return html;
        },
        receive: function(log){
            log = log || {};
            var html = '';

            var user = target && target.username ? target : profile;

            var nickname = window.guest ? trade.target : user.nickname;
            var data = ['手机号码：' + user.username];
            if (user.qq) {
                data.push('qq：' + user.qq);
            }
            if (user.wechat) {
                data.push('微信：' + user.wechat);
            }
            if (user.alipay) {
                data.push('支付宝：' + user.alipay);
            }
            if (user.realname) {
                data.push('真实姓名：' + user.realname);
            }
            if (user.bankname) {
                data.push('银行名称：' + user.bankname);
            }
            if (user.bankcard) {
                data.push('银行卡号：' + user.bankcard);
            }
            if (user.bankaddress) {
                data.push('银行地址：' + user.bankaddress);
            }
            html += this.target(nickname, user.avatar, '', data, trade.create_at);


            var text = trade.type == 1 ? '退出交易' : '取消订单';
            // 我要从对方这里买
            if (role == 'guest_buyer' || role == 'target_buyer' || role == 'owner_buyer') {
                html += this.system('用户(<strong>' + (nickname) + '</strong>) 已接单，等待买方付款！');
                html += this.system('为避免造成财产损失，请您在' + safetime_label + '内付款，否则安全时间过后对方可以单方面【' + text + '】！如您已付款，请点击【我已付款】！');
            }
            // 我要卖给对方
            else if (role == 'guest_seller' || role == 'target_seller' || role == 'owner_seller') {
                html += this.system('用户(<strong>' + (nickname) + '</strong>) 已接单，等待买方付款！');
                html += this.system('为保护双方的财产权益，' + safetime_label + '内您无法【' + text + '】，请尽快联系对方付款，过后【' + text + '】资金将会自动取消冻结！');
            }
            // 游客
            else if (window.guest) {
                html += this.system('用户(<strong>' + (nickname) + '</strong>) 已接单，等待买方付款！');
                html += this.system('为保护双方的财产权益，' + safetime_label + '内卖方无法【' + text + '】，请买方尽快付款！');
            }
            html += this.system('友情提示：整个付款流程中，请双方实时截屏保存凭证！');
            html += this.date(log.create_at || now());
            return html;
        },
        cancel: function(log){
            log = log || {};
            var html = '';
            html += this.system('交易结束，由用户(<strong>' + (log.username || profile.username) + '</strong>)主动取消订单！');
            return html;
        },
        payment: function(log){
            log = log || {};
            var html = '';
            // 求购订单：发布者：左边蓝色
            // 求购订单：接单者：左边蓝色
            // 出售订单：发布者：右边绿色
            // 出售订单：接单者：右边绿色
            if (trade.type == 1) {
                var nickname = owner.nickname || profile.nickname;
                nickname = window.guest ? trade.owner : nickname;
                html += this.owner(nickname, owner.avatar, null, ['我已付款，麻烦请查收！'], log.create_at);
                html += this.system('买方(<strong>' + (log.username || trade.owner || profile.username) + '</strong>)已付款，接下来请买方主动点击【发送图片】提供付款凭证，卖方如收到款项请点击【确认到账】！');
            } else {
                var nickname = target.nickname || profile.nickname;
                nickname = window.guest ? trade.target : nickname;
                html += this.target(nickname, target.avatar, null, ['我已付款，麻烦请查收！'], log.create_at);
                html += this.system('买方(<strong>' + (log.username || trade.target || profile.username) + '</strong>)已付款，接下来请买方主动点击【发送图片】提供付款凭证，卖方如收到款项请点击【确认到账】！');
            }
            html += this.date(log.create_at || now());
            return html;
        },
        proof: function(log){
            var html = '';
            if (log.username == trade.owner) {
                var nickname = owner.nickname || profile.nickname;
                nickname = window.guest ? trade.owner : nickname;
                html += this.owner(nickname, owner.avatar || profile.avatar, null, ['<img src="' + log.content + '" />']);
            } else {
                var nickname = target.nickname || profile.nickname;
                nickname = window.guest ? trade.target : nickname;
                html += this.target(nickname, target.avatar || profile.avatar, null, ['<img src="' + log.content + '" />']);
            }
            return html;
        },
        urge: function(log){
            log = log || {};
            var html = '';
            // 求购订单：发布者：右边绿色
            // 求购订单：接单者：右边绿色
            // 出售订单：发布者：左边蓝色
            // 出售订单：接单者：左边蓝色
            if (trade.type == 1) {
                var nickname = target.nickname || profile.nickname;
                nickname = window.guest ? trade.target : nickname;
                html += this.owner(nickname, target.avatar || profile.avatar, null, ['我没有收到款！'], log.create_at || now());
                html += this.system('卖方(<strong>' + (nickname) + '</strong>)未收到款项，接下来请双方点击【发送图片】提供付款凭证，也可以点击【投诉举报】请求系统介入！');
            } else {
                var nickname = owner.nickname || profile.nickname;
                nickname = window.guest ? trade.owner : nickname;
                html += this.owner(nickname, owner.avatar || profile.avatar, null, ['我没有收到款！'], log.create_at || now());
                html += this.system('卖方(<strong>' + (nickname) + '</strong>)未收到款项，接下来请双方点击【发送图片】提供付款凭证，也可以点击【投诉举报】请求系统介入！');
            }
            return html;
        },
        report: function(log){
            log = log || {};
            var html = '';
            html += this.system('用户(<strong>' + (log.username || profile.username) + '</strong>)发起投诉，接下来系统将介入审核，为保证双方的利益，在此期间请各位保持电话通信正常，同时也欢迎双方主动举证！');
            return html;
        },
        confirm: function(log){
            log = log || {};
            var html = '';
            html += '<div class="alert alert-secondary">';
                html += '<h4>交易已完成</h4>';
                html += '<p class="mb-0">选择永远大于努力！</p>';
            html += '</div>';
            return html;
        },
        quit: function(){
            window.location.reload();
        }
    }
    // action
    var action = function(command, alert, callback){
        if (!$(alert).length) {
            alert = '.chat-content .alert-doyou';
        }
        $('.dimmer').addClass('active');
        var param = {
            id: id,
            command: command
        }
        if (command == 8) {
            param.safeword = safeword;
        }
        ajax(api.trade.action, param, function(res){
            $('.dimmer').removeClass('active');
            if (res.code == 200) {
                if (command == 8) {
                    $('.modal').modal('hide');
                }
                $(alert).remove();
                chat(command);
                switch(command) {
                    case 0:
                        toolbar(0);
                        break;
                    case 1:
                        toolbar(2);
                        break;
                    case 2:
                        toolbar(3);
                        break;
                    case 4:
                        toolbar(4);
                        break;
                    case 8:
                        toolbar(8);
                        callback && callback();
                        break;
                    default:
                        break;
                }
            } else {
                toast(res.message);
            }
        });
    }
    // chat
    window.chat = function(command, log){
        log = log || {
            create_at: now()
        };
        var html = '';
        switch (command) {
            // 初始化
            case -1:
                // 显示订单信息
                html += template.order_info();
                // 没有聊天记录
                if (!logs.length) {
                    // 发布者，买家
                    if (role == 'owner_buyer') {
                        // 请等待卖家
                        html += template.waiting_for_the_seller();
                    }
                    // 发布者，卖家
                    if (role == 'owner_seller') {
                        // 请等待买家
                        html += template.waiting_for_the_buyer();
                    }
                    // 游客，出售者
                    if (role == 'guest_seller') {
                        // 提示是否出售
                        html += template.do_you_sell_it();
                    }
                    // 游客，购买者
                    if (role == 'guest_buyer') {
                        // 提示是否购买
                        html += template.do_you_buy_it();
                    }
                }
                break;
            // 接单
            case 1:
                html += template.receive(log);
                break;
            // 交易取消
            case 0:
                html += template.cancel(log);
                html += template.date(log.create_at);
                break;
            // 我已付款
            case 2:
                html += template.payment(log);
                break;
            // 未收到款
            case 3:
                html += template.urge(log);
                break;
            // 投诉举报
            case 4:
                html += template.report(log);
                break;
            // 发送图片
            case 5:
                html += template.proof(log);
                break;
            // 退出交易
            case 6:
                window.location.reload();
                break;
            // 交易成功
            case 8:
                html += template.confirm(log);
                break;
            // 系统提示
            case 18:
                html += template.system(log.content);
                html += template.date(log.create_at);
                break;
            // 买方胜利
            case 30:
                html += template.system('审判结束：买方胜利');
                html += template.confirm(log);
                html += template.date(log.create_at);
                break;
            // 卖方胜利
            case 31:
                html += template.system('审判结束：卖方胜利');
                html += template.confirm(log);
                html += template.date(log.create_at);
            // 订单关闭
            case 32:
                html += template.system('订单已关闭');
                html += template.date(log.create_at);
                break;
        }
        $('.chat-content').append(html);
    }
    // 初始化
    var init = function(){
        // 读取数据
        ajax(api.transaction, {id: id, guest: window.guest}, function(res){
            if (res.code == 200) {
                // 全局变量
                trade = res.data.trade;
                logs = res.data.logs;
                role = res.data.role.join('_');
                profile = res.data.profile;
                target = res.data.target;
                owner = res.data.owner;
                // 发布者
                $('.owner-avatar').css('background-image', 'url(' + owner.avatar + ')');
                $('.owner-nickname').text(owner.nickname);
                // 基本内容
                chat(-1);
                // 可选按钮
                toolbar(trade.status);
                // 循环记录
                if (logs) {
                    for (var i = 0; i < logs.length; i++) {
                        chat(logs[i].command, logs[i]);
                    }
                }
                // 联系对方
                if (!window.guest) {
                    if (trade.owner == profile.username) {
                        $('.btn-call').attr('href', 'tel:' + trade.target);
                    } else {
                        $('.btn-call').attr('href', 'tel:' + trade.owner);
                    }
                }
            } else {
                toast(res.message);
            }
        });
    }
    $(function(){
        // 设置高度
        resize();
        $(window).on('resize', resize);
        // 初始化
        init();
        $('.card').on('change', 'input[type=file]', function(){
            if ($(this)[0].files.length) {
                $('.dimmer').addClass('active');
                ajax(api.trade.action, {id: id, command: 5, image: $(this)[0].files[0]}, function(res){
                    $('.dimmer').removeClass('active');
                    if (res.code == 200) {
                        chat(5, {
                            username: profile.username,
                            content: res.data.image,
                            create_at: now()
                        });
                    } else {
                        toast(res.message);
                    }
                }, 'file');
            }
        });
        // 安全密码
        $('.modal input[name=safeword]').on('input', function(){
            var val = $(this).val();
            if (val != '' && val.length >= 6) {
                $(this).removeClass('state-invalid').addClass('state-valid');
            } else {
                $(this).removeClass('state-valid').addClass('state-invalid');
            }
        });
        // 最终确认
        $('.modal .btn-confirmation').on('click', function(){
            if ($(this).hasClass('btn-loading')) {
                return false;
            }
            $(this).addClass('btn-loading');
            safeword = $('.modal input[name=safeword]').val();
            action(8, null, function(){
                $('.modal .btn-confirmation').removeClass('btn-loading');
            });
        });
        // 事件绑定
        $('.card').on('click', '.btn[data-option]', function(){
            var type = $(this).data('type');
            if (type == 'image') {
            } else if (type == 'text') {
            } else if (type == 'modal') {
                $('.modal').modal('show');
            } else {
                action($(this).data('option'), $(this).parents('.alert'));
            }
        });
    });
});