$(function(){
    var total = 1;//分页总页面数
    var currentPage = 1;//当前页
    var total_count = '';//当前页
    var pageSize = '';//每页显示的记录数
    var idList = [];//批量选择id所存的数组
    var selectInfo = {};
    var id = '';

    /*
     * 初始化
     */
    function init(){
        bindEvent();
        init_pagination();
        selecteSort(selectInfo, render);
    }

    /*
     * 绑定事件
     */
    function bindEvent(){
        //根据条件查询信息
        $('#container .inner-content .middle-layer .search-group #search-btn').click(function() {
            render(1);
        });

        //enter键盘事件
        $("#container .inner-content .middle-layer .form-control input").keydown(function(event){
            event = event ? event: window.event;
            if(event.keyCode == 13){
                render(1);
            }
        });

        //下拉触发
        $('#myTabContent .active .per-title').on('click',function(event){
            $(this).find('.menus:first').toggle();
            if($(this).hasClass('active')){
                $(this).removeClass('active').find('span:first').html('&#xe6b9;');
            }else{
                $(this).addClass('active').find('span:first').html('&#xe64a;');
            }
            return false;
        });
        
        //提交权限修改
        $('#myTabContent .modal-footer .submit').on('click',function(){
            let ids = [];
            $('#myTabContent .modal-body').find('input:checked').each(function(){
                ids.push($(this).val());
            });

            //提交
            $.ajax({
                url:"/admin/role_manage/grantRole",
                type:"post",
                data:{"ids":ids,'id':id},
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

        //选中事件
        $('input').on("ifClicked",function(){
            $(this).parents('.per-title').find('input:first').iCheck('check');
        });

        //批量删除
        $("#container .inner-content .middle-layer .deletebatch").on('click', function(){
        	var ids = idList.join(',');
            if("" == ids){
                responseTip(1,'您尚未选择要删除的数据！',1500);
        	}else{
	            myConfirmModal("确定要批量删除资讯吗？",function(){
		            $.ajax({
		                url:"/admin/role_manage/deleteAll",
		                type:"post",
		                data:{"ids":ids},
		                dataType:"json",
		                beforeSend:function(xhr){
		                    $("#loading").modal('show');
		                },
		                complete:function(){
		                    $("#loading").modal('hide');
		                },
		                success:function(json,statusText){
		                    if(json.code == 200){
                                if(currentPage != 1 && (total_count - idList.length) % pageSize == 0){
                                    currentPage = currentPage - 1;
                                }
                                idList = [];//初始化idList的值
                                render(currentPage);
                            }else{
                                responseTip(json.code,json.info,1500);
                            }
		                },
		                error:errorResponse
		            });
	            });
        	}
        });
    }

    /**
     * 删除单条记录
     */
    function deleteOne(){
        var ids = $(this).attr("data_id");
        myConfirmModal("确定要删除该资讯吗？",function(){
           $.ajax({
               url:"/admin/role_manage/delete",
               type:"post",
               data:{"id":ids},
               dataType:"json",
               beforeSend:function(xhr){
                   $("#loading").modal('show');
               },
               complete:function(){
                   $("#loading").modal('hide');
               },
               success:function(json,statusText){
                    if(json.code == 200){
                       var length = $("#container #content .inner-section #list-table tbody tr").length - 1;
                       if(currentPage !=1 && length % pageSize == 1){
                           currentPage = currentPage - 1;
                       }
                       render(true,currentPage,pageSize);
                    }else{
                        responseTip(json.code,json.info,1500);
                    }
               },
               error:errorResponse
           });
       });
    }

    /**
     * 切换状态
     */
    function changeType(){
        let type = $(this).attr("type");
        let id = $(this).attr("id");
        $.ajax({
            url:'/admin/role_manage/typeChange',
            data:{id:id,type:type},
            type:'post',
            dataType:'json',
        }).then(function(json){
            if(200 == json.code){
                render(true,currentPage,pageSize);
            }
        },function(e){
            responseTip(1,'操作失败！',1500);
        });
    }
    
    /**
     * permission
     */
    function permission(){
        id = $(this).attr("data_id");
        //初始化弹出层
        $('#myTabContent .modal-body').find('input').iCheck('uncheck');

        //获取权限，遍历数据
        $.ajax({
            url:'/admin/role_manage/getPersission',
            type:'post',
            data:{'id':id},
            dataType:'json',
            beforeSend:function(){
                $("#loading").modal('show');
            },
            complete:function(){
                $("#loading").modal('hide');
            },
        }).then(function(json){
            if(200 == json.code){
                let data = json.data;
                for(let i=0;i<data.length;i++){
                    let id = data[i].permission_id;
                    $('#myTabContent .modal-body').find('input[value='+id+']').iCheck('check');
                }
                $('#myTabContent').modal('show');
            }
        },function(e){
            responseTip(1,'获取权限集失败！',1500);
        });
    }

    /**
     * 案例分页显示方法
     */
    function init_pagination(){
        render(1);
        //调用公共分页方法
        pagination("#container .inner-section #page",{pageSize:pageSize,total:total},render);
    }
    
    /**
     * 获取模糊参数
     */
    function getSelectInfo(){
        let selectObj = $('#container .inner-content .middle-layer');
        selectInfo.name = selectObj.find('.search-group #name').val();
        selectInfo.from_created_at = selectObj.find('.search-group #startTime').val();
        selectInfo.to_created_at = selectObj.find('.search-group #endTime').val();
        selectInfo.sort = selectObj.find('a.selectsort').attr('type');
        return selectInfo;
    }

    /**
     * 分页动态渲染数据
     * @param pageIndex 当前显示页
     * @param pageSize 每页显示记录数
     */
    function render(pageIndex){
        var selectInfo = getSelectInfo();
        $.ajax({
            type:'post',
            url:'/admin/role_manage/role_list',
            data:{page:pageIndex,selectInfo:selectInfo},//从1开始计数
            dataType:'json',
            beforeSend:function(xhr){
                $("#loading").modal('show');
            },
            complete:function(){
                $("#loading").modal('hide');
            },
            success:function(json){
                if(json.code == 200){
                    var data = json.data;
                    var html ='';

                    html+='<tr><th><input type="checkbox" class="select-all icheckbox"><th>ID</th><th>角色名称</th>'
                        +'<th>角色描述</th>'
                        +'<th>状态</th>'
                        +'<th>排序</th>'
                        +'<th>添加时间</th>'
                        +'<th>操作</th></tr>';

                    for(let i = 0; i < data.data.length;i++){
                        let row = data.data[i];
                        let id = row.id;
                        let type = (1 == row.type) ? '<span class="text-success">启用</span>' : '<span class="text-danger">禁用</span>' ;
                        let mycheck = '';
                        if(1==row.super){
                            mycheck = 'disabled';
                        }

                        let checked = (idList.indexOf(id.toString()) >= 0) ? "checked":"";//判断当前记录先前有没有被选中
                        html+='<tr><td><input type="checkbox" class="'+(row.super?'':'select-single')+' icheckbox" value="'+id+'" '+checked+' '+mycheck+'></td>'
                        +'<td>'+row.id+'</td>'
                        +'<td>'+row.name+'</td>'
                        +'<td>'+row.description+'</td>'
                        +'<td>'+type+'</td>'
                        +'<td>'+row.sort+'</td>'
                        +'<td>'+row.created_at+'</td>'
                        +'<td>'
                        +((1==row.super) ? '<a class="btn btn-primary btn-sm member" href="#" data_id="'+id+'">成员管理</a> ':
                        (row.type ? '<a class="btn btn-danger btn-sm type" type="'+row.type+'" id="'+id+'">禁用</a> ':'<a class="btn btn-success btn-sm type" type="'+row.type+'" id="'+id+'">启用</a> ')
                        +'<a class="btn btn-primary btn-sm permission" href="#" data_id="'+id+'">权限设置</a> '
                        +'<a class="btn btn-primary btn-sm member" href="#" data_id="'+id+'" url="/admin/admin_manage/"'+id+' onclick="operation($(this))">成员管理</a> '
                        +'<a class="btn btn-primary btn-sm edit" href="#" data_id="'+id+'" url="/admin/edit/"'+id+' onclick="operation($(this))">修改</a> '
                        +'<a class="btn btn-danger btn-sm delete" href="#" data_id="'+id+'">删除</a>'
                        +'</td>')
                        +'</tr>';
                    }
                    if(data.data.length == 0){
                        html += '<tr><td colspan="'+ $(html).find("th").length +'"><p class="text-danger">暂无数据。</p></td></tr>';
                        $("#container .inner-section #page").html('');
                    }
                    $("#container #content #list-table tbody").html(html);

                    currentPage = data.current_page;
                    total_count = data.total;
                    pageSize = data.per_page;
                    $("#container .inner-section #page").bootpag({total:data.last_page,total_count:data.total,page:currentPage});//重新计算总页数,总记录数

                    init_iCheck();
                    batchSelect(idList,"#container #content #list-table .select-all","#container #content #list-table .select-single");

                    $("#container .inner-section #list-table .type").click(changeType);
                    $("#container .inner-section #list-table .permission").click(permission);
                    $("#container .inner-section #list-table .delete").click(deleteOne);
                        
                }else{
                    responseTip(json.code,json.info,1500);
                }
            },
            error:errorResponse
        });
    }
    init();
});