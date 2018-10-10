$(function(){
    var total = 1;//分页总页面数
    var currentPage = 1;//当前页
    var pageSize = '';//每页显示的记录数
    var idList = [];//批量选择id所存的数组
    var selectInfo = {};

    /*
     * 初始化
     */
    function init(){
        bindEvent();
        init_pagination();
        selecteSort(selectInfo, render);
        selectePageNum(selectInfo, render);
    }

    /*
     * 绑定事件
     */
    function bindEvent(){
        let nowDate = getFormatDate();
        //定义时间按钮事件
        let st = '#container .inner-content #repository .middle-layer #startTime';
        let et = '#container .inner-content #repository .middle-layer #endTime';
        laydate.render({
            elem: st, type: 'date', max: nowDate, done: function (value, date, endDate) {
                laydate.render({ elem: et, type: 'date', show: true, min: value, max: nowDate });
            }
        });
        laydate.render({ elem: et, type: 'date', max: nowDate });

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
     * 切换状态
     */
    function changeType(){
        let id = $(this).attr("data_id");
        $.ajax({
            url:'/admin/rpa_customer_funds_search/typeChange',
            data:{id:id},
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
     * 删除单条记录
     */
    function deleteOne(){
        var ids = $(this).attr("data_id");
        myConfirmModal("确定要删除该客户吗？",function(){
           $.ajax({
               url:"/admin/rpa_customer_funds_search/delete",
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
        selectInfo.customer = selectObj.find('.search-group #customer').val();
        selectInfo.revisit = selectObj.find('.search-group #name').val();
        selectInfo.status = selectObj.find('.search-group #status').val();
        selectInfo.from_created_at = selectObj.find('.search-group #startTime').val();
        selectInfo.to_created_at = selectObj.find('.search-group #endTime').val();
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
            url:'/admin/rpa_customer_funds_search/rpa_list',
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

                    html+='<tr><th><input type="checkbox" class="select-all icheckbox"><th>ID</th><th>姓名</th>'
                        +'<th>客户号</th>'
                        +'<th>投资类型</th>'
                        +'<th>达标资金</th>'
                        +'<th>状态</th>'
                        +'<th>第一天</th>'
                        +'<th>第二天</th>'
                        +'<th>第三天</th>'
                        +'<th>第四天</th>'
                        +'<th>第五天</th>'
                        +'<th>当前账户</th>'
                        +'<th>操作</th></tr>';

                    for(let i = 0; i < data.data.length;i++){
                        let row = data.data[i];
                        let id = (pageIndex-1)*10 + i + 1;
                        let name = row.name || '--';
                        let d1 = ( row.day_one || '') +' - '+ (null == row.blance_one ? ' ' : row.blance_one);
                        let d2 = ( row.day_two || '') +' - '+ (null == row.blance_two ? ' ' : row.blance_two);
                        let d3 = ( row.day_three || '') +' - '+ (null == row.blance_three ? ' ' : row.blance_three);
                        let d4 = ( row.day_four || '') +' - '+ (null == row.blance_four ? ' ' : row.blance_four);
                        let d5 = ( row.day_five || '') +' - '+ (null == row.blance_five ? ' ' : row.blance_five);
                        let now = ( row.day_active || '') +' - '+ (null == row.blance_active ? ' ' : row.blance_active);
                        let type = '<span class="text-warning">未检测</span>';
                        switch(row.state){
                            case -1 :
                                type ='<span class="text-danger">客户不存在</span>';
                                break;
                            case 0 :
                                type = '<span class="text-danger">未达标</span>';
                                break;
                            case 1 :
                                type = '<span class="text-success">已达标</span>';
                                break;
                            case 2 :
                                type = '<span class="text-success">已归档</span>';
                                break;
                        }
                        let checked = (idList.indexOf(id.toString()) >= 0) ? "checked":"";//判断当前记录先前有没有被选中
                        html+='<tr><td><input type="checkbox" class="select-single icheckbox" value="'+id+'" '+checked+'></td>'
                        +'<td>'+id+'</td>'
                        +'<td>'+name+'</td>'
                        +'<td>'+row.khh+'</td>'
                        +'<td>'+row.cname+'</td>'
                        +'<td>'+row.exfund+'</td>'
                        +'<td>'+type+'</td>'
                        +'<td>'+d1+'</td>'
                        +'<td>'+d2+'</td>'
                        +'<td>'+d3+'</td>'
                        +'<td>'+d4+'</td>'
                        +'<td>'+d5+'</td>'
                        +'<td>'+now+'</td>'
                        +'<td>'
                        +((row.state == 1) ? '<a class="btn btn-primary btn-sm param" href="javascript:void(0);" data_id="'+row.khh+'">归档</a>':' ') 
                        +' <a class="btn btn-danger btn-sm delete" href="javascript:void(0);" data_id="'+row.khh+'">删除</a>'
                        +'</td></tr>';
                    }
                    if(data.data.length == 0){
                        html += '<tr><td colspan="'+ $(html).find("th").length +'"><p class="text-danger">暂无数据。</p></td></tr>';
                        $("#container .inner-section #page").html('');
                    }
                    $("#container #content #list-table tbody").html(html);

                    currentPage = data.current_page;
                    pageSize = data.per_page;
                    $("#container .inner-section #page").bootpag({total:data.last_page,total_count:data.total,page:currentPage});//重新计算总页数,总记录数

                    init_iCheck();
                    batchSelect(idList,"#container #content #list-table .select-all","#container #content #list-table .select-single");
                    $("#container .inner-section #list-table .param").click(changeType);
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
