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
    }
        
    /**
     * 立即运行
     */
    function immedtask(){
        let id = $(this).attr("data_id");
        $.ajax({
            url:"/admin/rpa_center/immedtask",
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
                    responseTip(json.code,'已添加到队列',1500);
                 }else{
                    responseTip(json.code,json.info,1500);
                 }
            },
            error:errorResponse
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
            url:'/admin/rpa_center/rpa_taskList',
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

                    html+='<tr><th>ID</th>'
                        +'<th>任务名称</th>'
                        +'<th>任务描述</th>'
                        +'<th>日期</th>'
                        +'<th>类型</th>'
                        +'<th>执行时间</th>'
                        +'<th>参数</th>'
                        +'<th>创建时间</th>'
                        +'<th>更新时间</th>'
                        +'<th>操作</th></tr>';

                    for(let i = 0; i < data.data.length;i++){
                        let row = data.data[i];
                        let id = row.id;
                        let date = row.date ? row.date : get_week(row.week);
                        let type = row.date ? '<span class="text-primary">一次性任务</span>' : '<span class="text-success">循环执行</span>' ;
                        let jsondata = row.jsondata ? (row.jsondata.length > 18) ? row.jsondata.substring(0,16)+'···' : row.jsondata : '--' ;
                        let update_at = row.update_at || '···';

                        html+='<tr><td>'+row.id+'</td>'
                        +'<td>'+row.name+'</td>'
                        +'<td>'+row.description+'</td>'
                        +'<td>'+date+'</td>'
                        +'<td>'+type+'</td>'
                        +'<td>'+row.time+'</td>'
                        +'<td>'+jsondata+'</td>'
                        +'<td>'+row.created_at+'</td>'
                        +'<td>'+update_at+'</td>'
                        +'<td>'
                        +'<a class="btn btn-warning btn-sm immed" href="#" data_id="'+id+'">立即运行</a> '
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

                    $("#container .inner-section #list-table .immed").click(immedtask);
                    $("#container .inner-section #list-table .view").click(viewParam);
                        
                }else{
                    responseTip(json.code,json.info,1500);
                }
            },
            error:errorResponse
        });
    }

    //get_week
    function get_week(week){
        let s = '每周';
        let w = week.split(',');
        for(let i = 0;i<w.length;i++){
            switch(w[i]){
                case "0":
                    s = s+'日,';
                    break;
                case "1":
                    s = s+'一,';
                    break;
                case "2":
                    s = s+'二,';
                    break;
                case "3":
                    s = s+'三,';
                    break;
                case "4":
                    s = s+'四,';
                    break;
                case "5":
                    s = s+'五,';
                    break;
                case "6":
                    s = s+'六,';
                    break;
            }
        }
        return s;
    }

    init();
})