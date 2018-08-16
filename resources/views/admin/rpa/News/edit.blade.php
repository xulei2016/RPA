    <div class="inner-section">
        <div id="content">
            <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
                <table class="table table-striped table-hover table-bordered table-base">
                    <tbody>
                    <tr>
                        <td><label><span class="must-tag">*</span>任务名称</label></td>
                        <td><input type="text" class="form-control" id="name" name="name" value="zwtx" placeholder="任务名称" disabled></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>任务类型</label></td>
                        <td><input type="checkbox" class="my-switch" id="type" name="type" value="1" @if(isset($info->date)) checked @endif></td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>日期设定</label></td>
                        <td>
                            <div class="date @if(!$info->date) hidden @endif">
                                <input type="text" class="form-control" id="date" name="date" value="{{$info->date}}" placeholder="日期设定">
                            </div>
                            <div class="week @if($info->date) hidden @endif">
                                <label><input type="checkbox" class="select-single" name="week[]" value="0" @if(in_Array('0',$info->week))checked @endif>星期日</label>
                                <label><input type="checkbox" class="select-single" name="week[]" value="1" @if(in_Array('1',$info->week))checked @endif>星期一</label>
                                <label><input type="checkbox" class="select-single" name="week[]" value="2" @if(in_Array('2',$info->week))checked @endif>星期二</label>
                                <label><input type="checkbox" class="select-single" name="week[]" value="3" @if(in_Array('3',$info->week))checked @endif>星期三</label>
                                <label><input type="checkbox" class="select-single" name="week[]" value="4" @if(in_Array('4',$info->week))checked @endif>星期四</label>
                                <label><input type="checkbox" class="select-single" name="week[]" value="5" @if(in_Array('5',$info->week))checked @endif>星期五</label>
                                <label><input type="checkbox" class="select-single" name="week[]" value="6" @if(in_Array('6',$info->week))checked @endif>星期六</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>目标站点</label></td>
                        <td>
                            @foreach($info->data as $k => $data)
                            @if($loop->first)
                            <div>
                                <input type="text" class="form-control" id="web" name="web" value="{{$k}}" placeholder="例如：https://wallstreetcn.com/">
                                <input type="text" class="form-control" id="num" name="num" value="{{$data}}" placeholder="文章数量">
                                <a href="javascript:void(0);" id="add_web" class="btn btn-sm btn-success">增加</a>
                            </div>
                            @else
                            <div>
                                <input type="text" class="form-control" name="web" value="{{$k}}" placeholder="站点名称">
                                <input type="text" class="form-control" name="num" value="{{$data}}" placeholder="文章数量">
                                <a href="javascript:void(0);" id="del_web" class="btn btn-sm btn-danger">删除</a>'
                            </div>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>执行时间</label></td>
                        <td>
                            <input type="text" class="form-control" id="time" name="time" value="{{$info->time}}" placeholder="点击按钮添加时间">
                            <a href="javascript:void(0);" id="add_time" class="btn btn-sm btn-primary">00:00:00</a>
                        </td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag">*</span>任务描述</label></td>
                        <td><textarea type="text" class="form-control" id="description" name="description" placeholder="任务描述">{{$info->description}}</textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-success btn-md" id="save">提交</button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$info->id}}" >
                            <input type="hidden" class="form-control" id="jsondata" name="jsondata" value="{{$info->jsondata}}">
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
<script src="{{URL::asset('/js/admin/rpa/News/edit.js')}}"></script>