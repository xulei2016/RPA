<?php

namespace App\Http\Controllers\admin\rpa;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Base\AdminRepository as Admin;
use App\Repositories\Models\Admin\Rpa\TimeTasksRepository as TimeTasks;
use App\Repositories\Models\Admin\Rpa\ImmedTasksRepository as ImmedTasks;
use App\Repositories\Models\Admin\Rpa\MaintenanceRepository as Maintenance;
use App\Repositories\Models\Admin\Rpa\TasksRepositoryRepository as TasksRepository;

/**
 * rpa manage center
 * @author hsu lay
 * @since 2018/5/15
 * @link www.haqh.com
 */
class RpaController extends BaseController
{
    private $model;
    private $app;
    private $task;
    private $queue;
    private $admin;

    //__CONSTRUCT
    public function __CONSTRUCT(Maintenance $model, ImmedTasks $app, TasksRepository $Task, TimeTasks $queue, Admin $admin)
    {
        parent::__construct();
        $this->model = $model;
        $this->task = $Task;
        $this->queue = $queue;
        $this->app = $app;
        $this->admin = $admin;
    }

    //RPA list
    public function index(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 rpa 任务中心");
        return view('admin/rpa/Center/index');
    }

    //task list
    public function taskList(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 发布任务 总览");
        return view('admin/rpa/Center/taskList');
    }

    //RPA add
    public function add(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "添加 rpa 任务");
        //通知角色
        $condition = [['type','=','1']];
        $admin = $this->admin->findAllBy($condition);
        return view('admin/rpa/Center/add',['admins'=>$admin['data']]);
    }

    //RPA edit
    public function edit(Request $request){
        $id = $request->id;
        $info = $this->model->find($id);
        $info['data']['messageSet'] = $info['data']['messageSet'] ? json_decode($info['data']['messageSet']) : [] ;
        $condition = [['type','=','1']];
        $admin = $this->admin->findAllBy($condition);
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 rpa 任务");
        return view('admin/rpa/Center/edit',['info'=>$info['data'],'admins'=>$admin['data']]);
    }

    //RPA insert
    public function insert(Request $request){
        $data = $this->get_params($request, ['name','bewrite','filepath','failtimes','timeout','isfp','emailreceiver','PhoneNum','messageSet']);
        isset($data['messageSet']) ? $data['messageSet'] = json_encode($data['messageSet']) : '';
        $this->log(__CLASS__, __FUNCTION__, $request, "插入 rpa 信息");
        return $this->model->create($data);
    }

    //RPA update
    public function update(Request $request){
        $data = $this->get_params($request, ['id','name','bewrite','filepath','failtimes','timeout','isfp','emailreceiver','PhoneNum','messageSet']);
        isset($data['messageSet']) ? $data['messageSet'] = json_encode($data['messageSet']) : '';
        $this->log(__CLASS__, __FUNCTION__, $request, "更新 rpa 信息");
        return $this->model->update($data,$data['id']);
    }

    //delete RPA
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 rpa");
        return $this->model->delete($id);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 rpa 列表");
        return $this->model->delete(explode(',',$ids));
    }

    //pagenation
    public function pagination(Request $request){
        $condition = [];
        $sort = ['id','asc'];
        return $this->model->paginate($condition, $sort, 10);
    }

    //pagenation
    public function taskPagination(Request $request){
        $condition = [];
        $sort = ['id','asc'];
        return $this->task->paginate($condition, $sort, 10);
    }

    //立即发布任务
    public function immedtasks(Request $request){
        $id = $request->id;
        $task = $this->task->find($id);
        $task = $task['data']->toArray();
        $data = ['name'=>$task['name'],'jsondata'=>$task['jsondata'],'tid'=>$task['id']];
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 {$task['name']}-{$task['id']} 任务");
        return $this->app->create($data);
    }


    //////////////////////////////////////////////////////////////queue//////////////////////////////////////////////////////

    //queue list
    public function queue(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 任务队列");
        return view('admin/rpa/Center/queue');
    }

    //RPA edit
    public function editQueue(Request $request){
        $id = $request->id;
        $info = $this->queue->find($id);
        $info = $info['data'];
        $info['data'] = json_decode($info['jsondata'],true);
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 队列 页面");
        return view('admin/rpa/Center/editQueue',['info'=>$info]);
    }

    //delete RPA
    public function deleteQueue(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 队列");
        return $this->queue->delete($id);
    }

    //RPA update
    public function updateQueue(Request $request){
        $data = $this->get_params($request, ['id','name','state','time','jsondata','tid']);
        $this->log(__CLASS__, __FUNCTION__, $request, "更新 队列 信息");
        return $this->queue->update($data,$data['id']);
    }
    
    //delete_all
    public function deleteQueueAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 队列");
        return $this->queue->delete(explode(',',$ids));
    }

    //pagenation
    public function queuePagination(Request $request){
        $condition = [];
        $sort = ['id','asc'];
        return $this->queue->paginate($condition, $sort, 10);
    }
}
