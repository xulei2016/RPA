<?php

namespace App\Http\Controllers\admin\rpa;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Rpa\ReleaseTasksRepository as ReleaseTasks;
use App\Repositories\Models\Admin\Rpa\ImmedTasksRepository as ImmedTasks;
use App\Repositories\Models\Admin\Rpa\TasksRepositoryRepository as TasksRepository;
use App\Repositories\Models\Admin\Rpa\TaskcollectionsRepository as Taskcollections;

/**
 * rpa 新闻发布控制器
 * @author hsu lay
 * @link www.haqh.com
 * @since 2018/05/15
 */
class NewsController extends BaseController
{
    private $model;
    private $app;
    private $tasks;
    private $collect;

    //__CONSTRUCT
    public function __CONSTRUCT(ReleaseTasks $model,ImmedTasks $app,TasksRepository $tasks,Taskcollections $collect)
    {
        parent::__construct();
        $this->model = $model;
        $this->app = $app;
        $this->tasks = $tasks;
        $this->collect = $collect;
    }

    //RPA list
    public function index(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 新闻 任务中心");
        return view('admin/rpa/News/index');
    }

    //RPA add
    public function add(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "添加 新闻 任务");
        return view('admin/rpa/News/add');
    }

    //RPA edit
    public function edit(Request $request){
        $id = $request->id;
        $info = $this->tasks->find($id);
        $info = $info['data'];
        $info['week'] = explode(',', $info['week']);
        $info['data'] = json_decode($info['jsondata'],true);
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 新闻 任务");
        return view('admin/rpa/News/edit',['info'=>$info]);
    }

    //RPA add immed
    public function immedtasks(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 新闻 页");
        return view('admin/rpa/News/add_immed');
    }

    //RPA insert
    public function insert(Request $request){
        $data = $this->get_params($request, ['description','date','week','time','jsondata']);
        $data['name'] = 'zwtx';
        $data['week'] = isset($data['week']) ? implode(',',$data['week']) :'';
        $data['created_at'] = $this->getTime();
        $this->log(__CLASS__, __FUNCTION__, $request, "插入 新闻 信息");
        $this->immedtask();
        $result = $this->tasks->create($data);
        $data['tid'] = $result['data']['id'];
        return $this->model->create($data);
    }

    //RPA update
    public function update(Request $request){
        $data = $this->get_params($request, ['id','description','date','week','time','jsondata'],false);
        $data['name'] = 'zwtx';
        $data['week'] = $data['week'] ? implode(',',$data['week']) :'';
        $this->log(__CLASS__, __FUNCTION__, $request, "更新 新闻 信息");
        $this->immedtask();
        //查询rpa任务表tid
        $this->model->update($data,$data['id'],'tid');
        return $this->tasks->update($data,$data['id']);
    }

    //delete RPA
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 新闻");
        $this->immedtask();
        $this->tasks->delete($id);
        return $this->model->deleteBy([['tid','=',$id]]);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 新闻 列表");
        $this->immedtask();
        $this->tasks->delete(explode(',',$ids));
        return $this->model->deleteBy([['tid','in',explode(',',$ids)]]);
    }

    //pagenation
    public function pagination(Request $request){
        $condition = [['name','=','zwtx']];
        $sort = ['id','asc'];
        return $this->tasks->paginate($condition, $sort, 10);
    }

    //发布任务
    public function immedtask(){
        $data = ['name'=>'taskdistribution','jsondata'=>'{"name":"zwtx"}'];
        $this->app->create($data);
    }

    //立即发布任务
    public function insertImmedtasks(Request $request){
        $task = $this->get_params($request, ['description','jsondata']);
        $task['name'] = 'zwtx';
        $data = ['name'=>$task['name'],'jsondata'=>$task['jsondata']];
        $this->log(__CLASS__, __FUNCTION__, $request, "立即发布 {$task['name']} 任务");
        return $this->app->create($data);
    }
}
