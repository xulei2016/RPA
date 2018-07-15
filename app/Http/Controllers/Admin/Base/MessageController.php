<?php

namespace App\Http\Controllers\Admin\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Base\MessageRepository as message;
use App\Repositories\Models\Admin\Base\MessageTypeRepository as messageType;
use App\Repositories\Models\Admin\Base\UserMessageRepository as Usermessage;
use App\Repositories\Models\Admin\Role\RoleRepository as Role;
use App\Repositories\Models\Admin\Base\AdminRepository as Admin;

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
    private $messageType;
    private $role_model;
    private $admin;

    //__CONSTRUCT
    public function __CONSTRUCT(message $message, Usermessage $usermodel, messageType $messageType, Role $Role, Admin $admin)
    {
        parent::__construct();
        $this->model = $message;
        $this->usermodel = $usermodel;
        $this->messageType = $messageType;
        $this->role_model = $Role;
        $this->admin = $admin;
    }

    //index
    public function index(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 通知 列表");
        return view('admin/sys/message/index');
    }

    //sendMessage
    public function sendMessage(Request $request){
        //公告类型列表
        $types = $this->messageType->all();
        $this->log(__CLASS__, __FUNCTION__, $request, "发布通告 页面");
        return view('admin/sys/message/send', ['types' => $types['data']]);
    }

    //send
    public function send(Request $request){
        $data = $request->all();
        //保存该信息
        $data['user'] = ($data['mode'] == 3) ? '' : json_encode($data['user']);
        $data['add_time'] = $this->getTime();
        $res = $this->model->create($data);
        if($res['code'] == 200){
            $this->log(__CLASS__, __FUNCTION__, $request, "发布通告 成功");
            $mid = $res['data']['id'];
            if($data['mode'] == 1){//个人推送
                $info = [];
                foreach($request->user as $admin){
                    array_push($info, ['mid'=>$mid, 'uid'=>$admin]);
                }
                return $this->usermodel->insert($info);
            }elseif($data['mode'] == 2){//角色
                foreach($request->user as $role){
                    $condition = [['role','=',$role]];
                    $admins = $this->admin->findAllBy($condition);
                    $info = [];
                    foreach($admins['data'] as $admin){
                        array_push($info, ['mid'=>$mid, 'uid'=>$admin['id']]);
                    }
                    $res = $this->usermodel->insert($info);
                }
                return $res;
                
            }elseif($data['mode'] == 3){//全员推送
                $allAdmin = $this->admin->all();
                $info = [];
                foreach($allAdmin['data'] as $admin){
                    array_push($info, ['mid'=>$mid, 'uid'=>$admin['id']]);
                }
                return $this->usermodel->insert($info);
            }
        }else{
            $this->log(__CLASS__, __FUNCTION__, $request, "发布通告 失败");
            return $res;
        }
    }
    
    //view
    public function view(Request $request){
        $id = $request->id;
        $table = ['table'=>'sys_message_types as a','left'=>'a.id','mode'=>'=','right'=>'sys_messages.type'];
        $condition = [['sys_messages.id','=',$id]];
        $columns = ['sys_messages.*','a.*'];
        $message = $this->model
                    ->leftJoin($table)
                    ->find($id);
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 通知");
        return view('admin/sys/message/view', ['message' => $message]);
    }
    
    //view
    public function read(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request,  "通知 已读 操作");
        $condition = [['mid','=',$id],['uid','=',session('sys_admin')['id']]];
        $this->usermodel->where($condition)->update(['is_read'=>1]);
        return $this->ajax_return(200,'操作成功');
    }
    
    //view
    public function al_read(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request,  "通知 全部已读 操作");
        return $this->usermodel->update(['is_read'=>1], session('sys_admin')['id'], 'uid');
    }
    
    //delete
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 通知 列表");
        return $this->model->update(['is_delete'=>1], $id);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 通知 列表");
        foreach($ids as $id){
            $this->model->update(['is_delete'=>1], $id);
        }
        return $this->ajaxReturn(200,'操作成功');
    }

    //pagination
    public function pagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = $this->getPagingList($selectInfo, ['title'=>'like','from_add_time'=>'>=','to_add_time'=>'<=']);
        $num = $selectInfo['num'];

        $condition = [['a.uid','=',session('sys_admin')['id']]];
        $columns = ['sys_messages.*','a.*','b.name as tname'];
        
        $sort = ['sys_messages.id', $selectInfo['sort']];
        $table = [
            [
                'table'=>'sys_user_messages as a',
                'left' => 'sys_messages.id',
                'mode' => '=',
                'right' => 'a.mid',
            ],
            [
                'table'=>'sys_message_types as b',
                'left' => 'sys_messages.type',
                'mode' => '=',
                'right' => 'b.id',
            ],
        ];
        return $this->model->left_paginate($table, $condition, $sort, $num, $columns);
    }


    ///////////////////////////////////////////////////////历史消息////////////////////////////////////////////////////
    
    //index
    public function history_list(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 历史通知 列表");
        return view('admin/sys/message/history');
    }

    //index
    public function revoke(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "撤销 通知");
        $this->model->update(['is_revoke'=>1,'revoke_time'=>$this->getTime()], $id);
        $condition = [['mid','=',$id]];
        return $this->usermodel->deleteBy($condition);
    }
    
    //delete_history
    public function delete_history(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 历史通知 列表");
        return $this->model->update(['is_delete'=>1,'delete_time'=>$this->getTime()], $id);
    }
    
    //deleteAllHistory
    public function deleteAllHistory(Request $request){
        $ids = explode(',', $request->ids);
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 历史通知 列表");
        foreach($ids as $id){
            $this->model->update(['is_delete'=>1,'delete_time'=>$this->getTime()], $id);
        }
        return $this->ajax_return(200,'操作成功');
    }

    //history_pagination
    public function history_pagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = $this->getPagingList($selectInfo, ['title'=>'like','from_add_time'=>'>=','to_add_time'=>'<=']);
        $num = $selectInfo['num'];

        $condition = [['sys_messages.is_delete','=',0]];
        $columns = ['sys_messages.*','b.name as tname'];
        
        $sort = ['sys_messages.id', $selectInfo['sort']];
        $table = [
            [
                'table'=>'sys_message_types as b',
                'left' => 'sys_messages.type',
                'mode' => '=',
                'right' => 'b.id',
            ]
        ];
        return $this->model->left_paginate($table, $condition, $sort, $num, $columns);
    }
}
