$(function(){

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
        let my_switch = {"onColor":"lightseagreen","offColor":"danger",'onText':"启用",'offText':"禁用"}
        $("[name='type']").bootstrapSwitch(my_switch);

        $('#save').click(function() {
            addBanner();
        });

        //图片选择
        $('#container #content #myForm .dropdown img').on('click',function(){
            let id = $(this).attr('id');
            let src = $(this).attr('src');
            $(this).parents('div').find('img:first').attr('id',id).attr('src',src);
            $(this).parents('div').prev().val(id);
        });
    }

    /**
     * 添加banner
     */
    function addBanner(){
        $("#myForm").ajaxSubmit($.extend(true,{},formOptions,goodsFormOptions));
    }

    /**
     * 添加banner信息得到服务器响应的回调方法
     */
    function successResponse(json,statusText){
        if(json.code == 200){
            responseTip(json.code,json.info, 1500);
        }else{
            responseTip(json.code,json.info, 1500);
        }
    }
    
    /**
     * 提交添加banner信息的表单配置
     */
    var  goodsFormOptions={
        url:'/admin/admin_manage/insert',
        success:successResponse,
        error:errorResponse
    };
    

    //表单验证信息
    var validateInfo ={
        rules:{
            name:{//banner名称
                required:true
            },
            password:{
                required:true
            },
            rePWD:{
                required:true,
                equalTo:'#password'
            },
            role:{
                required:true
            }
        },
        errorPlacement:function(error,element){
            element.parent().next().append(error);
        }
    };
    init();
});

