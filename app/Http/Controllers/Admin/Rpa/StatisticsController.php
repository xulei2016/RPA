<?php

namespace App\Http\Controllers\admin\rpa;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Rpa\LogRepository as log;

/**
 * rpa 日志模块
 * @author hsu lay
 * @since 2018/05/15
 */
class StatisticsController extends BaseController
{
    private $model;

    //__CONSTRUCT
    public function __CONSTRUCT(log $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    //统计中心
    public function index(Request $request){
        $count = $this->model->count();
        $info['success'] = $this->model->count([['state','=','成功']]);
        $info['fail'] = $this->model->count([['state','=','失败']]);
        $info['unknown'] = $count['data'] - $info['success']['data'] - $info['fail']['data'];
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 rpa 统计中心");
        return view('admin/rpa/statistics/index', ['info' => $info]);
    }

    //rpa运行日志
    public function rpa_log(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 rpa 日志中心");
        return view('admin/rpa/statistics/log');
    }

    //异步分页数据
    public function pagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = $this->getPagingList($selectInfo, ['name'=>'like','from_time'=>'>=','to_time'=>'<=']);
        $sort = ['id', $selectInfo['sort']];
        $num = $selectInfo['num'];
        return $this->model->paginate($condition, $sort, $num);
    }
}
