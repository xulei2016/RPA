<?php

namespace App\Http\Controllers\Admin\Rpa;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Rpa\ReviewtableRepository as Reviewtable;

/**
 * rpa 开户云复核分配
 * @author hsu lay
 * @link www.haqh.com
 * @since 2018/08/16
 */
class ReviewtableController extends BaseController
{
    private $model;

    //__CONSTRUCT
    public function __CONSTRUCT(Reviewtable $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    //查询页展示
    public function index(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 开户云回访名单 页");
        //按姓名分组
        $condition = [];
        $sort = ['runtime','asc'];
        $list = $this->model->findAllBy($condition, $sort, ['reviewPeopName'], ['reviewPeopName','runtime']);
        return view('admin/rpa/Reviewtable/index', ['list' => $list['data']]);
    }
    
    /**
     * typeChange
     */
    public function typeChange(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "修改 回访 状态");
        return $this->model->update(['status'=>1], $id);
    }

    //查询信息
    public function pagination(Request $request){
        $selectInfo = $request->selectInfo;
        $condition = $this->getPagingList($selectInfo, ['reviewPeopName'=>'=','from_openingTime'=>'>=','to_openingTime'=>'<=']);
        $sort = ['openingTime', $selectInfo['sort']];
        $num = $selectInfo['num'];
        return $this->model->paginate($condition, $sort, $num);
    }
}
