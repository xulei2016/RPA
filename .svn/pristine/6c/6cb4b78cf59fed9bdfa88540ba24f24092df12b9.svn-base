$(function(){

    /**
     * 页面初始化
     */
    function init(){
        init_iCheck();
        bindEvent();
        //表单的JQueryValidater配置验证---jquery.validate插件验证法
        $("#myForm").validate(validateInfo);
    }

    /**
     * 事件绑定
     */
    function bindEvent(){
        let my_switch = {"onColor":"lightseagreen","offColor":"danger",'onText':"是",'offText':"否"}
        $("[name='isfp']").bootstrapSwitch(my_switch);

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
        url:'/admin/rpa_center/update',
        success:successResponse,
        error:errorResponse
    };
    

    //表单验证信息
    var validateInfo ={
        rules:{
            name:{//名称
                required:true
            },
            filepath:{
                required:true
            },
            bewrite:{
                required:true
            },
        },
        errorPlacement:function(error,element){
            element.parent().next().append(error);
        }
    };
    init();
});

