<div class="inner-section">
    <div id="content">
        <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
            <table class="table table-striped table-hover table-bordered table-base">
                <tbody>
                <tr>
                    <td class="td1"><label><span class="must-tag">*</span>名称</label></td>
                    <td class="td2"><input type="text" class="form-control" id="name" name="name" placeholder="幻灯片名称"></td>
                    <td class="td3"></td>
                </tr>

                <tr>
                    <td><label for="imgurl"><span class="must-tag">*</span>图片上传</label></td>
                    <td><input class="imgurl form-control" accept="image/*" title="支持jpg、jpeg、gif、png格式，文件小于5M" tabindex="3" type="file" id="imgurl" name="imgurl" size="3">*建议尺寸：640*350px</td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="url"><span class="must-tag">&nbsp;&nbsp;</span>链接地址</label></td>
                    <td><input type="text" class="form-control" name="url" id="url" placeholder="如:http://www.×××××.com"></td>
                    <td></td>
                </tr>

                <tr>
                    <td><label><span class="must-tag">&nbsp;&nbsp;</span>打开方式</label></td>
                    <td>
                        <label> <input type="radio" name="type" value="1" checked="">本页刷新</label>
                        <label> <input type="radio" name="type" value="0">新开窗口</label>

                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="sort"><span class="must-tag">&nbsp;&nbsp;</span>排序系数</label></td>
                    <td><input type="text" class="form-control" name="sort" id="sort" placeholder="排序系数" value="1"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-md" id="save">提交</button>
                    </td>
                    <td></td>
                </tr>
            </tbody>
            </table>
        </form>
    </div>
</div>

<script src="{{URL::asset('/include/jquery-form/jquery.form.js')}}"></script>
<script src="{{URL::asset('/include/jquery-validate/jquery.validate.js')}}"></script>
<script src="{{URL::asset('/js/admin/site/banner/addBanner.js')}}"></script>