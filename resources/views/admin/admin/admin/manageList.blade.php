<div class="list-title-panel middle-layer">
    <div class="auxiliary-tool">
    </div>
</div>
<div class="inner-section">
    <div id="content">
        <ul class="nav nav-tabs">
            <li @if ($type) @if ($type == 'baseinfo') class="active" @endif @else class="active" @endif><a href="#baseinfo" data-toggle="tab"><b>基本信息</b></a></li>
            <li @if ($type == 'changePWD') class="active" @endif><a href="#changePWD" data-toggle="tab"><b>修改密码</b></a></li>
            <li @if ($type == 'safeSetting') class="active" @endif><a href="#safeSetting" data-toggle="tab"><b>安全设置</b></a></li>
            <li @if ($type == 'personalSetting') class="active" @endif><a href="#personalSetting" data-toggle="tab"><b>个性化设置</b></a></li>
            <li @if ($type == 'another') class="active" @endif><a href="#another" data-toggle="tab"><b>其他</b></a></li>
        </ul>
        <div id="myForm">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane in @if ($type) @if ($type == 'baseinfo') active @endif @else active @endif" id="baseinfo">
                    <form action="#" method="post" id="baseinfoForm" enctype="multipart/form-data" novalidate="novalidate">
                        <table class="table table-striped table-hover table-bordered table-base">
                            <tbody>
                            <tr>
                                <td><label><span class="must-tag">*</span>头像</label></td>
                                <td>
                                    <input type="hidden" class="form-control" id="head_img" name="head_img" value="{{$info->head_img}}">
                                    <div class="dropdown">
                                        @foreach($imgList as $img)
                                            @if($info->head_img == $img->id)
                                            <img class="img-circle" src="{{$img->thumb}}" />
                                            @endif
                                        @endforeach
                                        <a type="button" class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">更多
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                            <li role="presentation" style="padding:0 10px;">
                                                @foreach($imgList as $img)
                                                    <img class="img-circle" src="{{$img->thumb}}" id="{{$img->id}}"/>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>账户名</label></td>
                                <td>{{ $info->name}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>姓名</label></td>
                                <td><input type="text" class="form-control" id="realName" name="realName" value="{{ $info->realName}}" placeholder="您的姓名"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>邮箱</label></td>
                                <td><input type="text" class="form-control" id="email" name="email" value="{{ $info->email}}" placeholder="您的邮箱"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>性别</label></td>
                                <td><input type="checkbox" class="my-switch" name="sex" value="1" @if ($info->sex) checked @endif></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>地址</label></td>
                                <td><input type="text" class="form-control" id="address" name="address" value="{{ $info->address}}" placeholder="您的地址"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>自我描述</label></td>
                                <td>
                                    <textarea class="form-control" rows="3" id="desc" name="desc" placeholder="面向大海、春暖花开">{{ $info->desc}}</textarea>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="hidden" name="type" value="baseinfo"/>
                                    <button type="button" class="btn btn-success btn-m save">提交</button>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="tab-pane @if ($type == 'changePWD') active @endif" id="changePWD">
                    <form action="#" method="post" id="changePWDForm" enctype="multipart/form-data" novalidate="novalidate">
                        <table class="table table-striped table-hover table-bordered table-base">
                            <tbody>
                            <tr>
                                <td><label><span class="must-tag"></span>原始密码</label></td>
                                <td><input type="text" class="form-control" id="oriPWD" name="oriPWD" placeholder="原始密码"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>新密码</label></td>
                                <td><input type="text" class="form-control" id="PWD" name="PWD" placeholder="请输入新密码"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>确认新密码</label></td>
                                <td><input type="text" class="form-control" id="rePWD" name="rePWD" placeholder="请输入确认新密码"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="hidden" name="type" value="changePWD"/>
                                    <button type="button" class="btn btn-success btn-md pwdsave">提交</button>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="tab-pane @if ($type == 'safeSetting') active @endif" id="safeSetting">
                    <form action="#" method="post" id="safeSettingForm" enctype="multipart/form-data" novalidate="novalidate">
                        <table class="table table-striped table-hover table-bordered table-base">
                            <tbody>
                            <tr>
                                <td><label><span class="must-tag"></span>登录保护</label></td>
                                <td><input type="checkbox" class="my-switch" name="login_protected" value="1" @if ($info->login_protected) checked @endif></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>单点登录</label></td>
                                <td><input type="checkbox" class="my-switch" name="single_login" value="1" @if ($info->single_login) checked @endif></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>接受信息邮件通知</label></td>
                                <td><input type="checkbox" class="my-switch" name="message_email" value="1" @if ($info->message_email) checked @endif></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>异地登录邮件通知</label></td>
                                <td><input type="checkbox" class="my-switch" name="remote_login_email" value="1" @if ($info->remote_login_email) checked @endif></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><label><span class="must-tag"></span>关键信息修改通知</label></td>
                                <td><input type="checkbox" class="my-switch" name="secret_change_email" value="1" @if ($info->secret_change_email) checked @endif></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="hidden" name="type" value="safeSetting"/>
                                    <button type="button" class="btn btn-success btn-md save">提交</button>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="tab-pane @if ($type == 'personalSetting') active @endif" id="personalSetting">
                    <form action="#" method="post" id="personalSettingForm" enctype="multipart/form-data" novalidate="novalidate">
                        <table class="table table-striped table-hover table-bordered table-base">
                            <tbody>
                            <tr><td><p class="text-center text-danger">暂未开放</p></td></tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="tab-pane @if ($type == 'another') active @endif" id="another">
                    <form action="#" method="post" id="anotherForm" enctype="multipart/form-data" novalidate="novalidate">
                        <table class="table table-striped table-hover table-bordered table-base">
                            <tbody>
                            <tr><td><p class="text-center text-danger">暂未开放</p></td></tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                </div>
            </div>
        </form>
    </div>
</div>

<link href="{{URL::asset('/include/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css')}}" rel="stylesheet">
<style>
    #content #myForm #baseinfoForm img{width: 40px;height: 40px;}
    #content #myForm #baseinfoForm .dropdown img:hover{box-shadow: 0px 0px 2px 1px lightseagreen;}
</style>

<script src="{{URL::asset('/include/jquery-form/jquery.form.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/localization/messages_zh.min.js')}}"></script>
<script src="{{URL::asset('/include/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{URL::asset('/js/admin/admin/admin/manageList.js')}}"></script>