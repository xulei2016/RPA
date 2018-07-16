/**
 * 登录
 **/
$(function(){
    $(document).ready(function() {
        //粒子背景特效
        $('body').particleground({
            dotColor: '#5cbdaa',
            lineColor: '#5cbdaa'
        });
    });

    /**
     * 初始化
     */
    function init(){
        $("[data-toggle='popover']").popover();
        bindEvent();
    }

    /**
     * 绑定事件
     */
    function bindEvent(){

        //enter 事件
        $("#container .login-area input").keydown(function(event){
            event = event? event:window.event;
            if(event.keyCode == 13){
                $("#container .login-area .btn-login").click();
            }
        });

        $("#container .login-area .btn-login").click(function(){
            //管理员登录
            var account = $.trim($("#container .login-area  #account").val());//账号
            var password = $.trim($("#container .login-area  #password").val());//密码
			var remember = 0;//记住密码
            if($("#container .login-area  .remember-me :checked").length > 0){
                remember = 1;//记住密码
            }
			if(account == "" || password == ""){
                alert('请输入账号名和密码！');
                return false;
            }
            
            $.ajax({
                url: './login',
                type: 'post',
                data:  {"name":account,"password":password,"remember":remember},
                dateType: 'json',
                beforeSend:function(xhr){
                    $("#loading").modal('show');
                },
                complete:function(){
                    $("#loading").modal('hide');
                }
            }).then(function(json,statusText){
                if(json.code == 200){
                    //登录成功,跳转页面
                    window.location.href = "./index";
                }else if(json.code == 500){
                    //登录失败
                    alert('登录失败，用户名或密码错误！');
                }
                return false;
            },function(e){
                alert('网络异常，请稍后重试！');
                // console.log(e);
            });
        });
    }
    init();
});