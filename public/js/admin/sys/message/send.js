$(function(){
    var type = getUser(); //是否获取通知人列表
    /*
     * 初始化
     */
    function init(){
        bindEvent();
        //表单的JQueryValidater配置验证---jquery.validate插件验证法
        $("#myForm").validate(validateInfo);
    }

    /*
     * 绑定事件
     */
    function bindEvent(){
        $('#save').click(function() {
            add();
        });

        //点击选择接收人菜单事件
        $('#container #repository #content #mode').on('change',function(){
            let data = type ? type : getUser();
            data = data['data'];
            let _this = $(this);
            let v = $(this).val();
            if(v == 1){
                let html = '<td>';
                for(let i = 0;i<data.length;i++){
                    let row = data[i];
                    html += ' <label><input type="checkbox" value="'+row.id+'" class="icheckbox select-single"  name=user[]>'+row.name+'</label> ';
                }
                html += '</td>';
                _this.parents('tr').next().html(html).removeClass('hidden');
            }else if(v == 2){
                let html = '<td>';
                let rdata = [];
                for(let i = 0;i<data.length;i++){
                    let row = data[i];
                    if($.inArray(row.rid, rdata) == -1){
                        rdata.push(row.rid);
                        html += ' <label><input type="checkbox" value="'+row.rid+'" class="icheckbox select-single" name=user[]>'+row.rname+'</label> ';
                    }
                }
                html += '</td>';
                _this.parents('tr').next().html(html).removeClass('hidden');
            }else if(v == 3){
                _this.parents('tr').next().addClass('hidden');
            }
            init_iCheck();
        });
    }

    /**
     * 获取信息
     */
    function getUser(){
        $.ajax({
            url:'/admin/sys_admin_manage/admin_list',
            type:'post',
            dataType:'json'
        }).then(function (json) {
            type = json.data;
        }, function (e) {
            console.log(e);
        });
        return type;
    }
    
    /**
     * 添加
     */
    function add(){
        $("#myForm").ajaxSubmit($.extend(true,{},formOptions,goodsFormOptions));
    }

    /**
     * 添加信息得到服务器响应的回调方法
     */
    function successResponse(json,statusText){
        if(json.code == 200){
            responseTip(json.code,json.info, 1500);
        }else{
            responseTip(json.code,json.info, 1500);
        }
    }
    
    /**
     * 提交添加信息的表单配置
     */
    var  goodsFormOptions={
        url:'/admin/sys_message_list/send',
        success:successResponse,
        error:errorResponse
    };
    
    //表单验证信息
    var validateInfo ={
        rules:{
            mode:{
                required:true
            },
            type:{
                required:true
            },
            title:{
                required:true
            }
        }
    };
    init();
});
