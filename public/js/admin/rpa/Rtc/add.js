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
        let nowDate = getFormatDate();
        //定义时间按钮事件
        let st = '#Modal #content #add_time';
        let et = '#Modal #content #date';
        let jsondate = '#Modal #content #jsondate';
        laydate.render({elem: et, type: 'date'});
        laydate.render({elem: jsondate, type: 'date'});
        laydate.render({elem: st, type: 'time',done: function(value, date, endDate){
            let time = $('#Modal #content #time').val();
            let times = time ? time+','+value: value ;
            $('#Modal #content #time').val(times);
        }});

        let my_switch = {"onColor":"lightseagreen","offColor":"danger",'onText':"一次性任务",'offText':"循环任务","state":false,onSwitchChange:function(e,state){
            if(!state){
                $(this).parents('tr').next().find('.week').removeClass('hidden').prev().addClass('hidden');
            }else{
                $(this).parents('tr').next().find('.date').removeClass('hidden').next().addClass('hidden');
            }
            type = state;
        }};
        $("[name='type']").bootstrapSwitch(my_switch);

        //提交
        $('#save').click(function() {
            //处理站点
            if(!type){
                $('#Modal #content #date').val('');
            }else{
                $('#Modal #content input[name="week[]"]:checked').each(function(){
                    $(this).prop("checked",false);;
                });
            }
            let jsondata = {};
            $('#Modal #content table tr:eq(3) div').each(function(){
                jsondata.date = $(this).find("input[name='jsondate']").val().trim();
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
            responseTip(json.code,json.info, 1500);
        }else{
            responseTip(json.code,json.info, 1500);
        }
    }
    
    /**
     * 提交添加信息的表单配置
     */
    var  goodsFormOptions={
        url:'/admin/rpa_rtc_collect/insert',
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
            element.parents('td').next().append(error);
        }
    };
    init();
});

