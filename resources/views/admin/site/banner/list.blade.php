<div class="list-title-panel middle-layer">
    <div class="auxiliary-tool">
        <span class="glyphicon glyphicon-list">列表</span>
        <a href="javascript:;" class="btn btn-primary btn-sm" onclick="refresh();"><i class="iconfont icon">&#xe6aa;</i></a>
        <a url="{{ URL('admin/banner/add_banner') }}" onclick="operation($(this));" class="btn btn-primary btn-sm right">添加banner</a>
    </div>
</div>
<div class="inner-section">
    <div id="content">
        <table id="list-table" class="table table-hover table-bordered table-striped table-base">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>缩略图</th>
                    <th>名称</th>
                    <th>跳转地址</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
                @if (!$bannerList->isEmpty())
                    @foreach ($bannerList as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td><img class="lightbox" src="{{$list->thumb}}" width="30px"/></td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->url or '--'}}</td>
                        <td>{{$list->sort}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="javascript:void(0);" url="{{ URL('admin/banner/edit_banner/'.$list->id)}}" onclick="operation($(this));">编辑</a>
                            <a class="btn btn-danger btn-sm delete" href="javascript:void(0);" id="{{$list->id}}">删除</a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr><td colspan="6"><p class="text-danger">暂无数据</p></td></tr>
                @endif
            </tbody>
        </table>
    </div>
    {{-- <div id="page">
        {{ $bannerList->links() }}
    </div> --}}
</div>

<script src="{{URL::asset('/js/admin/main.js')}}"></script>
<script src="{{URL::asset('/js/admin/site/banner/banner_list.js')}}"></script>