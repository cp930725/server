require(['echarts-common'], function(echarts){
    // 全局变量
    var page = 1, size = 20, type = 1, statuses = ['已取消', '匹配中', '待付款', '待确认', '投诉中', '', '', '', '交易成功'];
    // 列表数据
    var getData = function(){
        $('.list-switch input[value=' + type + ']').prop('checked', true);
        var param = {
            type: type
        }
        if (type == 3) {
            param.page = page;
            param.size = size;
        }
        ajax(api.market.list, param, function(res){
            if (res.code == 200) {
                var html = '';
                for (var i = 0; i < res.data.length; i++) {
                    var item = res.data[i];
                    html += '<tr>';
                        if (type == 3) {
                            html += '<td>';
                                html += '<strong>' + statuses[item.status] + '</strong>';
                                html += '<div class="text-muted small">' + item.date.substr(0, 10) + '</div>';
                            html += '</td>';
                        } else {
                            html += '<td>';
                                html += '<div style="word-break: normal;">' + item.owner + '</div>';
                                // html += '<div class="small">' + item.date.substr(0, 10) + '</div>';
                            html += '</td>';
                        }
                        html += '<td class="text-right">' + item.number + '</td>';
                        html += '<td class="text-right">' + item.price + '</td>';
                        var href = '/transaction.html?id=' + item.id, button = '查看';
                        if (type == 1) {
                            button = item.status == 1 ? '出售' : '交易中';
                        } else if (type == 2) {
                            button = item.status == 1 ? '购买' : '交易中';
                        }
                        if (item.status != 1 && type != 3) {
                            href = 'javascript:;';
                        }
                        html += '<td class="text-right"><a class="btn btn-sm btn-secondary" href="' + href + '">';
                            html += button;
                        html += '</a></td>';
                    html += '</tr>';
                }
                $('.table tbody').append(html);
                if (type == 3 && res.data.length == size) {
                    $('.card-footer').prop('hidden', false);
                } else {
                    $('.card-footer').prop('hidden', true);
                }
            } else {
                toast(res.message);
            }
        });
    }
    // 行情概览
    var overview = function(){
        ajax(api.market.overview, {}, function(res){
            if (res.code == 200) {
                var data = [], price = 0, today = {};
                for (var i = 0; i < res.data.market.length; i++) {
                    var item = res.data.market[i];
                    data.push({
                        name: item.date,
                        value: [item.date, item.price],
                    });
                    if (i == 0) {
                        price = item.price;
                        today = item;
                    }
                }
                $('.card-form input[name=price]').attr('placeholder', today.low == today.high ? today.low : today.low + ' - ' + today.high);
                chart(price, data);
            } else {
                toast(res.message);
            }
        });
    }
    // 初始化图标
    var myChart = echarts.init(document.getElementById('market'));
    // 生成图表
    var chart = function(price, data){
        // 指定图表的配置项和数据
        var option = {
            title: {
                show: true,
                text: '当前价格: ￥' + price,
                textStyle: {
                    fontSize: 14,
                    fontWeight: 'normal'
                }
            },
            grid: {
                top: 40,
                left: 30,
                right: 20,
                bottom: 20,
                borderColor: '#dee2e6',
            },
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    params = params[0];
                    var date = new Date(params.name);
                    return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' <br />最高成交价 ￥' + params.value[1];
                },
                axisPointer: {
                    animation: false
                }
            },
            xAxis: {
                type: 'time',
                boundaryGap: true,
                splitLine: {
                    show: false
                },

            },
            yAxis: {
                type: 'value',
                boundaryGap: [0, '100%'],
                splitLine: {
                    show: false
                },
                min: function(value){
                    return number_format(value.min * 0.99, 2);
                },
                max: function(value){
                    return number_format(value.max * 1.01, 2);
                },
            },
            series: [{
                name: '最新成交价',
                type: 'line',
                showSymbol: true,
                hoverAnimation: false,
                data: data,
                smooth: true,
                symbolSize: 6,
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    }
    $(function(){
        // 行情概览
        overview();
        // 列表切换
        $('.list-switch input[name=option]').on('change', function(){
            page = 1;
            type = $(this).val();
            $('.table tbody').html('');
            getData();
        });
        // 买卖切换
        $('.card-form .trade-switch').on('change', function(){
            if ($(this).prop('checked')) {
                $('.trade-switch-label').text('我要买入');
            } else {
                $('.trade-switch-label').text('我要卖出');
            }
        });
        // 提交订单
        $('.card-form .btn-submit').on('click', function(){
            // 数量
            var number = $('.card-form input[name=number]').val();
            if (number == '') {
                toast('很抱歉、请填写数量！', '.card-form input[name=number]');
                return false;
            }
            // 单价
            var price = $('.card-form input[name=price]').val();
            if (price == '') {
                toast('很抱歉、请填写单价！', '.card-form input[name=price]');
                return false;
            }
            // 类型
            var option = $(this).data('option');
            if (option == 'sell') {
                $('.charge').text(number_format(number * charge)).parent().prop('hidden', false);
                $('.card-form .trade-switch').prop('checked', false);
            } else {
                $('.charge').parent().prop('hidden', true);
                $('.card-form .trade-switch').prop('checked', true);
            }
            // 安全验证
            $('.modal').modal('show');
            return false;
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
        // 提交订单 - 安全验证之后
        $('.btn-confirm').on('click', function(){
            // 重复提交
            if ($(this).hasClass('btn-loading')) {
                return false;
            }
            // 密码
            var safeword = $('.modal input[name=safeword]').val();
            if (safeword == '' || safeword.length < 6) {
                $('.modal input[name=safeword]').removeClass('state-valid').addClass('state-invalid').focus();
                $('.modal input[name=safeword]').focus();
                return false;
            }
            // 数量
            var number = $('.card-form input[name=number]').val();
            // 单价
            var price = $('.card-form input[name=price]').val();
            // 买卖
            var maimai = $('.card-form .trade-switch').prop('checked');
            var url = maimai ? api.trade.buy : api.trade.sell;
            // 请求
            $(this).addClass('btn-loading');
            $btn = $(this);
            ajax(url, {number: number, price: price, safeword: safeword}, function(res){
                $btn.removeClass('btn-loading');
                if (res.code == 200) {
                    $('.modal').modal('hide');
                    page = 1;
                    toast('恭喜您、操作成功！');
                    type = maimai ? 1 : 2;
                    $('.card-form input[name=number]').val('');
                    $('.table tbody').html('');
                    getData();
                } else {
                    toast(res.message);
                }
            });
        });
        // 加载更多
        $('.card-more').on('click', function(){
            page++;
            getData();
        });
        // 我的交易
        if (window.location.hash == '#my') {
            page = 1;
            type = 3;
        }
        // 列表数据
        getData();
    });
});