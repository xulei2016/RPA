$(function(){

    var check = false;

    /**
     * 页面初始化
     */
    function init(){
        bindEvent();
        getImg();
    }

    /**
     * 事件绑定
     */
    function bindEvent(){
        $('#myForm form table button.save').click(function() {
            addForm($(this).parents('form'));
        });

        let my_switch = {"onColor":"lightseagreen","offColor":"danger",'onText':"是",'offText':"否"};
        $("#myForm input.myradio").bootstrapSwitch(my_switch);

        //logo点击
        $('#myForm #basesetForm table #logo').on('click',function(){
            $(this).next().click();
        });

        //添加图片事件
        $("#myForm #imgManageForm table input[name='logo']").change(function(){
            var filepath=$(this).val();
            if(filepath == ""){
                return false;
            }
            var extStart=filepath.lastIndexOf(".");
            var ext=filepath.substring(extStart,filepath.length).toUpperCase();
            if(ext.toLowerCase()!=".jpg" && ext.toLowerCase()!=".jpeg"
                && ext.toLowerCase()!=".png" && ext.toLowerCase()!=".gif"){
                $(this).val("");
                responseTip('1','文件格式不正确，仅支持jpg、jpeg、gif、png格式，文件小于1M！', 1500);
            }
        });

    }

    //异步加载头像
    function getImg(){
        $.ajax({
            url: '/admin/sys_manage/getImg',
            type: 'POST',
            dataType:"json"
        }).then(function(json){
            if(200 == json.code){
                let data = json.data;
                let html = '';
                for(let i = 0; i<data.length;i++){
                    let row = data[i];
                    html += '<li><img class="img-circle" src="'+row.thumb+'" width="30px" /></li>';
                }
                html += '<li class=""><a href="javascript:void(0);" id="submitImg" title="添加图片"><i class="iconfont icon">&#xe6f9;</i></a><input class="hidden" type="file" name="imgUrl"/></li>';
                $('#myForm #imgManageForm table tr #imgContent').html(html);
            }
            
            //点击上传图片
            $('#myForm #imgManageForm table tr #imgContent #submitImg').unbind().on('click',function(){
                $(this).next().click();
            });
            //提交
            $('#myForm #imgManageForm table tr #imgContent input[name="imgUrl"]').unbind().change(function(){
                addImg();
            });
        },function(e){
            console.log(e);
        });
    }

    //提交表单
    function addImg(){
        $.ajax({
            url: '/admin/sys_manage/addImg',
            type: 'POST',
            data: new FormData($('#myForm #imgManageForm')[0]),
            processData: false,
            contentType: false,
            dataType:"json",
            success : function(json) {
                if(200 == json.code){
                    getImg();return;
                }
                responseTip(json.code,json.info, 1500);
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
        url:'/admin/sys_manage/editConfig',
        success:successResponse,
        error:errorResponse
    };


    init();
});

