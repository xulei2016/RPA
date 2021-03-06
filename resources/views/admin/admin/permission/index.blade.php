<div class="list-title-panel middle-layer">
    <div class="auxiliary-tool">
        <span class="glyphicon glyphicon-list">列表</span>
    </div>
</div>
<div class="inner-section">
    <div id="content">
        <ul class="nav nav-tabs">
            @foreach ($menus as $menu)
            <li class="active"><a href="#{{$menu['name']}}" data-toggle="tab"><b>{{$menu['description']}}</b></a></li>
            @endforeach
        </ul>
        <div id="myTabContent" class="tab-content">
            @foreach ($menus as $menu){{-- 顶级菜单 --}}
            <div class="menu per-menu per-title tab-pane in active" id="{{$menu->id}}" sort="{{$menu->sort}}" name="{{$menu->name}}" table="{{$menu->table}}" desc="{{$menu->description}}">
                @if ($menu['menu'])
                @foreach ($menu['menu'] as $list){{-- 子集菜单 --}}
                    <div class="menu per-title" id="{{$list->id}}" sort="{{$list->sort}}" name="{{$list->name}}" table="{{$list->table}}" desc="{{$list->description}}"><span class="iconfont icon">&#xe6b9;</span><b>{{$list->description}}</b>
                    @if ($list['menu'])
                        <div class="menu menus">
                        @if ($list['menu'])
                        @foreach ($list['menu'] as $sublist){{-- 二级菜单 --}}
                            <div class="menu per-title" id="{{$sublist->id}}" sort="{{$sublist->sort}}" name="{{$sublist->name}}" table="{{$sublist->table}}" desc="{{$sublist->description}}"><span class="iconfont icon">&#xe6b9;</span><b>{{$sublist->description}}</b>
                                <ul class="menu per-menu menus">
                                    @if ($sublist['menu'])
                                    @foreach ($sublist['menu'] as $act){{-- 方法展示 --}}
                                        <li class="menu per-title" id="{{$act->id}}" sort="{{$act->sort}}" name="{{$act->name}}" table="{{$act->table}}" desc="{{$act->description}}">{{$act->description}}</li>
                                    @endforeach
                                    @else
                                        <li class="menu per-title" table="{{$sublist->table + 1}}">暂无</li>
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                        @else
                            <div class="menu per-title" table="{{$list->table + 1}}">暂无</div>
                        @endif
                        </div>
                    @else
                        <div class="menu menus per-title" table="{{$list->table + 1}}">暂无</div>
                    @endif
                    </div>
                @endforeach
                @endif
            </div>
            @endforeach
        </div>
        <div id="menuInfo" class="hidden">
            <div class="tab-pane">
                <div class="desc"></div>
                <div class="operation">
                    <a class="add-menu" href="javascript:void(0);" title="增加菜单"><i class="icon iconfont">&#xe6f9;</i></a>
                    <a class="edit-menu" href="javascript:void(0);" title="修改菜单"><i class="icon iconfont">&#xe6fb;</i></a>
                    <a class='del-menu' href="javascript:void(0);" title="删除菜单"><i class="icon iconfont">&#xe6f6;</i></a>
                </div>
            </div>
        </div>
        <div id="menuOperation" class="hidden">
            <div class="tab-pane">
                <form id="form">
                    <div class="title"><b>--添加菜单--</b></div>
                    <b> 上级菜单：</b><span id="supLevel"></span><br/>
                    <label><span class="must-tag">*</span><b>菜单名称：</b><input type="text" id="name" name="name" /></label><br/>
                    <label><span class="must-tag">*</span><b>菜单描述：</b><input type="text" id="desc" name="desc"/></label><br/>
                    <b>状态：</b><label><input type="radio" name="status" value="1" checked/>开启</label> <label><input type="radio" name="status" value='0'/>关闭</label><br/>
                    <label><span class="must-tag">*</span><b>菜单排序：</b><input type="text" id="sort" name="sort"/></label><br/>
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary" id="submit">提 交</a><br/>
                </form>
            </div>
        </div>
    </div>
</div>

<link href="{{URL::asset('/css/admin/admin/permission/permission.css')}}" rel="stylesheet">

<script src="{{URL::asset('/js/admin/admin/permission/permission.js')}}"></script>