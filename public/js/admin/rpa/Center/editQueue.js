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
        let nowDate = getFormatDate();
        //定义时间按钮事件
        let st = '#Modal #content #time';
        laydate.render({elem: st, type: 'datetime'});

        //提交
        $('#save').click(function() {
            let jsondata = {};
            $('#Modal #content table tr:eq(2) div').each(function(){
                console.log($(this));
                let key = $(this).find("input[name='key']").val().trim();
                let val = $(this).find("input[name='val']").val().trim();
                jsondata[key] = val;
            });
            $('#Modal #content #jsondata').val(JSON.stringify(jsondata));
            add();
        });

        //添加站点
        $("#Modal #content #add_web").on('click',function(){
            let _this = $(this);
            let html = '<div><input type="text" class="form-control" name="key" placeholder="参数">'
                    +' <input type="text" class="form-control" name="val" placeholder="值">'
                    +' <a href="javascript:void(0);" id="del_web" class="btn btn-sm btn-danger">删除</a>'
                    +'</div>';
            _this.parents('td').append(html);

            $("#Modal #content #del_web").unbind().on('click',function(e){
                let _this = $(this);
                _this.parent('div').remove();
            });
        });

        $("#Modal #content #del_web").unbind().on('click',function(e){
            let _this = $(this);
            _this.parent('div').remove();
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
        url:'/admin/rpa_center/updateQueue',
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
        },
        errorPlacement:function(error,element){
            element.parent().append(error);
        }
    };
    init();
});

