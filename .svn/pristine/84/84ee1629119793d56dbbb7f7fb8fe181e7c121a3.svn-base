/**
 * barlist
 * @author hsu lay
 */
$(function(){
    var info = [];

    //H5拖动初始化
    $( "#container .inner-content .inner-section #sortable").sortable({
        //允许sortable对象连接另一个sortable对象
        connectWith: ".connectedSortable",
        //定义在开始排序动作时，如果的样式。
        cursor: 'move',
        //克隆
        // helper: "clone",
        //占位符
        placeholder: "ui-state-highlight",
        //拖动到新的位置时会有一个动画效果
        revert: false,
        //自动滚动
        scroll: true,
        //页面滚动速度
        scrollSpeed: 40,
        //拖动时样式的透明度
        opacity: 0.6,
        //结束触发事件
        update: function(event, ui) {
            //拖动对象.
            var id = ui.item.attr('m-id');
            //顶部导航变化
            var team_id = ui.item.parents('td').attr('top-id');
            //元素目标位置
            var sort = ui.item.parent().children('tr').index(ui.item);

            $.ajax({
                url: '/admin/bar_list/update_nav',
                type: 'post',
                data: {id:id, team_id:team_id, sort:sort},
                dataType: 'json',
                success:function(json,statusText){
                    console.log(json);
                }
            });
        },
    }).disableSelection();

    //H5拖动初始化
    $( "#container .inner-content .inner-section #sortBody").sortable({
        //允许sortable对象连接另一个sortable对象
        connectWith: ".connectedSortBody",
        // connectWith: ".connectedSortable, .connectedSortable-new",
        //定义在开始排序动作时，如果的样式。
        cursor: 'move',
        //占位符
        placeholder: "ui-state-highlight",
        //拖动到新的位置时会有一个动画效果
        revert: false,
        //自动滚动
        scroll: true,
        //页面滚动速度
        scrollSpeed: 40,
        //拖动时样式的透明度
        opacity: 0.6,
        //结束触发事件
        update: (event, ui) => {
            //拖动对象.
            var id = ui.item.attr('t-id');
            //元素目标位置
            var sort = ui.item.parent().children('tr').index(ui.item);

            $.ajax({
                url: '/admin/bar_list/update_top_nav',
                type: 'post',
                data: {id:id, sort:sort},
                dataType: 'json',
                success:function(json,statusText){
                    console.log(json);
                }
            });
        },
    }).disableSelection();

    //初始化
    function init(){
        //输入框修改事件、
        $( "#container .inner-content .inner-section #sortable input").bind('change', function(){
            let id = $(this).parents('tr').attr('m-id');
            let input_name = $(this).attr('name');
            let value = $(this).val();
            let data = {id:id};
            data[input_name] =  value;
            if(input_name == 'status'){
                value = $(this).is(":checked") ? '1' : '0' ;
                data = {id:id, status:value};
            }
            $.ajax({
                url: '/admin/bar_list/update_nav_menu',
                type: 'post',
                data: data,
                dataType: 'json',
                success:function(json,statusText){
                    console.log(json);
                }
            });
        });
    }

    init();
});