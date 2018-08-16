<div class="inner-section">
    <div id="content">
        <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
            <table class="table table-striped table-hover table-bordered table-base">
                <tbody>
                <tr>
                    <td><label><span class="must-tag"></span>头像</label></td>
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
                </tr>
                <tr>
                    <td><label><span class="must-tag">*</span>用户名</label></td>
                    <td><input type="text" class="form-control" id="name" name="name" value="{{$info->name}}" placeholder="用户名"></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag">*</span>所属角色</label></td>
                    <td>
                        <select class="form-control" name="role">
                            <option class="" value="">请选择</option>
                            @foreach($roles as $role)
                                <option class="" value="{{$role->id}}" @if($info->role == $role->id) selected @endif>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label><span class="must-tag">*</span>密码</label></td>
                    <td><input type="password" class="form-control" id="password" name="password" placeholder="请输入密码"></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag">*</span>确认密码</label></td>
                    <td><input type="password" class="form-control" id="rePWD" name="rePWD" placeholder="请输入确认密码"></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag"></span>E-mail</label></td>
                    <td><input type="text" class="form-control" id="email" name="email" value="{{$info->email}}" placeholder="邮箱"></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag"></span>手机号码</label></td>
                    <td><input type="text" class="form-control" id="phone" name="phone" value="{{$info->phone}}" placeholder="手机号码"></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag"></span>真实姓名</label></td>
                    <td><input type="text" class="form-control" id="realName" name="realName" value="{{$info->realName}}" placeholder="真实姓名"></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag"></span>状态</label></td>
                    <td><input type="checkbox" class="my-switch" name="type" value="1" @if($info->type == 1) checked @endif></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag"></span>描述</label></td>
                    <td><textarea type="text" class="form-control" id="desc" name="desc" placeholder="描述信息">{{$info->desc}}</textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="{{$info->id}}" />
                        <button type="button" class="btn btn-success btn-md" id="save">提交</button>
                        <input type="hidden" value="{{$info->role}}" name="old_role">
                        <a class="btn btn-default btn-md" href="javascript:window.history.back();">返回</a>
                    </td>
                </tr>
            </tbody>
            </table>

        </form>
    </div>
</div>

<link href="{{URL::asset('/include/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css')}}" rel="stylesheet">
<style>
    #content #myForm img{width: 40px;}
    #content #myForm .dropdown img:hover{box-shadow: 0px 0px 2px 1px lightseagreen;}
</style>

<script src="{{URL::asset('/include/jquery-form/jquery.form.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/localization/messages_zh.min.js')}}"></script>
<script src="{{URL::asset('/include/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{URL::asset('/js/admin/admin/admin/edit.js')}}"></script>