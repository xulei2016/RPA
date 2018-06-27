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
        //饼图
        $count = $this->model->count();
        $info['success'] = $this->model->count([['state','=','成功']]);
        $info['fail'] = $this->model->count([['state','=','失败']]);
        $info['unknown'] = $count['data'] - $info['success']['data'] - $info['fail']['data'];

        //条图
        $tasks = [];
        $tasks['tasks'] = ['taskdistribution','bak','zwtx','IDidentification','sdxTestWirte','SupervisionSF','SupervisionCFA','CustomerGroupings'];
        foreach($tasks['tasks'] as $task){
            $fail = [['name','=',$task],['state','=','失败']];
            $success = [['name','=',$task],['state','=','成功']];
            $fail_count = $this->model->count($fail);
            $success_count = $this->model->count($success);
            $tasks['fail'][] = $fail_count['data'];
            $tasks['success'][] = $success_count['data'];
        }
        $tasks['fail'] = implode(',', $tasks['fail']);
        $tasks['success'] = implode(',', $tasks['success']);

        $this->log(__CLASS__, __FUNCTION__, $request, "查看 rpa 统计中心");
        return view('admin/rpa/statistics/index', ['info' => $info, 'tasks' => $tasks]);
    }

    //rpa运行日志
    public function rpa_log(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 rpa 日志中心");
        return view('admin/rpa/statistics/log');
    }

    //rpa获取数据
    public function getData(Request $request){
        //按天数统计
        $day = $request->day ? $request->day : 7 ;
        $task = $request->task ? $request->task : 'zwtx' ;
        $time = date('Y-m-d h:i:s',strtotime('-{$day} day'));
        $condition = [['time','>=',$time],['name','=',$task]];
        $data = $this->model->findAllBy($condition);
        $data = $this->get_one($data['data']);
        $times = [];
        foreach($data as $param){
            $time = date('Y-m-d', strtotime($param['time']));
            if(!in_array($time, $times)){
            }
            if($param['state'] == '失败'){
                $times[$time]['fail'][] = $param['id'];
            }else{
                $times[$time]['success'][] = $param['id'];
            }
        }
        return $times;
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
