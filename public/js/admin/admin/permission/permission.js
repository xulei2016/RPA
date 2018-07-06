$(function(){
    var obj = '';
    var type = true;

    /*
     * 初始化
     */
    function init(){
        bindEvent();
    }

    /*
     * 绑定事件
     */
    function bindEvent(){
        //下拉触发
        $('#container #content #myTabContent .active .per-title').on('click',function(event){
            $(this).find('.menus:first').toggle();
            if($(this).hasClass('active')){
                $(this).removeClass('active').find('span:first').html('&#xe6b9;');
            }else{
                $(this).addClass('active').find('span:first').html('&#xe64a;');
            }
            return false;
        });

        //菜单事件
        $('#container #content #myTabContent .active .menu').on('click',function(){
            let _this = $(this);
            obj = _this;
            let id = _this.attr('id') || '';
            let table = _this.attr('table') || '× ';
            let desc = _this.attr('desc') || '';
            let name = _this.attr('name') || '';
            html = '<b>ID:</b>'+id+'<br/>'
                    +'<b>菜单: </b>'+table+'级菜单<br/>'
                    +'<b>描述：</b>'+desc+'<br/>'
                    +'<b>名称：</b>'+name+'<br/>';
            $('#container #content #menuInfo .tab-pane .desc').html(html);
            $('#container #content #menuInfo').removeClass('hidden');
        });

        //同步信息
        $('#container #content #menuInfo .tab-pane .operation .add-menu').on('click',function(){
            type = false;
            let operation = $('#container #content #menuOperation');
            let supLevel = obj.parents('.per-title').attr('desc');
            operation.removeClass('hidden');
            operation.find('.title b').text('--添加菜单--');
            operation.find('#form')[0].reset();
            operation.attr('table',obj.attr('table'));
            operation.find('#supLevel').text(supLevel);
        });
        $('#container #content #menuInfo .tab-pane .operation .edit-menu').on('click',function(){
            type = true;
            let id = obj.attr('id') || '';
            if(!id){return;}
            let desc = obj.attr('desc') || '';
            let name = obj.attr('name') || '';
            let sort = obj.attr('sort') || '';
            let table = obj.attr('table') || '';
            let operation = $('#container #content #menuOperation');
            let supLevel = obj.parents('.per-title').attr('desc');
            operation.find('#supLevel').text(supLevel);
            operation.find('#name').val(name);
            operation.find('#desc').val(desc);
            operation.find('#sort').val(sort);
            operation.attr('table',table);
            operation.find('.title b').text('--修改菜单--');
            operation.removeClass('hidden');
        });

        //提交数据
        $('#container #content #menuOperation #form #submit').on('click',function(){
            let _this = $(this);
            let name = _this.parent().find('#name').val();
            let desc = _this.parent().find('#desc').val();
            let sort = _this.parent().find('#sort').val();
            let table = _this.parents('#menuOperation').attr('table');
            let status = _this.parent().find("input[name='status']:checked").val();
            let pid = obj.parents('.per-title').attr('id');
            let id = obj.attr('id');
            let url = "/admin/sys_permission_manage/insert";
            let data = {"pid":pid,'name':name,'description':desc,'status':status,"sort":sort,'table':table};
            if(type){
                url = "/admin/sys_permission_manage/update";
                data = {"id":id,"pid":pid,'name':name,'description':desc,'status':status,"sort":sort,'table':table};
            }
            $.ajax({
                url:url,
                type:"post",
                data:data,
                dataType:"json",
                beforeSend:function(xhr){
                    $("#loading").modal('show');
                },
                complete:function(){
                    $("#loading").modal('hide');
                },
                success:function(json,statusText){
                     if(json.code == 200){
                        responseTip(json.code,json.info,1500);
                     }else{
                        responseTip(json.code,json.info,1500);
                     }
                },
                error:errorResponse
            });
        });

        //删除操作
        $('#container #content #menuInfo .tab-pane .operation .del-menu').on('click',function(){
            let id = obj.attr('id');
            if(!id){return;}
            myConfirmModal("确定要删除该菜单及其子菜单吗？",function(){
                $.ajax({
                    url:"/admin/sys_permission_manage/delete",
                    type:"post",
                    data:{"id":id},
                    dataType:"json",
                    beforeSend:function(xhr){
                        $("#loading").modal('show');
                    },
                    complete:function(){
                        $("#loading").modal('hide');
                    },
                    success:function(json,statusText){
                         if(json.code == 200){
                            obj.remove();
                            responseTip(json.code,json.info,1500);
                         }else{
                            responseTip(json.code,json.info,1500);
                         }
                    },
                    error:errorResponse
                });
            });
        })
    }

    init();
});
