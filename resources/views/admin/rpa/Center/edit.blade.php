    <div class="inner-section">
        <div id="content">
            <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
                <table class="table table-striped table-hover table-bordered table-base">
                    <tbody>
                    <tr>
                        <td><label><span class="must-tag">*</span>任务名称</label></td>
                        <td><input type="text" class="form-control" id="name" name="name" value="{{$info->name}}" placeholder="任务名称"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>路径</label></td>
                        <td><input type="text" class="form-control" id="filepath" name="filepath" value="{{$info->filepath}}" placeholder="资源路径"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>失败尝试次数</label></td>
                        <td><input type="text" class="form-control" id="failtimes" name="failtimes" value="{{$info->failtimes}}" placeholder="失败尝试次数"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>任务超时时间</label></td>
                        <td><input type="text" class="form-control" id="timeout" name="timeout" value="{{$info->timeout}}" placeholder="任务超时时间"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>手机号码</label></td>
                        <td><textarea type="text" class="form-control" id="PhoneNum" name="PhoneNum" placeholder="手机号码">{{$info->PhoneNum}}</textarea></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>邮件</label></td>
                        <td><textarea type="text" class="form-control" id="emailreceiver" name="emailreceiver" placeholder="邮件">{{$info->emailreceiver}}</textarea></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>任务描述</label></td>
                        <td><textarea type="text" class="form-control" id="bewrite" name="bewrite" placeholder="任务描述">{{$info->bewrite}}</textarea></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>是否占用资源</label></td>
                        <td><input type="checkbox" class="my-switch" name="isfp" value="1" @if($info->isfp) checked @endif></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-success btn-md" id="save">提交</button>
                            <input type="hidden" name="id" value="{{$info->id}}">
                        </td>
                        <td></td>
                    </tr>
                </tbody>
                </table>

            </form>
        </div>
    </div>



<link href="{{URL::asset('/include/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css')}}" rel="stylesheet">

<script src="{{URL::asset('/include/jquery-form/jquery.form.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/localization/messages_zh.min.js')}}"></script>
<script src="{{URL::asset('/include/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{URL::asset('/js/admin/rpa/Center/edit.js')}}"></script>