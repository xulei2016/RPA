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
    }
    
    /**
     * 删除单条记录
     */
    function deleteOne(){
        var ids = $(this).attr("data_id");
        myConfirmModal("确定要删除该品种吗？",function(){
           $.ajax({
               url:"/admin/rpa_customer_funds_search/varietydelete",
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
     * 分页动态渲染数据
     * @param pageIndex 当前显示页
     * @param pageSize 每页显示记录数
     */
    function render(pageIndex){
        //异步请求csrf头
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            type:'post',
            url:'/admin/rpa_customer_funds_search/varietyList',
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

                    html+='<tr><th>ID</th><th>投资类型</th>'
                        +'<th>最低资金余额</th>'
                        +'<th>备注</th>'
                        +'<th>操作</th></tr>';

                    for(let i = 0; i < data.data.length;i++){
                        let row = data.data[i];
                        let id = row.id;
                        let desc = row.desc || '--';
                        let checked = (idList.indexOf(id.toString()) >= 0) ? "checked":"";//判断当前记录先前有没有被选中
                        html+='<tr><td>'+row.id+'</td>'
                        +'<td>'+row.name+'</td>'
                        +'<td>'+row.exfund+'</td>'
                        +'<td>'+desc+'</td>'
                        +'<td>'
                        +'<a class="btn btn-primary btn-sm edit" href="javascript:void(0);" data_id="'+id+'" url="/admin/rpa_customer_funds_search/varietyedit/'+id+'" onclick="operation($(this));">修改</a> '
                        +'<a class="btn btn-danger btn-sm delete" href="javascript:void(0);" data_id="'+id+'">删除</a>'
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
