<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <meta name="author" content="安徽easy shop网络有限公司">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link rel="icon" href="./themes/image/favicon.ico" sizes="16x16 32x32">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/admin/common/style.css')}}" />

    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <!-- Scripts -->
    <script src="{{URL::asset('/include/jquery/jquery-3.3.1.min.js')}}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    

    </head>
    <body>
        <div id="container">
        <dl class="admin_login login-area">
            <dt>
                <strong>RPA 自动化程序管理系统</strong>
                <em>Management System</em>
            </dt>
            <dd class="user_icon">
                <input type="text" id="account" placeholder="账号" class="login_txtbx"/>
            </dd>
            <dd class="pwd_icon">
                <input type="password" id="password" placeholder="密码" class="login_txtbx"/>
            </dd>
            <dd style="line-height: 42px;">
                <label><input type="checkbox" value="1" class="remember-me" checked> 记住登陆</label>
            </dd>
            <dd>
                <input type="button" value="立即登陆" class="submit_btn btn-login"/>
            </dd>
            <dd>
                <p>© 2015-2018 HAQH 软件工程部</p>
                <p>皖ICP备17018938号</p>
            </dd>
        </dl>
        </div>
        <div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-loading">
                <img height="60px" src='{{url("/images/common/loading.gif")}}'>
            </div>
        </div>

    <script src="{{URL::asset('/js/admin/login/verificationNumbers.js')}}"></script>
    <script src="{{URL::asset('/js/admin/login/Particleground.js')}}"></script>
    <script src="{{URL::asset('/include/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('/js/admin/login/login.js')}}" type="text/javascript"></script>

</body>
</html>
