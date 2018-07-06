<div class="list-title-panel middle-layer">
    <form class="form-inline collapse on" role="form" id="search-group">
        <div class="form-group search-group">
            <label for="name">用户名:</label>
            <input type="text" class="form-control" id="name" placeholder="请输入名称">
            <label for="startTime">时间:</label>
            <input type="text" class="form-control" id="startTime" placeholder="请输入名称">
            <label for="endTime">- </label>
            <input type="text" class="form-control" id="endTime" placeholder="请输入名称">
            <a href="#" class="btn btn-success btn-sm" id="search-btn">搜索</a>
            <input type="reset" class="btn btn-default btn-sm" value="重置">
        </div>
    </form>
    <div class="auxiliary-tool">
        <span class="glyphicon glyphicon-list">列表</span>
        <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="refresh();"><i class="iconfont icon">&#xe6aa;</i></a>
        <a href="javascript:void(0);" class="btn btn-default btn-sm deletebatch">批量删除<i class="iconfont icon">&#xe69d;</i></a>
        <a href="javascript:void(0);" class="btn btn-default btn-sm selectsort" title="降序" type="desc">排序<i class="iconfont icon">&#xe6d0;</i></a>
        <a href="javascript:void(0);" class="btn btn-default btn-sm selectengine" data-toggle="collapse" data-target="#search-group" title="筛选器" type="active">筛选器<i class="iconfont icon">&#xe6d8;</i></a>
        <select name="selectnum" class="btn btn-default btn-sm selectnum">
            <option value="5">分页数：5</option>
            <option value="10" selected>分页数：10</option>
            <option value="20">分页数：20</option>
        </select>
        <a href="javascript:void(0);" class="btn btn-default btn-sm al_read right">全部已读 <i class="iconfont icon">&#xe73a;</i></a>
        <a href="javascript:void(0);" class="btn btn-default btn-sm all_al_read right">标为已读 <i class="iconfont icon">&#xe6e7;</i></a>
    </div>
</div>
<div class="inner-section">
    <div id="content">
        <table id="list-table" class="table table-hover table-bordered table-striped table-base">
            <tbody></tbody>
        </table>
    </div>
    <div id="page"></div>
</div>

<script type="text/javascript" src="{{URL::asset('/include/jquery-bootpag/lib/jquery.bootpag.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/js/admin/sys/message/message.js')}}"></script>