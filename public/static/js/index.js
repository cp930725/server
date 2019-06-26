require(['jquery', 'ZeroClipboard'], function($, ZeroClipboard){
    window['ZeroClipboard'] = ZeroClipboard;
    // 全局变量
    var page = 1, size = 20, filter = 'all', catalog = '', timer = null, date = new Date();
    // 首页数据
    var index = function(){
        var param = {
            page: page,
            size: typeof(_size) != 'undefined' ? _size : size,
            filter: filter,
            catalog: catalog,
        }
        ajax(api.index.list, param, function(res){
            if (res.code == 200) {
                var html = '';
                for (var i = 0; i < res.data.length; i++) {
                    var item = res.data[i];
                    var ratio = Math.round(item.current / item.target * 100);
                    ratio = ratio < 0 ? 0 : ratio;
                    html += '<div class="col-md-6 col-lg-4">';
                    var mb = ' mb-3';
                    if (i == res.data.length - 1) {
                        mb = ' mb-0';
                    }
                    html += '<a class="media' + mb + '" href="/funding/' + item.id + '.html">';
                    html += '<img src="/upload/' + item.image + '" class="align-self-start rounded projects-image" />';
                    html += '<div class="media-body ml-4 h-100">';
                    /*html += '<div class="projects-title text-dark">' + item.title + '</div>';
                    html += '<div class="progress progress-xs">';
                        html += '<div class="progress-bar bg-green" role="progressbar" style="width: ' + ratio + '%" aria-valuenow="' + ratio + '" aria-valuemin="0" aria-valuemax="100"></div>';
                    html += '</div>';
                    html += '<span class="text-' + (ratio == 0 ? 'muted' : 'green') + ' progress-label">' + ratio + '%</span>';
                    html += '<small class="text-muted projects-info">已筹资 <strong class="text-dark">' + number_format(item.current) + '</strong>' + unit + ' | 支持数 <strong class="text-dark">' + item.people + '</strong></small>';*/
                    html += '<div class="d-flex flex-column justify-content-between h-100">';
                    html += '<div class="font-weight-light text-dark">' + item.title + '</div>';
                    html += '<div class="position-relative">'
                    html += '<div class="progress progress-xs mr-7">';
                    html += '<div class="progress-bar bg-green" role="progressbar" style="width: ' + ratio + '%" aria-valuenow="' + ratio + '" aria-valuemin="0" aria-valuemax="100"></div>';
                    html += '</div>';
                    html += '<span class="text-' + (ratio == 0 ? 'muted' : 'green') + ' progress-label">' + ratio + '%</span>';
                    html += '</div>';
                    html += '<small class="text-muted projects-info">已筹资 <strong class="text-dark">' + number_format(item.current) + '</strong>' + unit + ' | 支持数 <strong class="text-dark">' + item.people + '</strong></small>';
                    html += '</div>';

                    html += '</div>';
                    html += '</a>';
                    html += '</div>';
                }
                $('.projects').append(html);
            } else {
                toast(res.message);
            }
        });
    }

    // 倒计时
    var countdown = function(enddate) {
        var leftTime = (new Date(enddate)) - new Date();
        var days = parseInt(leftTime / 1000 / 60 / 60 / 24, 10);
        var hours = parseInt(leftTime / 1000 / 60 / 60 % 24, 10);
        var minutes = parseInt(leftTime / 1000 / 60 % 60, 10);
        var seconds = parseInt(leftTime / 1000 % 60, 10);
        days = days;
        hours = hours;
        minutes = minutes;
        seconds = seconds;
        if (days > 1) {
            $('.expire_at').prop('hidden', false);
            $('.countdown').text(days + "天");
        } else if (hours >= 0 || minutes >= 0 || seconds >= 0) {
            $('.expire_at').prop('hidden', false);
            var text = '';
            if (hours > 0) {
                text += hours + '小时';
            }
            if (minutes > 0) {
                text += minutes + '分';
            }
            if (seconds > 0) {
                text += seconds + '秒';
            }
            $('.countdown').text(text);
        }
        if (days <= 0 && hours <= 0 && minutes <= 0 && seconds <= 0) {
            $('.expire_at').prop('hidden', true);
            $('.over-status').prop('hidden', false);
            window.clearInterval(timer);
            timer = null;
        }
    }
    $(function(){
        // 项目列表
        index();
    });
});