/**
 * rpa js
 * @since 2018/5/16
 * @author hsu lay
 */
$(function(){
    var total = 1;//分页总页面数
    var currentPage = 1;//当前页
    var total_count = '';//当前页
    var pageSize = '';//每页显示的记录数
    var idList = [];//批量选择id所存的数组

    //初始化
    function init(){
        bindevent();
        init_pagination();
    }

    //事件绑定
    function bindevent(){
        //批量删除
        $("#container .inner-content .middle-layer .deletebatch").on('click', function(){
        	var ids = idList.join(',');
            if("" == ids){
                responseTip(1,'您尚未选择要删除的数据！',1500);
        	}else{
	            myConfirmModal("确定要批量删除资讯吗？",function(){
		            $.ajax({
		                url:"/admin/rpa_center/deleteQueueAll",
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
               url:"/admin/rpa_center/deleteQueue",
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
     * 查看参数
     */
    function viewParam(){
        var datas = $(this).attr('data');
        responseTip(3,datas);
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
     * 分页动态渲染数据
     * @param pageIndex 当前显示页
     * @param pageSize 每页显示记录数
     */
    function render(pageIndex){
        $.ajax({
            type:'post',
            url:'/admin/rpa_center/rpa_queueList',
            data:{page:pageIndex},//从1开始计数
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

                    html+='<tr><th><input type="checkbox" class="select-all icheckbox"><th>ID</th>'
                        +'<th>任务名称</th>'
                        +'<th>时间</th>'
                        +'<th>状态</th>'
                        +'<th>参数</th>'
                        +'<th>TID</th>'
                        +'<th>操作</th></tr>';

                    for(let i = 0; i < data.data.length;i++){
                        let row = data.data[i];
                        let id = row.id;
                        let tid = row.tid || '--';
                        let state = row.state || '--';
                        let jsondata = row.jsondata ? (row.jsondata.length > 18) ? row.jsondata.substring(0,16)+'···' : row.jsondata : '--' ;

                        let checked = (idList.indexOf(id.toString()) >= 0) ? "checked":"";//判断当前记录先前有没有被选中
                        html+='<tr><td><input type="checkbox" class="select-single icheckbox" value="'+id+'" '+checked+'></td>'
                        +'<td>'+row.id+'</td>'
                        +'<td>'+row.name+'</td>'
                        +'<td>'+row.time+'</td>'
                        +'<td>'+state+'</td>'
                        +'<td>'+jsondata+'</td>'
                        +'<td>'+tid+'</td>'
                        +'<td>'
                        +'<a class="btn btn-primary btn-sm view" href="javascript:void(0);" data_id="'+id+'" data='+row.jsondata+'>参数</a> '
                        +'<a class="btn btn-primary btn-sm edit" href="javascript:void(0);" data_id="'+id+'" url="/admin/rpa_center/editQueue/'+id+'" onclick="operation($(this));">修改</a> '
                        +'<a class="btn btn-danger btn-sm delete" href="javascript:void(0);" data_id="'+id+'">删除</a>'
                        +'</td>'
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

                    $("#container .inner-section #list-table .view").click(viewParam);
                    $("#container .inner-section #list-table .delete").click(deleteOne);
                        
                }else{
                    responseTip(json.code,json.info,1500);
                }
            },
            error:errorResponse
        });
    }


    init();
})