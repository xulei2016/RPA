<?php
namespace App\Http\Controllers\Admin\Banner;

use Illuminate\Util\UtilImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use App\Repositories\Models\Admin\Banner\BannerRepository as Banner;

/**
 * BannerController
 * @author hsu lay
 * @link http://blog.mihuyu.top
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class BannerController extends BaseController
{
    private $model;

    //__CONSTRUCT
    public function __CONSTRUCT(Banner $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    //banner list
    public function banner_list(Request $request){
        $sort = ['sort','asc'];
        // $bannerList = $this->model->paginate([], $sort, 5);
        $condition = [];
        $bannerList = $this->model->findAllBy($condition,$sort);
        $this->log(__CLASS__, __FUNCTION__, $request, "查看 banner 列表");
        return view('admin/site/banner/list', ['bannerList' => $bannerList['data']]);
    }
    
    //add_banner
    public function add_banner(Request $request){
        $this->log(__CLASS__, __FUNCTION__, $request, "添加banner 页面");
        return view('admin/site/banner/add');
    }

    //edit_banner
    function edit_banner(Request $request){
        $id = $request->id;
        $result = $this->model->find($id);
        $this->log(__CLASS__, __FUNCTION__, $request, "编辑 banner 页面");
        return view('admin/site/banner/edit',['data' => $result['data']]);
    }
    
    //insert_banner
    public function insert_banner(Request $request){
        $data = $this->get_params($request, ['name', 'url', 'type', 'sort']);
        $thumb = $this->model->utilUploadPhoto('imgurl', 'images/admin/banner/',120,120);
        if(!$thumb){
            return $this->ajax_return('500', '图片保存失败！');
        }
        $data['image'] = $thumb['url'];
        $data['thumb'] = $thumb['thumb'];
        $this->model->create($data);
        $this->log(__CLASS__, __FUNCTION__, $request, "新增 banner 信息");
        return $this->ajax_return('200', '操作成功！');
    }

    //delete one
    public function del_banner(Request $request){
        $id = $request->id;
        $this->log(__CLASS__, __FUNCTION__, $request, "删除 banner 信息");
        return $this->model->delete($id);
    }
        
    //update_banner
    public function update_banner(Request $request){
        $data = $this->get_params($request, ['id','name', 'url', 'type', 'sort']);
        //是否重新上传图片
        if('1' == $request->imgFlag){
            $thumb = $this->model->utilUploadPhoto('imgurl', 'images/admin/banner/',120,120);
            if(!$thumb){
                return $this->ajax_return('500', '图片保存失败！');
            }
            $data['image'] = $thumb['url'];
            $data['thumb'] = $thumb['thumb'];
            $prevthumburl = $request->prevurl;
            $prevurl = str_replace('_thumb','',$prevthumburl);
            $this->unlinkImg($prevthumburl);
            $this->unlinkImg($prevurl);
        }
        $this->log(__CLASS__, __FUNCTION__, $request, "更新 banner 信息");
        return $this->model->update($data, $data['id']);
    }
}
