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
                        <td><label><span class="must-tag"></span>任务状态</label></td>
                        <td><input type="text" id="state" name="state" value="@if(isset($info->state)) {{$info->state}} @endif" placeholder="任务状态"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>参数设置</label></td>
                        <td>
                            @if($info->data)
                            @foreach($info->data as $k => $v)
                            @if($loop->first)
                            <div>
                                <input type="text" class="form-control" name='key' value="{{$k}}">
                                <input type="text" class="form-control" name='val' value="{{$v}}">
                                <a href="javascript:void(0);" id="add_web" class="btn btn-sm btn-success">增加</a>
                            </div>
                            @else
                            <div>
                                <input type="text" class="form-control" name='key' value="{{$k}}">
                                <input type="text" class="form-control" name='val' value="{{$v}}">
                                <a href="javascript:void(0);" id="del_web" class="btn btn-sm btn-danger">删除</a>'
                            </div>
                            @endif
                            @endforeach
                            @else
                            <div>
                                <input type="text" class="form-control" name='key' value="" placeholder="暂无参数">
                                <input type="text" class="form-control" name='val' value="" placeholder="暂无参数">
                                <a href="javascript:void(0);" id="add_web" class="btn btn-sm btn-success">增加</a>
                            </div>
                            @endif
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>执行时间</label></td>
                        <td>
                            <input type="text" class="form-control" id="time" name="time" value="{{$info->time}}" placeholder="任务时间">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>TID</label></td>
                        <td>
                            <input type="text" class="form-control" id="tid" name="tid" value="{{$info->tid}}" placeholder="TID">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-success btn-md" id="save">提交</button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$info->id}}" >
                            <input type="hidden" class="form-control" id="jsondata" name="jsondata" value="{{$info->jsondata}}">
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
<script src="{{URL::asset('/js/admin/rpa/Center/editQueue.js')}}"></script>