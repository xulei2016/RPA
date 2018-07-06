<?php

namespace App\Model\Admin\Base;

use App\Model\Base\base_model;
use Illuminate\Database\Eloquent\Model;

/**
 * sysRole
 * @author hus lay
 */
class sysRole extends base_model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    public $timestamps = false;

    protected $guarded = [];

    /**
     * 获取全部权限
     */
    public function permissions()
    {
         return $this->hasMany('App\Model\Admin\Base\sysPermissionRole','role_id','id');
    }
}
