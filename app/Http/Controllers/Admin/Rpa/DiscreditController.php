<?php

namespace App\Http\Controllers\admin\rpa;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Rpa\ReleaseTasksRepository as ReleaseTasks;
use App\Repositories\Models\Admin\Rpa\ImmedTasksRepository as ImmedTasks;
use App\Repositories\Models\Admin\Rpa\TasksRepositoryRepository as TasksRepository;

/**
 * rpa 失信控制器
 * @author hsu lay
 * @link www.haqh.com
 * @since 2018/05/15
 */
class DiscreditController extends BaseController
{
    private $model;
    private $app;
    private $tasks;

    //__CONSTRUCT
    public function __CONSTRUCT(ReleaseTasks $model,ImmedTasks $app,TasksRepository $tasks)
    {
        parent::__construct();
        $this->model = $model;
        $this->app = $app;
        $this->tasks = $tasks;
    }

    //RPA list
    public function index(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 失信 任务中心");
        return view('admin/rpa/Discredit/index');
    }

    //RPA add
    public function add(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "添加 失信 任务");
        return view('admin/rpa/Discredit/add');
    }

    //RPA edit
    public function edit(Request $request){
        $id = $request->id;
        $info = $this->tasks->find($id);
        $info = $info['data'];
        $info['week'] = explode(',', $info['week']);
        $info['data'] = json_decode($info['jsondata']);
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 失信 任务");
        return view('admin/rpa/Discredit/edit',['info'=>$info]);
    }

    //RPA add immed
    public function immedtasks(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 失信 页");
        return view('admin/rpa/Discredit/add_immed');
    }

    //RPA insert
    public function insert(Request $request){
        $data = $this->get_params($request, ['name','description','date','week','time','jsondata']);
        $data['week'] = isset($data['week']) ? implode(',',$data['week']) :'';
        $data['created_at'] = $this->getTime();
        $this->log(__CLASS__, __FUNCTION__, $request, "插入 失信 信息");
        $this->immedtask();
        $result = $this->tasks->create($data);
        $data['tid'] = $result['data']['id'];
        return $this->model->create($data);
    }

    //RPA update
    public function update(Request $request){
        $data = $this->get_params($request, ['name','id','description','date','week','time','jsondata'],false);
        $data['week'] = $data['week'] ? implode(',',$data['week']) :'';
        $this->log(__CLASS__, __FUNCTION__, $request, "更新 失信 信息");
        $this->immedtask();
        //查询rpa任务表tid
        $this->model->update($data,$data['id'],'tid');
        return $this->tasks->update($data,$data['id']);
    }

    //delete RPA
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 失信");
        $this->immedtask();
        $this->tasks->delete($id);
        return $this->model->deleteBy([['tid','=',$id]]);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 失信 列表");
        $this->immedtask();
        $this->tasks->delete(explode(',',$ids));
        return $this->model->deleteBy([['tid','in',explode(',',$ids)]]);
    }

    //pagenation
    public function pagination(Request $request){
        return $this->tasks->paginations($request);
    }

    //发布任务
    public function immedtask(){
        $data = [['name'=>'taskdistribution','jsondata'=>'{"name":"SupervisionCFA"}'],['name'=>'taskdistribution','jsondata'=>'{"name":"SupervisionSF"}']];
        return $this->app->insert($data);
    }

    //立即发布任务
    public function insertImmedtasks(Request $request){
        $task = $this->get_params($request, ['name','description','jsondata']);
        $data = ['name'=>$task['name'],'jsondata'=>$task['jsondata']];
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 {$task['name']} 任务");
        return $this->app->create($data);
    }
}
