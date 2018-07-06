    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{URL::asset('/css/admin/common/main.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/include/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/include/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/include/iCheck/skins/minimal/blue.css')}}" rel="stylesheet">
    <script src="{{URL::asset('/include/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{URL::asset('/js/admin/syslimit.js')}}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token()
        ]); ?>
    </script>
    <style type="text/css">
        #container .inner-content .navbar{background-color:{{ session('sys_admin')['theme'] }}}
        .sidebar .sidebar-wrapper .sidebar-content .sidebar-nav.sidebar-active ul .nav-item.active{border-bottom:1px solid {{ session('sys_admin')['theme'] }}}
        .sidebar .sidebar-wrapper .sidebar-content .sidebar-nav .sidebar-title:hover{background: {{session('sys_admin')['theme']}};}
    </style>