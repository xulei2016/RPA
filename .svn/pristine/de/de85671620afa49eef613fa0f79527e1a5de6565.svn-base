/**
 * global.js
 * @name 后台系统全局js
 * @author hus lay
 * @since 2018/2
 * @version 1.0
 */
$(function () {
    var idList = [];//批量选择id所存的数组
    //屏幕阈值参数设置
    var screen_adpt_obj = {
        screen_width: $(window).width(),
        screen_threshold: 1024,
        bread_threshold: 680
    };

    //侧边栏点击事件
    $('.sidebar .sidebar-content a').on('click', function () {
        let url = $(this).attr('url');
        let title = $(this).find('span:last').text();
        $(this).parents('.sidebar-content').find('li.active').removeClass('active');
        $(this).parent().addClass('active');
        $(this).parents('.sidebar-content').find('span.active').removeClass('active');
        $(this).parents('ul').prev().find('.right').addClass('active');
        $('#container .navbar-header .bread-bar li.active').text(title);
        $.pjax({
            url: url,
            type: "post",
            container: '#container .inner-content #repository',
        });
    });

    //进度条
    $(document).on('pjax:start', function () {
        NProgress.start();
    });
    //进度条结束
    $(document).on('pjax:end', function () {
        NProgress.done();
    });

    //异步请求csrf头
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    //全选事件
    batchSelect(idList, "#container #content #list-table .select-all", "#container #content #list-table .select-single");

    // 侧边栏点击事件
    $('.sidebar .sidebar-wrapper .sidebar-nav .sidebar-title').bind('click', function () {
        let _this = $(this).parent();
        if (_this.hasClass('sidebar-active')) {
            _this.removeClass('sidebar-active');
        } else {
            _this.siblings().removeClass('sidebar-active');
            _this.addClass('sidebar-active');
        }
    });

    //收缩tip
    $(".sidebar [data-tip='tooltip']").on('mouseover', function () {
        if (!$(this).parents('.sidebar').hasClass('sidebar-mini')) { return; };
        let position = $('.sidebar').offset().top;
        let sidebar_position = $(this).offset().top - position;
        let tip = $(this).find('.nav-title').text();
        $('.sidebar #tooltip').text(tip).css({ 'top': sidebar_position + 6 });
        $('.sidebar').addClass('tool-tip');
    }).on('mouseout', function () {
        $('.sidebar').removeClass('tool-tip');
    });

    //快捷菜单隐藏
    $('.navbar .collapse .admin-info-list, .navbar .collapse .admin-theme,.navbar .collapse .admin-message').mouseover(function () {
        $(this).find('.popup').removeClass('hidden');
    }).mouseout(function () {
        $(this).find('.popup').addClass('hidden');
    });

    //图片放大
    $('img.lightbox').on('click', function () {
        img = $(this).attr('src');
        info = '<div class="text-center"><img src="' + img + '" style="max-width: 300px;min-width: 100px;"></div>';
        responseTip(3, info);
    });

    //缩放
    $('#container .navbar .collapse .change').on('click', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active').find('i').html('&#xe710;');
            exitFull();
        } else {
            $(this).addClass('active').find('i').html('&#xe70f;');
            requestFullScreen(document.documentElement);// 整个网页
        }
    });

    setInterval("getMessage()",30000);
    adaptScreen(screen_adpt_obj);
    egg();
});

//屏幕适应预设
function adaptScreen(obj) {
    screen_width = obj.screen_width ? obj.screen_width : $(window).width();
    screen_threshold = obj.screen ? obj.screen : 1024;
    bread_threshold = obj.bread ? obj.bread : 680;
    let sidebar = $('#container .navbar .navbar-company .bread-bar .sidebar-fold');
    let bread = $('.sidebar');
    let hideside = () => {
        sidebar.removeClass('topbar-sidebar-unfold').addClass('topbar-sidebar-fold');
        $('.sidebar').addClass('sidebar-mini');
        $('#container').css('left', '50px');
    }
    let showside = () => {
        bread.css('display', 'block');
        $('#container').css('left', '50px');
    }
    let hideside2 = () => {
        bread.css('display', 'none');
        $('#container').css('left', '0');
    }
    if (screen_width < screen_threshold) {
        hideside();
    }
    if (screen_width < bread_threshold) {
        hideside2();
    }
    //侧边栏收缩
    sidebar.on('click', function () {
        let _this = $(this);
        let width = $(window).width();
        if (width < bread_threshold) {
            bread.hasClass('sidebar-mini') ? '' : bread.addClass('sidebar-mini');
            if (_this.hasClass('topbar-sidebar-fold')) {
                _this.removeClass('topbar-sidebar-fold').addClass('topbar-sidebar-unfold');
                $('#container').css('left', '50px');
                showside();
            } else {
                _this.removeClass('topbar-sidebar-unfold').addClass('topbar-sidebar-fold');
                $('#container').css('left', '0');
                hideside2();
            }
        } else {
            if (_this.hasClass('topbar-sidebar-unfold')) {
                _this.removeClass('topbar-sidebar-unfold').addClass('topbar-sidebar-fold');
                $('.sidebar').addClass('sidebar-mini');
                $('#container').css('left', '50px');
            } else {
                _this.removeClass('topbar-sidebar-fold').addClass('topbar-sidebar-unfold');
                $('.sidebar').removeClass('sidebar-mini');
                $('#container').css('left', '180px');
            }
        }
    });
    //屏幕尺寸变化
    $(window).resize(function () {
        let width = $(window).width();
        if (width < screen_threshold) {
            if (screen_width > screen_threshold) {
                hideside();
            }
        }
        if (width < bread_threshold) {
            if (screen_width > bread_threshold) {
                hideside2();
            }
        } else {
            if (screen_width < bread_threshold) {
                showside();
            }
        }
        screen_width = width;
    });
}

//定义时间按钮事件
var init_date = () => {
    let nowDate = getFormatDate();
    //定义时间按钮事件
    let st = '#container .inner-content #repository .middle-layer #startTime';
    let et = '#container .inner-content #repository .middle-layer #endTime';
    laydate.render({
        elem: st, type: 'datetime', max: nowDate, done: function (value, date, endDate) {
            laydate.render({ elem: et, type: 'datetime', show: true, min: value, max: nowDate });
        }
    });
    laydate.render({ elem: et, type: 'datetime', max: nowDate });
}

//刷新
var refresh = () => {
    let url = window.location.href;
    $.pjax({
        url: url,
        type: "post",
        container: '#container .inner-content #repository',
    });
}

//弹出窗口
function operation(_this, id) {
    let url = _this.attr('url');
    $('#Modal .modal-content .modal-body').text('').load(url, { limit: 25, id: id });
    $('#Modal').modal('show');
}

//pjax
function pjaxContent(_this) {
    let url = _this.attr('url');
    let title = _this.text();
    $('#container .navbar-header .bread-bar li.active').text(title);
    $.pjax({
        url: url,
        type: "post",
        container: '#container .inner-content #repository',
    });
}

//自定义确认对话框，返回true或false,确认或取消操作
function myConfirmModal(alertInfo, callback) {//参数，当前操作提示文本
    if (alertInfo == undefined || alertInfo == "") {
        alertInfo = "确认当前操作吗？";
    }
    $("#myConfirmModal .modal-body").html("<p class='text-danger'>" + alertInfo + "</p>");
    $("#myConfirmModal").modal('show');//对话框显现

    //确认对话框--确认操作
    $("#myConfirmModal .btn-confirm").one('click', function () {
        $("#myConfirmModal").modal('hide');//对话框隐藏
        callback();//调用回调函数
    });
}

/**
 * 响应提示弹出框
 * @errorCode:0 为正确提示，1为错误提示
 * @time 弹框显现时长 毫秒 
 * @callback 回调函数
 */
function responseTip(errorCode, text, time, callback) {
    if (errorCode == 200) {
        if (text == "") {
            text = "恭喜您，操作成功！";
        }
        $("#myModal .modal-body").html("<p class='text-success'>" + text + "</p>");
    } else if (errorCode == 500) {
        if (text == "") {
            text = "操作异常！";
        }
        $("#myModal .modal-body").html("<p class='text-danger'>" + text + "</p>");
    } else {
        $("#myModal .modal-body").html("<p class='text-danger'>" + text + "</p>");
    }
    $("#Modal").modal('hide');
    $("#myModal").modal('show');
    if (!time) {
        return;
    }
    //定时器，1.5秒后模态框自动关闭
    setTimeout(function () {
        $("#myModal").modal('hide');
        if (callback) {//如果传了回调函数，则调用
            callback();
        }
    }, time);
}

//此事件在模态框被隐藏（并且同时在 CSS 过渡效果完成）之后被触发。
$('#myConfirmModal').on('hidden.bs.modal', function (e) {
    $("#myConfirmModal .btn-confirm").off("click");
})

//提交用户表单时的校验规则 
function formValidation(arr, $form, options) {
    // 如果JQuery.Validate检测不通过则返回false
    if (!$form.valid()) {
        return false;
    }
    for (var i = 0; i < arr.length; i++) {
        //去除前后空格
        if (arr[i].type != 'file') {
            arr[i].value = $.trim(arr[i].value);
        }
    }
}

//提交表单时的配置
var formOptions = {
    beforeSubmit: formValidation,
    type: 'post',
    dataType: 'json',
    clearForm: false, // clear all form fields after successful submit
    resetForm: false,
    beforeSend: function (xhr) {
        $("#loading").modal('show');
    },
    complete: function () {
        $("#loading").modal('hide');
    }
};

/**
 * 提交系统配置信息的表单配置
 */
var options = {
    success: successResponse,
    beforeSend: function (xhr) {
        $("#loading").modal('show');
    },
    complete: function () {
        $("#loading").modal('hide');
    },
    error: errorResponse
};

//添加息得到服务器响应的回调方法
function successResponse(json, statusText) {
    responseTip(json.code, josn.info);
}

//请求添加失败时（如网络不通畅、超时等）的回调方法
function errorResponse(XMLHttpRequest, textStatus, errorThrown) {
    responseTip(json.code, '网络异常，请求失败！');
}

// 清除缓存
function clean_cache() {
    $.ajax({
        type: "post",
        url: "/admin/clean_cache",
        dataType: "json",
        success: function (json, statusText) {
            if (json.code == 200) {
                //清除成功,跳转页面
                window.location.reload();
            } else if (json.code == 500) {
                //清除失败
                responseTip(500, '网络异常，请求失败！');
            }
            return false;
        },
        error: function () {
            alert('很抱歉，操作失败,发生异常！');
            return false;
        }
    });
    return false;
}

/**
 * 单选框样式初始化
 */
function init_iCheck() {
    //初始化复选框、单选按钮皮肤样式   //复选框添加类‘my-icheckbox’，单选按钮添加类‘my-iradio’
    $("input.icheckbox,input.iradio").iCheck({
        checkboxClass: "icheckbox_minimal-blue",//颜色主题需要与引入的css保持一致
        radioClass: "iradio_minimal-blue",//颜色主题需要与引入的css保持一致
        cursor: true
    });
}

/**
 * 表格批量选择事件 
 * @param idList 存储所有分页中选中的记录主键id的数组
 * @param selectAllSelector 全选选择器jquery对象
 * @param selectSingleSelector 全选选择器jquery对象
 */
function batchSelect(idList, allSelector, singleSelector) {
    selectAll(idList, allSelector, singleSelector);
    selectSingle(idList, allSelector, singleSelector);
}

/**
 * 全选事件
 * @param idList 存储所有分页中选中的记录主键id的数组
 * @param allSelector 全选选择器jquery对象
 * @param singleSelector 单选选择器
 */
function selectAll(idList, allSelector, singleSelector) {
    $(allSelector).on("ifChanged", function () {
        var boxs = $(singleSelector);//所有记录
        //被选中
        if ($(this).prop("checked")) {
            boxs.prop("checked", true);//复选框全部选中
            boxs.parent().addClass("checked");//加my-icheckbox类的时候专用
            boxs.each(function () {
                if ($.inArray($(this).val(), idList) < 0) {//idList中不包含当前id值，则加入
                    idList.push($(this).val());
                }
            });
        } else {
            //全部取消
            boxs.prop("checked", false);//复选框全部取消选中
            boxs.parent().removeClass("checked");//加my-icheckbox类的时候专用
            //从idList数组中删除当前id
            boxs.each(function () {
                var index = $.inArray($(this).val(), idList);
                if (index >= 0) {//idList中包含当前id值，则删除
                    idList.splice(index, 1);
                }
            });
        }
    });
}

/**
 * 单选事件
 * @param idList 存储所有分页中选中的记录主键
 * @param allSelector 全选选择器
 * @param itemSelector 单选选择器
 */
function selectSingle(idList, allSelector, itemSelector) {
    $(itemSelector).on("ifChanged", function () {
        if ($(this).prop("checked")) {//单选复选框选中时
            if ($(itemSelector).length == $(itemSelector + ":checked").length) {
                //所有复选框都选中时，将全选复选框置为选中状态
                $(allSelector).prop("checked", true);
                $(allSelector).parent().addClass("checked");//加my-icheckbox类的时候专用
            }
            if ($.inArray($(this).val(), idList) < 0) {//idList中不包含当前id值，则加入
                idList.push($(this).val());
            }
        } else {//单选复选框取消选中时
            $(allSelector).prop("checked", false);
            $(allSelector).parent().removeClass("checked");
            //从idList数组中删除当前id
            var index = $.inArray($(this).val(), idList);
            if (index >= 0) {//idList中包含当前id值，则删除
                idList.splice(index, 1);
            }
        }
    });
}

//点击排序触发事件
function selecteSort(selectInfo, callback) {
    //排序事件
    $("#container .inner-content .middle-layer .selectsort").on('click', function () {
        let _this = $(this);
        let status = ('asc' == _this.attr('type')) ? true : false;
        let type, title, icon = '';
        if (true == status) {
            type = 'desc';
            title = '降序';
            icon = '&#xe6d1;';
        } else {
            type = 'asc';
            title = '升序';
            icon = '&#xe6d0;';
        }
        _this.attr({ 'type': type, 'title': title }).find('i').html(icon);
        selectInfo.sort = type;
        callback(1);
    });
}

//点击分页数触发事件
function selectePageNum(selectInfo, callback) {
    //排序事件
    $("#container .inner-content .middle-layer .selectnum").on('change', function () {
        let _this = $(this);
        let num = _this.val() ? _this.val() : 10;
        selectInfo.num = num;
        callback(1);
    });
}

/**
 * 利用bootpag插件完成 初始化配置
 * 分页查询方法
 * @param selector 分页页码所在选择器内
 * @param option 插件自定义配置选择
 * @param callback 翻页事件回调函数
 */
var pageOption = {
    firstLastUse: true,
    first: '«',
    last: '»',
    prev: '‹',
    next: '›',
    leaps: true,
    //wrapClass: 'pagination',
    //activeClass: 'active',
    //disabledClass: 'disabled',
    //nextClass: 'next',
    //prevClass: 'prev',
    //lastClass: 'last',
    //firstClass: 'first'
    total: 1,//总页数
    total_count: 0,//总记录数
    page: 1, //当前显示页
    pageSize: 10, //每页显示的记录数
    maxVisible: 10//每页最多显示的页码链接
};

//分页触发事件
function pagination(selector, option, callback) {
    $.extend(true, pageOption, option);
    $(selector).bootpag(pageOption).on("page", function (event, pageIndex) {
        //动态加载渲染数据
        callback(pageIndex);
    });
}

//datetime
function getFormatDate() {
    var nowDate = new Date();
    var year = nowDate.getFullYear();
    var month = nowDate.getMonth() + 1 < 10 ? "0" + (nowDate.getMonth() + 1) : nowDate.getMonth() + 1;
    var date = nowDate.getDate() < 10 ? "0" + nowDate.getDate() : nowDate.getDate();
    var hour = nowDate.getHours() < 10 ? "0" + nowDate.getHours() : nowDate.getHours();
    var minute = nowDate.getMinutes() < 10 ? "0" + nowDate.getMinutes() : nowDate.getMinutes();
    var second = nowDate.getSeconds() < 10 ? "0" + nowDate.getSeconds() : nowDate.getSeconds();
    return year + "-" + month + "-" + date + " " + hour + ":" + minute + ":" + second;
}

//消息轮询
function getMessage() {
    $.ajax({
        type: "post",
        url: "/admin/getMessage",
        dataType: 'json'
    }).then(function (json) {
        //筛选消息
        let oldmessage = $('#container .inner-content .admin-message .body .message-inner');
        let ids = [];//本地已通知消息
        for (let i = 0; i < oldmessage.length; i++) {
            let message = oldmessage[i];
            let id = $(message).attr('id');
            if ($.inArray(id, ids) == -1) {
                ids.push(parseInt(id));
            }
        }
        //消息列表
        $("body .notify-wrap").remove();
        let myList = json.data;
        let html = '';
        let message = '';
        for (let i = 0; i < myList.length; i++) { 
            let obj = myList[i];
            if ($.inArray(obj.id, ids) == -1) {
                ids.push(obj.id);
                let type = (obj.mode == 1) ? '私信通知' : (obj.mode == 2) ? '管理员通知' : '系统通知';
                html += '<div class="notify-wrap">'
                    + '<div class="notify-title">' + type + '<span class="notify-off"><i class="icon iconfont">&#xe6e6;</i></span></div>'
                    + '<div class="notify-content">' + obj.content + '</div>'
                    + '<div class="notify-bottom">消息类型：' + obj.tname + '</div>'
                    + '</div>';
                message += '<div class="message-inner" id="'+ obj.id +'">'
                    + '<div class="message-content">'
                    + '<span class="pull-right">' + obj.add_time + '</span>'
                    + '<span class="pull-left">' + type + '</span>'
                    + '<div class="clearfix visible-xs"></div>'
                    + '</div>'
                    + '<a href="JavaScript:void(0);" title="查看站内信息">' + obj.title + '</a>'
                    + '</div>';
            }
        }
        let count = json.count;
        if (html) {
            $('#container .inner-content .navbar .admin-message .body .body-tool-info').remove();
            if($('#container .inner-content .navbar .admin-message .topbar-notice-num').length > 0){
                $('#container .inner-content .navbar .admin-message .topbar-notice-num').text(count);
            }else{
                $('#container .inner-content .navbar .admin-message').append("<span class='topbar-notice-num'>" + count + "</span>");
            }
            $('#container .inner-content .admin-message .body').prepend(message);
            //播放消息提醒音乐
            var au = document.createElement("audio");
            au.preload = "auto";
            au.src = "/common/voice/qipao.mp3";
            au.play();

            $("body").append(html);
            $(".notify-wrap:first").delay(2000).slideDown(1000);
            setTimeout(function () {
                var _this = $(".notify-wrap:first");
                nextNotifyShow();
                _this.slideUp(1000);
            }, 8000);
        }
    }, function (e) {
        if ('Unauthorized' == e.responseText) {
            responseTip(500, '登录超时！', 5000, function () {
                location.href = "/login";
            }); return;
        }
        location.href = "/admin";
    });
}
/**
 * 循环显示通知
 */
var nextNotifyShow = () => {
    var sec = 1000;
    $("body > .notify-wrap").each(function () {
        var _this = $(this);
        setTimeout(function () {
            if (_this.next().length > 0) {
                _this.next().delay(1000).slideDown(1000);
            }
            _this.slideUp(1000);
        }, sec);
        sec += 6000;
    });
}

//全屏事件
function requestFullScreen(element) {
    // 判断各种浏览器，找到正确的方法
    var requestMethod = element.requestFullScreen || //W3C
        element.webkitRequestFullScreen ||    //Chrome等
        element.mozRequestFullScreen || //FireFox
        element.msRequestFullScreen; //IE11
    if (requestMethod) {
        requestMethod.call(element);
    } else if (typeof window.ActiveXObject !== "undefined") {//for Internet Explorer
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

//退出全屏 判断浏览器种类
function exitFull() {
    // 判断各种浏览器，找到正确的方法
    var exitMethod = document.exitFullscreen || //W3C
        document.mozCancelFullScreen ||    //Chrome等
        document.webkitExitFullscreen || //FireFox
        document.webkitExitFullscreen; //IE11
    if (exitMethod) {
        exitMethod.call(document);
    } else if (typeof window.ActiveXObject !== "undefined") {//for Internet Explorer
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

/**生成随机数 */
function random(n) {
    if (typeof n === 'object') {
        var times = n[1] - n[0]
        var offset = n[0]
        return Math.random() * times + offset
    } else {
        return n
    }
}

//主题操作
function mouseOverColor(hex) {
    let _this = $('.navbar .collapse .admin-theme #divpreview');
    _this.css({ 'visibility': 'visible', 'backgroundColor': hex });
}
var hh = 0;
var colorhex = "FF0000";
function mouseOutMap() {
    let _this = $('.navbar .collapse .admin-theme #divpreview');
    if (hh == 0) {
        _this.css({ 'visibility': 'hidden' });
    } else {
        hh = 0;
    }
    _this.css({ 'backgroundColor': "#" + colorhex });
}
function clickColor(hex, seltop, selleft, html5) {
    colorhex = hex;
    let theme = $('.navbar');
    let border = $('.sidebar .sidebar-wrapper .sidebar-content .sidebar-nav.sidebar-active ul .nav-item.active');
    theme.css('backgroundColor', hex);
    border.css('border-bottom', '1px solid ' + hex);
}
//修改主题
function changeTheme() {
    $.ajax({
        type: "post",
        url: "/admin/sys_admin_manage/change_theme",
        data: { 'theme': colorhex },
        dataType: 'json'
    });
}

//egg
function egg() {
    //     var info = `'
    //           _____                    _____                   _______                   _____          
    //          /\\    \\                  /\\    \\                 /::\\    \\                 /\\    \\         
    //         /::\\____\\                /::\\    \\               /::::\\    \\               /::\\____\\        
    //        /:::/    /               /::::\\    \\             /::::::\\    \\             /:::/    /        
    //       /:::/    /               /::::::\\    \\           /::::::::\\    \\           /:::/    /         
    //      /:::/    /               /:::/\\:::\\    \\         /:::/~~\\:::\\    \\         /:::/    /          
    //     /:::/____/               /:::/__\\:::\\    \\       /:::/    \\:::\\    \\       /:::/____/           
    //    /::::\\    \\              /::::\\   \\:::\\    \\     /:::/    / \\:::\\    \\     /::::\\    \\           
    //   /::::::\\    \\   _____    /::::::\\   \\:::\\    \\   /:::/____/   \\:::\\____\\   /::::::\\    \\   _____  
    //  /:::/\\:::\\    \\ /\\    \\  /:::/\\:::\\   \\:::\\    \\ |:::|    |     |:::|    | /:::/\\:::\\    \\ /\\    \\ 
    // /:::/  \\:::\\    /::\\____\\/:::/  \\:::\\   \\:::\\____\\|:::|____|     |:::|____|/:::/  \\:::\\    /::\\____\\
    // \\::/    \\:::\\  /:::/    /\\::/    \\:::\\  /:::/    / \\:::\\   _\\___/:::/    / \\::/    \\:::\\  /:::/    /
    //  \\/____/ \\:::\\/:::/    /  \\/____/ \\:::\\/:::/    /   \\:::\\ |::| /:::/    /   \\/____/ \\:::\\/:::/    / 
    //           \\::::::/    /            \\::::::/    /     \\:::\\|::|/:::/    /             \\::::::/    /  
    //            \\::::/    /              \\::::/    /       \\::::::::::/    /               \\::::/    /   
    //            /:::/    /               /:::/    /         \\::::::::/    /                /:::/    /    
    //           /:::/    /               /:::/    /           \\::::::/    /                /:::/    /     
    //          /:::/    /               /:::/    /             \\::::/____/                /:::/    /      
    //         /:::/    /               /:::/    /               |::|    |                /:::/    /       
    //         \\::/    /                \\::/    /                |::|____|                \\::/    /        
    //          \\/____/                  \\/____/                  ~~                       \\/____/         

    //     '`;
    // console.log(info);
    console.log('华安期货(http://haqh.com) 软件工程部');
}