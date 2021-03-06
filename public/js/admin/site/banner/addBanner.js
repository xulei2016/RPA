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
        $('#save').click(function() {
            addBanner();
        });

        //添加图片事件
        $("#imgurl").change(function(){
            var filepath=$(this).val();
            if(filepath == ""){
                return false;
            }
            var extStart=filepath.lastIndexOf(".");
            var ext=filepath.substring(extStart,filepath.length).toUpperCase();
            if(ext.toLowerCase()!=".jpg" && ext.toLowerCase()!=".jpeg"
                && ext.toLowerCase()!=".png" && ext.toLowerCase()!=".gif"){
                $(this).val("");
                responseTip('1','文件格式不正确，仅支持jpg、jpeg、gif、png格式，文件小于5M！', 1500);
            }

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
        url:'/admin/banner/insert',
        success:successResponse,
        error:errorResponse
    };
    

    //表单验证信息
    var validateInfo ={
        rules:{
            name:{//banner名称
                required:true
            },
            imgurl:{
                required:true,
            }
        },
        errorPlacement:function(error,element){
            element.parent().append(error);
        }
    };
    init();
});

