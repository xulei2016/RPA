<?php

namespace App\Http\Controllers\Admin\Rpa;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Rpa\ImmedTasksRepository as ImmedTasks;
use App\Repositories\Models\Admin\Rpa\OabremindingRepository as oabreminding;
use App\Repositories\Models\Admin\Rpa\CapitalreferRepository as capitalrefer;
use App\Repositories\Models\Admin\Rpa\ReleaseTasksRepository as ReleaseTasks;
use App\Repositories\Models\Admin\Rpa\TasksRepositoryRepository as TasksRepository;

/**
 * 资金可用余额提醒管理
 * @since 2018/10
 * @author hus lay
 * 
 */
class OabremindingController extends BaseController
{
    private $model;

    private $tasks;

    private $release;
    
    private $app;

    private $capital;

    //__CONSTRUCT
    public function __CONSTRUCT(Oabreminding $model, Capitalrefer $capital, ImmedTasks $app, TasksRepository $tasks, ReleaseTasks $release)
    {
        parent::__construct();
        $this->model = $model;
        $this->app = $app;
        $this->tasks = $tasks;
        $this->release = $release;
        $this->capital = $capital;
    }
    
    //RPA list
    public function index(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 资金查询任务");
        return view('admin/rpa/Oabremind/index');
    }

    //RPA add
    public function add(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "添加 资金查询任务");
        return view('admin/rpa/Oabremind/add');
    }

    //RPA edit
    public function edit(Request $request){
        $id = $request->id;
        $info = $this->tasks->find($id);
        $info = $info['data'];
        $info['week'] = explode(',', $info['week']);
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 资金查询任务");
        return view('admin/rpa/Oabremind/edit',['info'=>$info]);
    }

    //RPA add immed
    public function immedtasks(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 资金查询任务 页");
        return view('admin/rpa/Oabremind/add_immed');
    }

    //RPA insert
    public function insert(Request $request){
        $data = $this->get_params($request, ['description','date','week','time','jsondata']);
        $data['name'] = 'OABReminding';
        $data['week'] = isset($data['week']) ? implode(',',$data['week']) :'';
        $data['created_at'] = $this->getTime();
        $this->log(__CLASS__, __FUNCTION__, $request, "插入 资金查询任务 信息");
        $this->immedtask();
        $result = $this->tasks->create($data);
        $data['tid'] = $result['data']['id'];
        return $this->release->create($data);
    }

    //RPA update
    public function update(Request $request){
        $data = $this->get_params($request, ['id','description','date','week','time','jsondata'],false);
        $data['name'] = 'OABReminding';
        $data['week'] = $data['week'] ? implode(',',$data['week']) :'';
        $this->log(__CLASS__, __FUNCTION__, $request, "更新 资金查询任务 信息");
        $this->immedtask();
        //查询rpa任务表tid
        $this->release->update($data,$data['id'],'tid');
        return $this->tasks->update($data,$data['id']);
    }

    //delete RPA
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 资金查询任务");
        $this->immedtask();
        $this->tasks->delete($id);
        return $this->release->deleteBy([['tid','=',$id]]);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 资金查询任务 列表");
        $this->immedtask();
        $this->tasks->delete(explode(',',$ids));
        return $this->release->deleteBy([['tid','in',explode(',',$ids)]]);
    }

    //pagenation
    public function pagination(Request $request){
        $condition = [['name','=','OABReminding']];
        $sort = ['id','asc'];
        return $this->tasks->paginate($condition, $sort, 10);
    }

    //发布任务
    public function immedtask(){
        $data = ['name'=>'taskdistribution','jsondata'=>'{"name":"OABReminding"}'];
        $this->app->create($data);
    }

    //立即发布任务
    public function insertImmedtasks(Request $request){
        $task = $this->get_params($request, ['description','jsondata']);
        $task['name'] = 'OABReminding';
        $data = ['name'=>$task['name']];
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 {$task['name']} 任务");
        return $this->app->create($data);
    }

    //////////////////////////////////////////////////////客户查询////////////////////////////////////////////////////////////////////

    //RPA list
    public function oabIndex(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 可用资金查询");
        return view('admin/rpa/Oabremind/list');
    }

    //RPA add
    public function oabAdd(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "添加 可用资金查询");
        $varietyList = $this->capital->All();
        return view('admin/rpa/Oabremind/oabAdd',['varietyList' => $varietyList['data']]);
    }

    //RPA insert
    public function oabInsert(Request $request){
        $data = $this->get_params($request, ['khh','tid']);
        $data['created_at'] = $this->getTime();
        $this->log(__CLASS__, __FUNCTION__, $request, "插入 可用资金查询 信息");
        $this->model->create($data);
        return $this->oabImmedtask($data['khh']);
    }
        
    /**
     * typeChange
     */
    public function oabTypeChange(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 可用资金查询 状态");
        return $this->model->update(['state'=>2], $id, 'khh');
    }

    //delete RPA
    public function oabDelete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 可用资金查询 客户");
        return $this->model->deleteBy([['khh','=',$id]]);
    }
    
    //delete_all
    public function oabDeleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 可用资金查询 列表");
        $this->oabImmedtask();
        $this->tasks->delete(explode(',',$ids));
        return $this->model->deleteBy([['tid','in',explode(',',$ids)]]);
    }

    //pagenation
    public function oabPagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = [];
        $customer = $selectInfo['customer'];
        if($customer && is_numeric( $customer )){
            array_push($condition,  array('rpa_oabremindings.khh', '=', $customer));
        }elseif(!empty( $customer )){
            array_push($condition,  array('rpa_oabremindings.name', '=', $customer));
        }
        if($selectInfo['from_created_at']){
            array_push($condition, ['rpa_oabremindings.created_at','>=',$selectInfo['from_created_at']]);
        }
        if($selectInfo['to_created_at']){
            array_push($condition, ['rpa_oabremindings.created_at','<=',$selectInfo['to_created_at']]);
        }
        if($selectInfo['status']){
            array_push($condition, ['rpa_oabremindings.status','=',$selectInfo['status']]);
        }
        $num = $selectInfo['num'];
        $sort = ['rpa_oabremindings.created_at', $selectInfo['sort']];
        $columns = ['rpa_oabremindings.*','a.name as cname','a.exfund'];
        $table = [
            [
                'table'=>'rpa_capitalrefers as a',
                'left' => 'rpa_oabremindings.tid',
                'mode' => '=',
                'right' => 'a.id',
            ]
        ];
        return $this->model->left_paginate($table, $condition, $sort, $num, $columns);
    }

    //发布任务
    public function oabImmedtask($khh){
        $data = ['name'=>'OABReminding','jsondata'=>"{'khh':$khh}"];
        return $this->app->create($data);
    }


    /////////////////////////////////////////////////////////品种操作/////////////////////////////////////////////////////

    
    //RPA list
    public function varietyList(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 品种");
        return view('admin/rpa/Oabremind/varietyList');
    }

    //RPA add
    public function varietyAdd(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "添加 品种");
        return view('admin/rpa/Oabremind/varietyAdd');
    }

    //RPA edit
    public function varietyEdit(Request $request){
        $id = $request->id;
        $info = $this->capital->find($id);
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 品种");
        return view('admin/rpa/Oabremind/varietyEdit',['info'=>$info['data']]);
    }

    //RPA insert
    public function varietyInsert(Request $request){
        $data = $this->get_params($request, ['desc','name','exfund']);
        $this->log(__CLASS__, __FUNCTION__, $request, "插入 品种");
        return $this->capital->create($data);
    }

    //RPA update
    public function varietyUpdate(Request $request){
        $data = $this->get_params($request, ['id','desc','name','exfund'],false);
        $this->log(__CLASS__, __FUNCTION__, $request, "更新 品种");
        return $this->capital->update($data,$data['id']);
    }

    //delete RPA
    public function varietyDelete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 品种");
        return $this->capital->delete($id);
    }

    //pagenation
    public function varietyPagination(Request $request){
        $condition = [];
        $sort = ['id','asc'];
        return $this->capital->paginate($condition, $sort, 10);
    }
}
