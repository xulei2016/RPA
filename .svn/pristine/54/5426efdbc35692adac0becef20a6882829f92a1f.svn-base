$(function(){

    var check = false;

    /**
     * 页面初始化
     */
    function init(){
        bindEvent();
    }

    /**
     * 事件绑定
     */
    function bindEvent(){
        //图片选择
        $('#container #content #myForm #baseinfoForm .dropdown img').on('click',function(){
            let id = $(this).attr('id');
            let src = $(this).attr('src');
            $(this).parents('div').find('img:first').attr('id',id).attr('src',src);
            $(this).parents('div').prev().val(id);
        });

        let my_switch = {"onColor":"lightseagreen","offColor":"danger"}
        let my_switch2 = {"onColor":"lightseagreen","offColor":"danger",'onText':"男",'offText':"女"}
        $("[name='login_protected']").bootstrapSwitch(my_switch);
        $("[name='single_login']").bootstrapSwitch(my_switch);
        $("[name='remote_login_email']").bootstrapSwitch(my_switch);
        $("[name='secret_change_email']").bootstrapSwitch(my_switch);
        $("[name='message_email']").bootstrapSwitch(my_switch);
        $("[name='sex']").bootstrapSwitch(my_switch2);

        $('#myForm form table button.save').click(function() {
            addForm($(this).parents('form'));
        });
        $('#myForm form table button.pwdsave').click(function() {
            if(!check) {
                responseTip('1','原始密码错误！', 1500);return;
            }
            if($(this).parents('tbody').find('#PWD').val() !== $(this).parents('tbody').find('#rePWD').val()){
                responseTip('1','您两次输入的密码不一致！', 1500);return;
            }
            addForm($(this).parents('form'));
            $(this).parents('form').resetForm();
        });

        //密码校验
        $('#myForm form input#oriPWD').on('change',function(){
            let _this = $(this);
            let pwd = _this.val();
            $.ajax({
                url: '/admin/admin_center/check_pwd',
                type: 'post',
                data: {pwd:pwd},
                dataType: 'json'
            }).then(function(json){
                if(200 != json){
                    check = false;
                    _this.parent().next().html('<span class="text-danger">原始密码校对错误！</span>');
                    return;
                }
                check = true;
                _this.parent().next().html('<span class="text-success">原始密码校对成功！</span>');
                setTimeout(function(){_this.parent().next().html('')},3000);
            },function(e){
                _this.parent().next().html('<span class="text-danger">原始密码校对错误！</span>');
            });
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
     * 提交表单
     */
    function addForm(obj){
        obj.ajaxSubmit($.extend(true,{},formOptions,goodsFormOptions));
    }

    /**
     * 提交form信息得到服务器响应的回调方法
     */
    function successResponse(json,statusText){
        if(json.code == 200){
            responseTip(json.code,json.info, 1500);
        }else{
            responseTip(json.code,json.info, 1500);
        }
    }

    //提交表单时的配置
    formOptions = {
        type : 'post',
        dataType : 'json',
        clearForm : false, // clear all form fields after successful submit
        resetForm : false,
        beforeSend:function(xhr){
            $("#loading").modal('show');
        },
        complete:function(){
            $("#loading").modal('hide');
        }
    };
    
    /**
     * 提交添加banner信息的表单配置
     */
    var  goodsFormOptions={
        url:'/admin/sys_admin_manage/edit_info',
        success:successResponse,
        error:errorResponse
    };


    init();
});

