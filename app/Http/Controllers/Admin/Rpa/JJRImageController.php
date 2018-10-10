<?php

namespace App\Http\Controllers\admin\rpa;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Rpa\ReleaseTasksRepository as ReleaseTasks;
use App\Repositories\Models\Admin\Rpa\ImmedTasksRepository as ImmedTasks;
use App\Repositories\Models\Admin\Rpa\TasksRepositoryRepository as TasksRepository;

/**
 * rpa 居间人影像资料控制器
 * @author hsu lay
 * @link www.haqh.com
 * @since 2018/05/15
 */
class JJRImageController extends BaseController
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
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 居间人影像资料 任务中心");
        return view('admin/rpa/JJRImg/index');
    }

    //RPA add
    public function add(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "添加 居间人影像资料 任务");
        return view('admin/rpa/JJRImg/add');
    }

    //RPA edit
    public function edit(Request $request){
        $id = $request->id;
        $info = $this->tasks->find($id);
        $info = $info['data'];
        $info['week'] = explode(',', $info['week']);
        $info['data'] = json_decode($info['jsondata']);
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 居间人影像资料 任务");
        return view('admin/rpa/JJRImg/edit',['info'=>$info]);
    }

    //RPA add immed
    public function immedtasks(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 居间人影像资料 页");
        return view('admin/rpa/JJRImg/add_immed');
    }

    //RPA insert
    public function insert(Request $request){
        $data = $this->get_params($request, ['description','date','week','time','jsondata']);
        $data['name'] = 'Lcztcx';
        $data['week'] = isset($data['week']) ? implode(',',$data['week']) :'';
        $data['created_at'] = $this->getTime();
        $this->log(__CLASS__, __FUNCTION__, $request, "插入 居间人影像资料 信息");
        $this->immedtask();
        $result = $this->tasks->create($data);
        $data['tid'] = $result['data']['id'];
        return $this->model->create($data);
    }

    //RPA update
    public function update(Request $request){
        $data = $this->get_params($request, ['id','description','date','week','time','jsondata'],false);
        $data['name'] = 'Lcztcx';
        $data['week'] = $data['week'] ? implode(',',$data['week']) :'';
        $this->log(__CLASS__, __FUNCTION__, $request, "更新 居间人影像资料 信息");
        $this->immedtask();
        //查询rpa任务表tid
        $this->model->update($data,$data['id'],'tid');
        return $this->tasks->update($data,$data['id']);
    }

    //delete RPA
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 居间人影像资料");
        $this->immedtask();
        $this->tasks->delete($id);
        return $this->model->deleteBy([['tid','=',$id]]);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 居间人影像资料 列表");
        $this->immedtask();
        $this->tasks->delete(explode(',',$ids));
        return $this->model->deleteBy([['tid','in',explode(',',$ids)]]);
    }

    //pagenation
    public function pagination(Request $request){
        $condition = [['name','=','Lcztcx']];
        $sort = ['id','asc'];
        return $this->tasks->paginate($condition, $sort, 10);
    }

    //发布任务
    public function immedtask(){
        $data = ['name'=>'taskdistribution','jsondata'=>'{"name":"Lcztcx"}'];
        $this->app->create($data);
    }

    //立即发布任务
    public function insertImmedtasks(Request $request){
        $task = $this->get_params($request, ['description','jsondata']);
        $task['name'] = 'Lcztcx';
        $data = ['name'=>$task['name'],'jsondata'=>$task['jsondata']];
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 {$task['name']} 任务");
        return $this->app->create($data);
    }
}
