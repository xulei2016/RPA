<div class="inner-section">
    <div id="content">
        <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
            <table class="table table-striped table-hover table-bordered table-base">
                <tbody>
                <tr>
                    <td><label><span class="must-tag">*</span>名称</label></td>
                    <td><input type="text" class="form-control" id="name" name="name" value="{{$info->name}}" placeholder="角色名称"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag"></span>状态</label></td>
                    <td><input type="checkbox" class="my-switch" name="type" value="1" @if(1==$info->type)checked @endif></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label><span class="must-tag"></span>描述</label></td>
                    <td><textarea type="text" class="form-control" id="description" name="description" placeholder="描述信息">{{$info->description}}</textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="sort"><span class="must-tag">&nbsp;&nbsp;</span>排序系数</label></td>
                    <td><input type="text" class="form-control" name="sort" id="sort" placeholder="排序系数" value="{{$info->sort}}"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <input type="hidden" name="id" value="{{$info->id}}">
                        <button type="button" class="btn btn-success btn-md" id="save">提交</button>
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
<script src="{{URL::asset('/js/admin/admin/role/edit_role.js')}}"></script>