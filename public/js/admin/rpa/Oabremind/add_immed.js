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
        //添加站点
        $("#Modal #content #add_web").on('click',function(){
            let _this = $(this);
            let html = '<div><input type="text" class="form-control" name="web" placeholder="站点名称">'
                    +' <input type="text" class="form-control" name="num" placeholder="文章数量">'
                    +' <a href="javascript:void(0);" id="del_web" class="btn btn-sm btn-danger">删除</a>'
                    +'</div>';
            _this.parents('td').append(html);

            $("#Modal #content #del_web").unbind().on('click',function(e){
                let _this = $(this);
                _this.parent('div').remove();
            });
        });

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
        url:'/admin/rpa_oabreminding/insert_immed',
        success:successResponse,
        error:errorResponse
    };
    

    //表单验证信息
    var validateInfo ={
        rules:{
            name:{//名称
                required:true
            },
            web:{
                required:true
            },
            num:{
                required:true
            },
            description:{
                required:true
            },
        },
        errorPlacement:function(error,element){
            element.parent().append(error);
        }
    };
    init();
});

