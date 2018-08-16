    <div class="inner-section">
        <div id="content">
            <form action="#" method="post" id="myForm" enctype="multipart/form-data" novalidate="novalidate">
                <table class="table table-striped table-hover table-bordered table-base">
                    <tbody>
                    <tr>
                        <td><label><span class="must-tag"></span>标题</label></td>
                        <td>{{ $message->title }}</td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>消息类型</label></td>
                        <td>{{ $message->name }}</td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>状态</label></td>
                        <td>
                            @if($message->is_revoke == 0)
                            <span class="text-success">正常</span>
                            @else
                            <span class="text-danger">已撤销</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>消息分发类型</label></td>
                        <td>
                            @if($message->mode == 1)
                            个人通知
                            @elseif($message->mode == 2)
                            角色通知
                            @else
                            全体通知
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><label><span class="must-tag"></span>内容</label></td>
                        <td>
                            {!! $message->content !!}
                        </td>
                    </tr>
                </tbody>
                </table>
            </form>
        </div>
    </div>