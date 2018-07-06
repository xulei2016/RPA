<?php
namespace App\Http\Controllers\Admin\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Base\ErrorLogRepository as Error;

/**
 * ErrorLogController
 * @author hsu lay
 * @link http://blog.mihuyu.top
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class ErrorLogController extends BaseController
{
    private $app;

    //__CONSTRUCT
    public function __CONSTRUCT(Error $model)
    {
        parent::__construct();
        $this->app = $model;
    }

    //log list
    public function log_list(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 错误日志 列表");
        return view('admin/sys/error/list');
    }

    //delete log
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 错误日志 列表");
        return $this->app->delete($id);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 错误日志 列表");
        return $this->app->delete(explode(',',$ids));
    }

    //log_pagination
    public function log_pagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = $this->getPagingList($selectInfo, ['account'=>'like','from_add_time'=>'>=','to_add_time'=>'<=']);
        $sort = ['id', $selectInfo['sort']];
        return $this->app->paginate($condition, $sort, 10);
    }
}
