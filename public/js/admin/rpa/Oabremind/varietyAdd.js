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
        //提交
        $('#save').click(function() {
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
            responseTip(json.code,json.info, 1500);
        }else{
            responseTip(json.code,json.info, 1500);
        }
    }
    
    /**
     * 提交添加信息的表单配置
     */
    var  goodsFormOptions={
        url:'/admin/rpa_customer_funds_search/varietyinsert',
        success:successResponse,
        error:errorResponse
    };
    

    //表单验证信息
    var validateInfo ={
        rules:{
            name:{//名称
                required:true
            },
            exfund:{
                required:true
            },
        },
        errorPlacement:function(error,element){
            element.parent().append(error);
        }
    };
    init();
});

