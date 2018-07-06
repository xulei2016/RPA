$(function(){
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
        $('.inner-content #content tbody .delete').on('click',function(){
            let id = $(this).attr('id');
            $.ajax({
                url:"/admin/banner/del_banner",
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
                        $(this).parents('tr').remove();
                        responseTip(json.code,json.info,3000);
                    }else{
                        responseTip(json.code,json.info,3000);
                    }
                },
                error:errorResponse
            });
        });
    }

    init();
});