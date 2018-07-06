<?php
namespace App\Http\Controllers\Admin\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Base\LogRepository as Log;

/**
 * LogController log record 
 * @author hsu lay 
 * @link http://blog.mihuyu.top
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class LogController extends BaseController
{
    private $app;

    //__CONSTRUCT
    public function __CONSTRUCT(Log $model)
    {
        parent::__construct();
        $this->app = $model;
    }

    //log list
    public function log_list(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 日志 列表");
        return view('admin/sys/log/list');
    }

    //delete log
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 日志 列表");
        return $this->app->delete($id);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 日志 列表");
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
