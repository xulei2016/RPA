$(function(){
    var total = 1;//分页总页面数
    var currentPage = 1;//当前页
    var total_count = '';//当前页
    var pageSize = '';//每页显示的记录数
    var idList = [];//批量选择id所存的数组
    var selectInfo = {};

    /*
     * 初始化
     */
    function init(){
        bindEvent();
        init_pagination();
        init_date();
        selecteSort(selectInfo, render);
        selectePageNum(selectInfo, render);
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
        
        //批量删除
        $("#container .inner-content .middle-layer .deletebatch").on('click', function(){
        	var ids = idList.join(',');
            if("" == ids){
                responseTip(1,'您尚未选择要删除的数据！',1500);
        	}else{
	            myConfirmModal("确定要批量删除资讯吗？",function(){
		            $.ajax({
		                url:"/admin/error_log/deleteAll",
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
     * 查看错误信息
     */
    function viewOne(){
        let info = $(this).prev().text();
        responseTip(2, info);
    }

    /**
     * 删除单条记录
     */
    function deleteOne(){
        var ids = $(this).attr("data_id");
        myConfirmModal("确定要删除该资讯吗？",function(){
           $.ajax({
               url:"/admin/error_log/delete",
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
        selectInfo.account = selectObj.find('.search-group #name').val();
        selectInfo.from_add_time = selectObj.find('.search-group #startTime').val();
        selectInfo.to_add_time = selectObj.find('.search-group #endTime').val();
        selectInfo.sort = selectObj.find('a.selectsort').attr('type');
        selectInfo.num = selectObj.find('.selectnum').val();
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
            url:'/admin/error_log/log_list',
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

                    html+='<tr><th><input type="checkbox" class="select-all icheckbox"><th>ID</th><th>控制器</th>'
                        +'<th>方法</th>'
                        +'<th>用户名</th>'
                        +'<th>ip地址</th>'
                        +'<th>浏览器代理</th>'
                        +'<th>地理位置</th>'
                        +'<th>时间</th>'
                        +'<th>操作</th></tr>';

                    for(let i = 0; i < data.data.length;i++){
                        let row = data.data[i];
                        let id = row.id;
                        let agent = row.agent?(row.agent.length > 18) ? row.agent.substring(0,16)+'···' : row.agent : '--' ;
                        let checked = (idList.indexOf(id.toString()) >= 0) ? "checked":"";//判断当前记录先前有没有被选中
                        html+='<tr><td><input type="checkbox" class="select-single icheckbox" value="'+id+'" '+checked+'></td>'
                        +'<td>'+row.id+'</td>'
                        +'<td>'+row.class+'</td>'
                        +'<td>'+row.function+'</td>'
                        +'<td>'+row.account+'</td>'
                        +'<td>'+row.ip+'</td>'
                        +'<td title="'+row.agent+'">'+agent+'</td>'
                        +'<td>'+row.province+'--'+row.city+'</td>'
                        +'<td>'+row.add_time+'</td>'
                        +'<td>'
                        +'<a class="hidden">'+row.info+'</a> '
                        +'<a class="btn btn-primary btn-sm view" href="#" data_id="'+id+'">查看</a> '
                        +'<a class="btn btn-danger btn-sm delete" href="#" data_id="'+id+'">删除</a>'
                        +'</td></tr>';
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

                    $("#container .inner-section #list-table .view").click(viewOne);
                    $("#container .inner-section #list-table .delete").click(deleteOne);
                        
                }else{
                    dialog({'type':'fail', 'content':json.info});
                }
            },
            error:errorResponse
        });
    }
    init();
});
