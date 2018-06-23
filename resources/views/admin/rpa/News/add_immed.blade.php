    <div class="inner-section">
        <div id="content">
            <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
                <table class="table table-striped table-hover table-bordered table-base">
                    <tbody>
                    <tr>
                        <td><label><span class="must-tag">*</span>任务名称</label></td>
                        <td><input type="text" class="form-control" id="name" name="name" value="zwtx" placeholder="任务名称" disabled></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>目标站点</label></td>
                        <td>
                            <div class="target_web">
                                <input type="text" class="form-control" id="web" name="web" placeholder="例如：https://wallstreetcn.com/">
                                <input type="text" class="form-control" id="num" name="num" placeholder="文章数量">
                                <a href="javascript:void(0);" id="add_web" class="btn btn-sm btn-primary">增加</a>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>任务描述</label></td>
                        <td><textarea type="text" class="form-control" id="description" name="description" placeholder="任务描述"></textarea></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-md" id="save">立即发布</button>
                            <input type="hidden" class="form-control" id="jsondata" name="jsondata">
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
<script src="{{URL::asset('/js/admin/rpa/News/add_immed.js')}}"></script>