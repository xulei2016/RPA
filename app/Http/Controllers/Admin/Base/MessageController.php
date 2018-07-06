<?php

namespace App\Http\Controllers\Admin\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Base\MessageRepository as message;
use App\Repositories\Models\Admin\Base\UserMessageRepository as Usermessage;

/**
 * 消息中心管理
 * @since 2018/6
 * @author hus lay
 * 
 */
class MessageController extends BaseController
{
    private $model;
    private $usermodel;

    //__CONSTRUCT
    public function __CONSTRUCT(message $model, Usermessage $usermodel)
    {
        parent::__construct();
        $this->model = $model;
        $this->usermodel = $usermodel;
    }

    //index
    public function index(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 通知 列表");
        return view('admin/sys/message/index');
    }
    
    //delete log
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 通知 列表");
        return $this->model->delete($id);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 通知 列表");
        return $this->model->delete(explode(',',$ids));
    }

    //pagination
    public function pagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = $this->getPagingList($selectInfo, ['title'=>'like','from_add_time'=>'>=','to_add_time'=>'<=']);
        $sort = ['id', $selectInfo['sort']];
        $num = $selectInfo['num'];
        return $this->model->paginate($condition, $sort, $num);
    }


    ///////////////////////////////////////////////////////历史消息////////////////////////////////////////////////////
    
    //index
    public function history_list(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 历史通知 列表");
        return view('admin/sys/message/history');
    }
    
    //delete_history
    public function delete_history(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 历史通知 列表");
        return $this->usermodel->delete($id);
    }
    
    //deleteAllHistory
    public function deleteAllHistory(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 历史通知 列表");
        return $this->usermodel->delete(explode(',',$ids));
    }

    //history_pagination
    public function history_pagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = $this->getPagingList($selectInfo, ['title'=>'like','from_add_time'=>'>=','to_add_time'=>'<=']);
        $sort = ['id', $selectInfo['sort']];
        $num = $selectInfo['num'];
        return $this->usermodel->paginate($condition, $sort, $num);
    }
}
