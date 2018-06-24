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
    var selectInfo = {};

    //初始化
    function init(){
        bindevent();
        init_pagination();
        init_date();
        selecteSort(selectInfo, render);
        selectePageNum(selectInfo, render);
    }

    //事件绑定
    function bindevent(){
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
    }

    /**
     * 查看参数
     */
    function viewParam(){
        var datas = $(this).attr('data');
        responseTip(3,datas);
    }
    
    /**
     * 获取模糊参数
     */
    function getSelectInfo(){
        let selectObj = $('#container .inner-content #repository .middle-layer');
        selectInfo.name = selectObj.find('.search-group #name').val();
        selectInfo.from_time = selectObj.find('.search-group #startTime').val();
        selectInfo.to_time = selectObj.find('.search-group #endTime').val();
        selectInfo.sort = selectObj.find('a.selectsort').attr('type');
        selectInfo.num = selectObj.find('.selectnum').val();
        return selectInfo;
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
        let selectInfo = getSelectInfo();
        $.ajax({
            type:'post',
            url:'/admin/rpa_log/log',
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

                    html+='<tr><th><input type="checkbox" class="select-all icheckbox"><th>ID</th>'
                        +'<th>任务名称</th>'
                        +'<th>类型</th>'
                        +'<th>执行时间</th>'
                        +'<th>状态</th>'
                        +'<th>结束时间</th>'
                        +'<th>操作</th></tr>';

                    for(let i = 0; i < data.data.length;i++){
                        let row = data.data[i];
                        let id = row.id;
                        let type = (row.bewrite == 'timetask') ? '<span class="text-primary">定期任务</span>' : '<span class="text-success">立即执行</span>' ;
                        let status = (row.state == '成功') ? '<span class="text-primary">成功</span>' : '<span class="text-danger">失败</span>' ;
                        let update_at = row.update_at || '···';

                        let checked = (idList.indexOf(id.toString()) >= 0) ? "checked":"";//判断当前记录先前有没有被选中
                        html+='<tr><td><input type="checkbox" class="select-single icheckbox" value="'+id+'" '+checked+'></td>'
                        +'<td>'+row.id+'</td>'
                        +'<td>'+row.name+'</td>'
                        +'<td>'+type+'</td>'
                        +'<td>'+row.time+'</td>'
                        +'<td>'+status+'</td>'
                        +'<td>'+row.updatetime+'</td>'
                        +'<td>'
                        +'<a class="btn btn-primary btn-sm view" href="#" data_id="'+id+'" data='+row.jsondata+'>参数</a> '
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
                        
                }else{
                    responseTip(json.code,json.info,1500);
                }
            },
            error:errorResponse
        });
    }

    init();
})