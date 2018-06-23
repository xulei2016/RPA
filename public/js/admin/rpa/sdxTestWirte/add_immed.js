$(function(){
    var type = false;

    /**
     * 页面初始化
     */
    function init(){
        bindEvent();
        //表单的JQueryValidater配置验证---jquery.validate插件验证法
        $("#myForm").validate(validateInfo);
    }

    /**
     * 事件绑定
     */
    function bindEvent(){
        //定义时间按钮事件
        let jsondate = '#Modal #content #jsondate';
        laydate.render({elem: jsondate, type: 'date'});

        //提交
        $('#save').click(function() {
            //处理站点
            let jsondata = {};
            $('#Modal #content table tr:eq(1) div').each(function(){
                jsondata.user = $(this).find("input[name='jsonuser']").val().trim();
                jsondata.date = $(this).find("input[name='jsondate']").val().trim();
                jsondata.pwd = $(this).find("input[name='jsonpwd']").val().trim();
            });
            $('#Modal #content #jsondata').val(JSON.stringify(jsondata));
            add();
        });
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
            responseTip(json.code,json.info, 1500, function(){ window.location.href=document.referrer; });
        }else{
            responseTip(json.code,json.info, 1500);
        }
    }
    
    /**
     * 提交添加信息的表单配置
     */
    var  goodsFormOptions={
        url:'/admin/rpa_questionnaire/insert_immed',
        success:successResponse,
        error:errorResponse
    };
    

    //表单验证信息
    var validateInfo ={
        rules:{
            name:{//名称
                required:true
            },
            time:{
                required:true
            },
            description:{
                required:true
            },
        },
        errorPlacement:function(error,element){
            element.parents('td').next().append(error);
        }
    };
    init();
});

