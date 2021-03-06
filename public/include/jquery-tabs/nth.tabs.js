(function(a) {
    a.fn.nthTabs = function(c) {
        var h = this;
        var tabs = [];
        var g = {
            allowClose: true,
            active: true,
            rollWidth: h.width() - 120,
        };
        var e = a.extend({}, g, c);
        var d = '<div class="page-tabs"><a href="#" class="roll-nav roll-nav-left"><span class="fa fa-backward"><i class="icon iconfont">&#xe697;</i></span></a><div class="content-tabs"><div class="content-tabs-container"><ul class="nav nav-tabs"></ul></div></div><a href="#" class="roll-nav roll-nav-right"><span class="fa fa-forward"><i class="icon iconfont">&#xe6a7;</i></span></a><div class="dropdown roll-nav right-nav-list"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-chevron-down"><i class="icon iconfont">&#xe6a6;</i></span></a><ul class="dropdown-menu"><li><a href="#" class="tab-location">\u5b9a\u4f4d\u5f53\u524d\u9009\u9879\u5361</a></li><li><a href="#" class="tab-close-current">\u5173\u95ed\u5f53\u524d\u9009\u9879\u5361</a></li><li role="separator" class="divider"></li><li><a href="#" class="tab-close-other">\u5173\u95ed\u5176\u4ed6\u9009\u9879\u5361</a></li><li><a href="#" class="tab-close-all">\u5173\u95ed\u5168\u90e8\u9009\u9879\u5361</a></li><li role="separator" class="divider"></li><li class="scrollbar-outer tab-list-scrollbar"><div class="tab-list-container"><ul class="tab-list"></ul></div></li></ul></div></div><div class="tab-content" id="tabContentRrpository"></div>';
        var b = {
            tabs:tabs,
            init: function() {
                h.html(d);
                b.listen()
            },
            listen: function() {
                f.onTabClose().onTabRollLeft().onTabRollRight().onTabList().onTabCloseOpt().onTabCloseAll().onTabCloseOther().onLocationTab()
            },
            getAllTabWidth: function() {
                var i = 0;
                h.find(".page-tabs .content-tabs .nav-tabs li").each(function() {
                    i += parseFloat(a(this).width())
                });
                return i
            },
            getMarginStep: function() {
                return e.rollWidth / 2
            },
            getActiveId: function() {
                return h.find('.page-tabs .content-tabs li[class="active"]').find("a").attr("href").replace("#", "")
            },
            getTabList: function() {
                var i = [];
                h.find(".page-tabs .content-tabs .nav-tabs li a").each(function() {
                    i.push({
                        id: a(this).attr("href"),
                        title: a(this).children("span").html()
                    })
                });
                return i
            },
            addTab: function(j) {
                if (!(tabs.indexOf(j.id) < 0)) {
                    return b.setActTab('#' + j.id);
                }
                tabs.push(j.id);
                var k = [];
                var m = j.active == undefined ? e.active : j.active;
                var i = j.allowClose == undefined ? e.allowClose : j.allowClose;
                m = m ? "active" : "";
                k.push('<li role="presentation" class="' + m + '">');
                k.push('<a href="#' + j.id + '" data-toggle="tab">');
                k.push("<span>" + j.title + "</span>");
                i ? k.push('<i class="fa fa-close tab-close icon iconfont">&#xe69a;</i>') : "";
                k.push("</a>");
                k.push("</li>");
                h.find(".page-tabs>.content-tabs li.active").removeClass("active");
                h.find(".page-tabs .content-tabs .nav-tabs").append(k.join(""));
                var l = [];
                l.push('<div class="tab-pane ' + m + '" id="' + j.id + '">');
                // let html = '<iframe class="iframe" src="" scrolling="no" frameborder="0"></iframe> ';
                l.push(j.content);
                l.push("</div>");
                h.find("#tabContentRrpository>.tab-pane.active").removeClass("active");
                h.find("#tabContentRrpository").append(l.join(""));
                return b
            },
            locationTab: function(j) {
                j = j == undefined ? b.getActiveId() : j;
                j = j.indexOf("#") > -1 ? j : "#" + j;
                var m = h.find("[href='" + j + "']");
                var l = 0;
                m.parent().prevAll().each(function() {
                    l += a(this).width()
                });
                var i = m.parent().parent().parent();
                if (l <= e.rollWidth * 0.7) {
                    margin_left_total = 40
                } else {
                    if (l <= e.rollWidth) {
                        margin_left_total = 40 - e.rollWidth / 2
                    } else {
                        var k = l + m.parent().width() - (Math.floor(l / e.rollWidth) * e.rollWidth);
                        if (k <= e.rollWidth * 0.7) {
                            margin_left_total = 40 - Math.floor(l / e.rollWidth) * e.rollWidth
                        } else {
                            margin_left_total = 40 - Math.floor(l / e.rollWidth) * e.rollWidth - e.rollWidth / 2
                        }
                    }
                }
                i.css("margin-left", margin_left_total);
                return b
            },
            delTab: function(j) {
                j = j == undefined ? b.getActiveId() : j;
                j = j.indexOf("#") > -1 ? j : "#" + j;
                var k = h.find("[href='" + j + "']");
                if (k.parent().attr("class") == "active") {
                    var i = k.parent().next();
                    var l = a(j).next();
                    if (i.length < 1) {
                        i = k.parent().prev();
                        l = a(j).prev()
                    }
                    i.addClass("active");
                    l.addClass("active")
                }
                k.parent().remove();
                a(j).remove();
                return b
            },
            delOtherTab: function() {
                h.find(".nav-tabs li").not('[class="active"]').remove();
                h.find(".tab-content div").not('[class="tab-pane active"]').remove();
                n.delOtherTab(t);
                return b
            },
            delAllTab: function() {
                h.find(".nav-tabs li").remove();
                h.find(".tab-content div").remove();
                n.delAllTab();
                return b
            },
            setActTab: function(i) {
                if(i == b.getActiveId()){
                    return;
                }
                i = i == undefined ? b.getActiveId() : i;
                i = i.indexOf("#") > -1 ? i : "#" + i;
                h.find(".page-tabs>.content-tabs li.active").removeClass("active");
                h.find("#tabContentRrpository>.tab-pane.active").removeClass("active");
                h.find(".page-tabs .content-tabs li [href='" + i + "']").parent().addClass("active");
                h.find('#tabContentRrpository>.tab-pane'+i).addClass("active");
                return b
            },
        };
        var f = {
            onLocationTab: function() {
                h.on("click", ".tab-location", function() {
                    b.locationTab()
                });
                return f
            },
            onTabClose: function() {
                h.on("click", ".tab-close", function() {
                    var i = a(this).parent().attr("href");
                    b.delTab(i)
                    n.delTab(i);
                });
                return f
            },
            onTabCloseOpt: function() {
                h.on("click", ".tab-close-current", function() {
                    b.delTab()
                });
                return f
            },
            onTabCloseOther: function() {
                h.on("click", ".tab-close-other", function() {
                    b.delOtherTab()
                });
                return f
            },
            onTabCloseAll: function() {
                h.on("click", ".tab-close-all", function() {
                    b.delAllTab()
                });
                return f
            },
            onTabRollLeft: function() {
                h.on("click", ".roll-nav-left", function() {
                    if (b.getAllTabWidth() <= e.rollWidth) {
                        return false
                    }
                    var i = a(this).parent().find(".content-tabs-container");
                    var j = i.css("marginLeft").replace("px", "");
                    var k = parseFloat(j) + b.getMarginStep() + 40;
                    i.css("margin-left", k > 40 ? 40 : k)
                });
                return f
            },
            onTabRollRight: function() {
                h.on("click", ".roll-nav-right", function() {
                    if (b.getAllTabWidth() <= e.rollWidth) {
                        return false
                    }
                    var i = a(this).parent().find(".content-tabs-container");
                    var j = i.css("marginLeft").replace("px", "");
                    var k = parseFloat(j) - b.getMarginStep();
                    if (b.getAllTabWidth() - Math.abs(j) <= e.rollWidth) {
                        return false
                    }
                    i.css("margin-left", k)
                });
                return f
            },
            onTabList: function() {
                h.on("click", ".right-nav-list", function() {
                    var i = b.getTabList();
                    var j = [];
                    a.each(i, function(k, l) {
                        j.push('<li class="toggle-tab" data-id="' + l.id + '">' + l.title + "</li>")
                    });
                    h.find(".tab-list").html(j.join(""))
                });
                h.find(".tab-list-scrollbar").scrollbar();
                f.onTabListToggle();
                return f
            },
            onTabListToggle: function() {
                h.on("click", ".toggle-tab", function() {
                    var i = a(this).data("id");
                    b.setActTab(i).locationTab(i)
                });
                return f
            }
        };
        var n = {
            clearTabs:function(t){
                return t.substring(1);
            },
            delTab:function(t) {
                t = n.clearTabs(t);
                let index = $.inArray(t,tabs);
                if(index >= 0){
                    tabs.splice(index,1);
                }
            },
            delTabs:function(t) {
                t.each((o)=>{
                    t = n.clearTabs(o);
                    let index = $.inArray(o,tabs);
                    if(index >= 0){
                        tabs.splice(index,1);
                    }
                });
            },
            delOtherTab:(t)=>{
                tabs.each((o)=>{
                    let index = $.inArray(o,tabs);
                    if(index >= 0){
                        tabs.splice(index,1);
                    }
                });
            },
            delAllTab:()=>{
                tabs = [];
            }
        }
        b.init();
        return b
    }
}
)(jQuery);
