
    {{-- @include('admin.inner.top') --}}

    <div class="sidebar">
        <!-- sidebar -->
        <div class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-fold">
                    <!-- Branding Image -->
                    <a class="sidebar-brand" href="{{ url('/admin') }}">
                        <img src="{{ session('sys_info')['config']['logo'] }}">
                        <span>{{ session('sys_info')['config']['site_title'] }}</span>
                    </a>
                </div>
                @foreach (session('sys_info')['top_menu'] as $menus)
                    @if($loop->first)
                        <div class="sidebar-nav sidebar-active" >
                            <div class="sidebar-title" data-tip='tooltip'>
                                <span class="icon">
                                    <i class="iconfont">
                                    {{ $menus['icon'] or '&#xe6b9; ' }}
                                    </i>
                                </span>
                                <span class="nav-title">{{ $menus['name'] }}</span>
                                <span class="right active"><i class="iconfont">&#xe6c2;</i></span>
                            </div>
                            <ul class="sidebar-trans">
                                @foreach ($menus['menus'] as $menu)
                                    @if($loop->first)
                                        <li class="nav-item active" name="{{ $menu['unique_name'] }}" data-tip='tooltip'>
                                            <a url='{{url("/admin/".$menu['unique_name'])}}' mid="{{$menu['id']}}" class="sidebar-trans">
                                                <span class="icon"><i class="iconfont">
                                                    {{ $menu['icon'] or '&#xe606;' }}
                                                    </i>
                                                </span>
                                                <span class="nav-title">{{ $menu['name'] }}</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item" name="{{ $menu['unique_name'] }}" data-tip='tooltip'>
                                            <a url='{{url("/admin/".$menu['unique_name'])}}' mid="{{$menu['id']}}" class="sidebar-trans">
                                                <span class="icon"><i class="iconfont">
                                                    {{ $menu['icon'] or '&#xe606;' }}
                                                    </i>
                                                </span>
                                                <span class="nav-title">{{ $menu['name'] }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="sidebar-nav" >
                            <div class="sidebar-title" data-tip='tooltip'>
                                <span class="icon">
                                    <i class="iconfont">
                                    {{ $menus['icon'] or '&#xe6b9; ' }}
                                    </i>
                                </span>
                                <span class="nav-title">{{ $menus['name'] }}</span>
                                <span class="right"><i class="iconfont">&#xe6c2;</i></span>
                            </div>
                            <ul class="sidebar-trans">
                                @foreach ($menus['menus'] as $menu)
                                    <li class="nav-item" name="{{ $menu['unique_name'] }}" data-tip='tooltip'>
                                        <a url='{{url("/admin/".$menu['unique_name'])}}' mid="{{$menu['id']}}" class="sidebar-trans">
                                            <span class="icon"><i class="iconfont">
                                                {{ $menu['icon'] or '&#xe606;' }}
                                                </i>
                                            </span>
                                            <span class="nav-title">{{ $menu['name'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div id="tooltip"></div>
    </div>