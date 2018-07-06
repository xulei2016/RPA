<?php
namespace App\Http\Controllers\Admin\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Base\UserHeadImgRepository as HeadImg;

/**
 * UserHeadImgController head-img record 
 * @author hsu lay 
 * @link http://bhead-img.mihuyu.top
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class UserHeadImgController extends BaseController
{
    private $app;

    //__CONSTRUCT
    public function __CONSTRUCT(HeadImg $model)
    {
        parent::__construct();
        $this->app = $model;
    }

    //head-img list
    public function img_list(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 头像 列表");
        return view('admin/head-img/list');
    }

    //delete head-img
    public function delete(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 头像 列表");
        return $this->app->delete($id);
    }
    
    //delete_all
    public function deleteAll(Request $request){
        $ids = $request->ids;
        $this->log(__CLASS__, __FUNCTION__, $request, "批量删除 头像 列表");
        return $this->app->delete(explode(',',$ids));
    }

    //head-img_pagination
    public function img_pagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = $this->getPagingList($selectInfo, ['account'=>'like','from_add_time'=>'>=','to_add_time'=>'<=']);
        $sort = ['id', $selectInfo['sort']];
        return $this->app->paginate($condition, $sort, 10);
    }
}
