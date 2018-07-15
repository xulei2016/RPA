<div class="list-title-panel middle-layer"></div>
<div class="inner-section">
    <div id="content">
        <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
            <table class="table table-striped table-hover table-bordered">
                <tbody>
                <tr>
                    <td>
                        <label for="mode">
                            <select name="mode" id="mode" class="form-control">
                                <option value="1">个人通知</option>
                                <option value="2">角色通知</option>
                                <option value="3" selected>全体通知</option>
                            </select>
                        </label>
                    </td>
                </tr>
                <tr class="hidden select-user">
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="type">
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="form-control" name="title" id="title" placeholder="请输入标题" style="width: 100%;">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="editor">
                            <p>请编辑推送内容</p>
                        </div>
                        <textarea class="hidden" name="content" id="editorContent"></textarea>
                    
                        <!-- 注意， 只需要引用 JS，无需引用任何 CSS ！！！-->
                        <script type="text/javascript" src="{{URL::asset('/include/wangEditor/wangEditor.min.js')}}"></script>
                        <script type="text/javascript" src="{{URL::asset('/include/wangEditor/wangEditor-fullscreen.js')}}"></script>
                        <link rel="stylesheet" type="text/css" href="{{URL::asset('/include/wangEditor/wangEditor-fullscreen.css')}}" />
                        <script type="text/javascript">
                            var E = window.wangEditor
                            var editor = new E('#editor')
                            editor.customConfig.uploadImgShowBase64 = true
                            editor.customConfig.onchange = function (html) {
                                $('#editor').next().val(html)
                            }
                            editor.create()
                            E.fullscreen.init('#editor');
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" class="btn btn-primary btn-block" value="提交" id="save">
                        <input type="button" class="btn btn-default btn-block" value="保存">
                    </td>
                </tr>
            </tbody>
            </table>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{URL::asset('/include/jquery-bootpag/lib/jquery.bootpag.min.js')}}"></script>

<script src="{{URL::asset('/include/jquery-form/jquery.form.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/localization/messages_zh.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/js/admin/sys/message/send.js')}}"></script>