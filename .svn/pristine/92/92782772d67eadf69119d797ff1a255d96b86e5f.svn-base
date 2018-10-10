    <div class="inner-section">
        <div id="content">
            <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
                <table class="table table-striped table-hover table-bordered table-base">
                    <tbody>
                    <tr>
                        <td><label><span class="must-tag">*</span>客户号</label></td>
                        <td><input type="text" class="form-control" id="khh" name="khh" value="" placeholder="客户号"></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>品种选择</label></td>
                        <td>
                            <select name="tid">
                                @foreach($varietyList as $list)
                                <option value="{{ $list->id }}">{{ $list->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-success btn-md" id="save">提交</button>
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
<script src="{{URL::asset('/js/admin/rpa/Oabremind/oabAdd.js')}}"></script>