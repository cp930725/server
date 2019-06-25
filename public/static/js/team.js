require(['jquery'], function($){
    var page = 1, size = 20, type = '', key = '', loading = false;
    var member = function(){
        if (loading) {
            return false;
        }
        var param = {
            page: page,
            size: size
        }
        if (type != '') {
            param.type = type;
        }
        if (key != '') {
            param.key = key;
        }
        loading = true;
        ajax(api.team.member, param, function(res){
            loading = false;
            if (res.code == 200) {
                if (res.data && res.data.length) {
                    var html = '';
                    for (var i = 0; i < res.data.length; i++) {
                        var item = res.data[i];
                        html += '<tr>';
                            html += '<td class="text-center">';
                                html += '<div class="avatar d-block" style="background-image: url(' + item.avatar + ');"></div>';
                            html += '</td>';
                            html += '<td>';
                                html += '<div>' + item.nickname + '</div>';
                                html += '<div class="small text-muted">' + item.type + '</div>';
                            html += '</td>';
                            html += '<td class="text-center">';
                                html += item.username;
                            html += '</td>';
                            html += '<td class="text-center"><button class="btn btn-secondary btn-sm btn-child" username="' + item.username + '">' + item.count + '</button></td>';
                        html += '</tr>';
                    }
                    $('.table-member tbody').append(html);
                }
                if (res.data.length == size) {
                    $('.card-more').prop('hidden', false);
                } else {
                    $('.card-more').prop('hidden', true);
                }
            }
        });
    }
    var child = function(username, count, callback){
        if (loading) {
            return false;
        }
        loading = true;
        ajax(api.team.member, { username: username, page: 1, size: count }, function(res){
            loading = false;
            if (res.code == 200) {
                if (res.data && res.data.length) {
                    var html = '';
                    for (var i = 0; i < res.data.length; i++) {
                        var item = res.data[i];
                        html += '<tr class="by' + username + '">';
                            html += '<td class="text-center"><i class="fe fe-corner-down-right"></i></td>';
                            html += '<td>';
                                html += '<div>' + item.nickname + '</div>';
                                html += '<div class="small text-muted">' + item.type + '</div>';
                            html += '</td>';
                            html += '<td class="text-center">';
                                html += item.username;
                            html += '</td>';
                            html += '<td></td>';
                        html += '</tr>';
                    }
                    callback(html);
                }
            }
        });
    }
    $(function(){
        // 用户数据
        member();
        // 搜索成员
        $('.btn-search').on('click', function(){
            type = $('select[name=type]').val();
            key = $('input[name=key]').val();
            $('.table-member tbody').html('');
            page = 1;
            member();
        });
        // 加载更多
        $('.card-more').on('click', function(){
            page++;
            member();
        });
        // 加载下级
        $('.table-member').on('click', '.btn-child', function(){
            var count = $(this).text();
            var username = $(this).attr('username');
            if (count && count != '0') {
                if ($('.by' + username).length) {
                    $('.by' + username).remove();
                } else {
                    $btn = $(this);
                    $tr = $(this).parents('tr');
                    $(this).addClass('btn-loading');
                    child(username, count, function(html){
                        $btn.removeClass('btn-loading');
                        if (html) {
                            $('<tr>' + html + '</tr>').insertAfter($tr);
                        }
                    });
                }
            }
        });
    });
});