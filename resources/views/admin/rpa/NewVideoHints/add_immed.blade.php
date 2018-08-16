    <div class="inner-section">
        <div id="content">
            <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
                <table class="table table-striped table-hover table-bordered table-base">
                    <tbody>
                    <tr>
                        <td><label><span class="must-tag">*</span>任务名称</label></td>
                        <td><input type="text" class="form-control" id="name" name="name" value="NewVideoHints" placeholder="任务名称" disabled></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>参数设置</label></td>
                        <td>
                            <div class="target_web">
                                <input type="text" class="form-control" id="jsondate" name="jsondate" placeholder="客户姓名">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>任务描述</label></td>
                        <td><textarea type="text" class="form-control" id="description" name="description" placeholder="任务描述"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-md" id="save">立即发布</button>
                            <input type="hidden" class="form-control" id="jsondata" name="jsondata">
                        </td>
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
<script src="{{URL::asset('/js/admin/rpa/NewVideoHints/add_immed.js')}}"></script>