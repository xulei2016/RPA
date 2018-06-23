<?php

namespace App\Model\Admin\Base;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Model\Base\base_model;

/**
 * sysModel
 * @author hus lay
 */
class sysAdmin extends base_model
{
    use EntrustUserTrait;
    
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    public $timestamps = false;

    protected $guarded = [];

    /**
     * get head img
     */
    public function headImg()
    {
        return $this->hasOne('App\Model\Admin\Base\sysUserHeadImg', 'id', 'head_img');
    }

    /**
     * get roles 
     */
    public function getRoles()
    {
        return $this->hasMany('App\Model\Admin\Role\role', 'id', 'user_id');
    }
}
