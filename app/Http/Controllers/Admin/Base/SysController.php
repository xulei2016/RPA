<?php

namespace App\Http\Controllers\Admin\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Base\SysConfigRepository as config;
use App\Repositories\Models\Admin\Base\UserHeadImgRepository as UserHeadImg;
use App\Repositories\Models\Admin\Base\MessageRepository as message;


/**
 * 系统管理
 * @since 2018/2
 * @author hus lay
 * 
 */
class SysController extends BaseController
{
    private $model;
    private $img;
    private $message;

    //__CONSTRUCT
    public function __CONSTRUCT(config $model, UserHeadImg $img, message $message)
    {
        parent::__construct();
        $this->model = $model;
        $this->img = $img;
        $this->message = $message;
    }

    /**
     * 主页
     */
    public function index(Request $request){
        //管理员信息
        $admin = session('sys_admin');
        //通知列表
        $message = $this->getMessage();
        //系统信息
        $info = $this->sys_info();
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 首页");
        return view('admin/index/index', ['info'=>$info,'admin'=>$admin,'message'=>$message]);
    }

    /**
     * 主页
     */
    public function get_index(Request $request){
        $admin = session('sys_admin');
        $info = $this->sys_info();
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 首页");
        return view('admin/index/dashboard', ['info'=>$info,'admin'=>$admin]);
    }

    /**
     * 系统管理
     */
    public function sysConfig(Request $request){
        $condition = [['type','<>','hidden']];
        $config = $this->model->findAllBy($condition,['sort', 'asc']);
        $this->log(__CLASS__, __FUNCTION__, $request, "系统管理页面");
        return view('admin/sys/config/list',['config'=>$config['data']]);
    }

    /**
     * 头像列表
     */
    public function headImgList(Request $request){
        return $this->img->all();
    }

    /**
     * 修改系统管理
     */
    public function update(Request $request){
        $data = $request->all();
        //是否重新上传图片
        if(!empty($_FILES['logo'])){
            $thumb = $this->model->utilUploadPhotoJust('logo', 'images/common/logo/',120,120);
            if(!$thumb){
                return $this->ajax_return('500', '图片保存失败！');
            }
            $data['logo'] = $thumb;
            $this->unlinkImg($request->prevurl);
        }
        foreach($data as $k => $val){
            $this->model->update(['item_value'=>$val], $k, 'item_key');
        }
        $this->log(__CLASS__, __FUNCTION__, $request, "修改系统设置");
        return $this->ajax_return(200, '更新成功！');
    }

    /**
     * 上传头像
     */
    public function addImg(Request $request){
        if($request->imgUrl){
            $thumb = $this->img->utilUploadPhoto('imgUrl', 'images/admin/headImg/',120,120);
            if(!$thumb){
                return $this->ajax_return('500', '图片保存失败！',$thumb);
            }
            $data['url'] = $thumb['url'];
            $data['thumb'] = $thumb['thumb'];
        }
        $this->log(__CLASS__, __FUNCTION__, $request, "上传头像");
        return $this->img->create($data);
    }

    //delete one
    public function del_img(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 头像 信息");
        return $this->img->delete($id);
    }

    /**
     * 清除缓存
     */
    public function clean_cache(){
        if($this->del_cache('sys_info') && $this->del_cache('sys_admin')){
            $this->authCacheInfo(false);
            return $this->ajax_return(200, '缓存清除成功！');
        }else{
            return $this->ajax_return(500, '缓存清除失败！请联系管理员处理');
        };
    }

    /**
     * 控制面板
     */
    public function dashboard(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 控制面板");
        return view('admin/admin/admin/index');
    }

    /**
     * 未知路由
     */
    public function notAllow(){
        return view('errors/noAllow');
    }

    /**
     * 获取消息推送
     */
    public function getMessage(){
        $table = ['table'=>'sys_user_messages as a','left'=>'a.mid','mode'=>'=','right'=>'sys_messages.id'];
        $table2 = ['table'=>'sys_message_types as b','left'=>'b.id','mode'=>'=','right'=>'sys_messages.type'];
        $condition = [['a.uid','=',session('sys_admin')['id']],['a.is_read','=',0]];
        $columns = ['sys_messages.*','a.*','b.name as tname'];
        $message = $this->message
                    ->leftJoin($table)
                    ->leftJoin($table2['table'],$table2['left'],$table2['mode'],$table2['right'])
                    ->where($condition)
                    ->orderBy('sys_messages.id','asc')
                    ->get($columns);
        return ['count'=>count($message),'data'=>$message];
    }
    
    /**
    * 系统
    */
    private function sys_info(){
        $info['sys'] = [
            'PORT' => $_SERVER['SERVER_PORT'],
            'PHP_OS' => php_uname(),
            'SERVER_PROTOCOL' => $_SERVER['SERVER_PROTOCOL'],
            'SERVER_SOFTWARE' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            'SERVER_INFO' => $_SERVER ['SERVER_SOFTWARE'],
            'FILE_UPLOAD_MAX_SIZE' => get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件",
        ];
        $con = mysqli_connect(env('DB_HOST'),env('DB_USERNAME'),env('DB_PASSWORD'),env('DB_DATABASE'));
        $info['database'] = [
            'MYSQL_VERSION' => mysqli_get_server_info($con),
            'ALLOW_PERSISTENT' => @get_cfg_var("mysql.allow_persistent")?"是 ":"否",
            'MAX_LINKS' => @get_cfg_var("mysql.max_links")==-1 ? "不限" : @get_cfg_var("mysql.max_links")
        ];
        exec("wmic LOGICALDISK get name,Description,filesystem,size,freespace",$info['disk']);
        // var_dump($admin);
        // var_dump($info);
        // exit;
        return $info;
    }
}
