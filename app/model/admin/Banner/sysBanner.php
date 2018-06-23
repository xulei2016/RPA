<?php

namespace App\model\admin\banner;

use App\Model\Base\base_model;
use Illuminate\Database\Eloquent\Model;

class sysBanner extends base_model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    public $timestamps = false;

    //黑名单，白名单
    // protected $fillable = ['name'];
    protected $guarded = [];
}
