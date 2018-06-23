@extends('admin.inner.app')

@section('content')

    {{-- 管理员信息 --}}
    <div class="row dashboard-container">

        <div class="admin col-lg-6">
            <div class="content row">
                <div class="head-img col-xs-4 col-lg-4">
                    <img src="{{ $admin['headImg'] }}" alt="头像" >
                </div>
                <div class="info col-xs-8 col-lg-8">
                    <ol>
                        <li><b>{{ $admin['name']}}</b></li>
                        <li>{{ $admin['email'] or ''}}</li>
                        <li><b>上次活跃：</b> {{ $admin['lastTime'] or '首次登陆'}}</li>
                    </ol>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="message col-lg-3">
            <div class="content">
                <div class="card-panel blue left">
                    <i class="icon iconfont">&#xe721;</i>
                </div>
                <div class="card-panel-description right ">
                    <div class="card-panel-text">Messages</div>
                    <span class="card-panel-num">10086</span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="record col-lg-3">
            <div class="content">
                <div class="card-panel red">
                    <i class="icon iconfont">&#xe7c3;</i>
                </div>
                <div class="card-panel-description right">
                    <div class="card-panel-text">Login Record</div>
                    <span class="card-panel-num">10086</span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    {{-- 系统信息 --}}
    <div class="sys-info">
        
    </div>

@endsection

@section('script-top')
    <link href="{{URL::asset('/css/admin/common/index.css')}}" rel="stylesheet">
@endsection

@section('script-foot')
@endsection