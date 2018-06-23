
    <div class="list-title-panel middle-layer">
        <div class="auxiliary-tool">
            <span class="glyphicon glyphicon-list">列表</span>
            <a href="javascript:;" class="btn btn-primary btn-sm" onclick="refresh();"><i class="iconfont icon">&#xe6aa;</i></a>
            <a href="javascript:;" class="btn btn-default btn-sm deletebatch">批量删除<i class="iconfont icon">&#xe69d;</i></a>
            <a url="{{ URL('admin/rpa_center') }}" class="btn btn-primary btn-sm right" onclick="pjaxContent($(this));">任务管理中心</a>
            <a url="{{ URL('admin/rpa_center/taskList') }}" class="btn btn-primary btn-sm right" onclick="pjaxContent($(this));">发布任务一览</a>
        </div>
    </div>
    <div class="inner-section">
        <div id="content">
            <table id="list-table" class="table table-hover table-bordered table-striped table-base">
                <tbody></tbody>
            </table>
        </div>
        <div id="page">
        </div>
    </div>

    <script type="text/javascript" src="{{URL::asset('/include/jquery-bootpag/lib/jquery.bootpag.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/admin/rpa/Center/queue.js')}}"></script>