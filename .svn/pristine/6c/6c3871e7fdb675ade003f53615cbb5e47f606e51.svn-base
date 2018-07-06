<!DOCTYPE html>
<html lang="en">
<head>
    {{--  header  --}}
    @include('admin.inner.header')

    @yield('script-top')
</head>
<body>
    {{--  left bar  --}}
    @include('admin.inner.left')

    <div id="container">
        <div class="inner-content">
            @include('admin.inner.top')
            <div id="repository" class="container">
                @yield('content')
            </div>
        </div>
        
        {{--  页脚  --}}
        <div id="footer">
            <div class="info">
                COPYRIGHT © <a href="{{ session('sys_info')['config']['site_address'] }}">{{ session('sys_info')['config']['copy_right'] }}</a> DESIGN. ALL RIGHTS RESERVED.
            </div>
        </div>
    </div>

    {{--  alert  --}}
    @include('admin.inner.alert')
    
    {{--  foot script  --}}
    @include('admin.inner.footer')

    @yield('script-foot')
</body>
</html>