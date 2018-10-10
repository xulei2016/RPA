<div class="inner-section">
    <div id="content">
        <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
            <table class="table table-striped table-hover table-bordered table-base">
                <tbody>
                <tr>
                    <td><label><span class="must-tag">*</span>品种名称</label></td>
                    <td><input type="text" class="form-control" id="name" name="name" value="{{ $info->name }}" placeholder="品种名称"></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag">*</span>最低资金</label></td>
                    <td><input type="text" class="form-control" id="exfund" name="exfund" value="{{ $info->exfund }}" placeholder="最低资金余额（单位：元）"></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag"></span>备注</label></td>
                    <td><input type="text" class="form-control" id="desc" name="desc" value="{{ $info->desc }}" placeholder="备注"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-success btn-md" id="save">提交</button>
                        <input type="text" class="hidden" id="id" name="id" value="{{ $info->id }}">
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
<script src="{{URL::asset('/js/admin/rpa/Oabremind/varietyEdit.js')}}"></script>