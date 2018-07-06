<?php

namespace App\Model\Admin\Base;

use App\Model\Base\base_model;
use Illuminate\Database\Eloquent\Model;

/**
 * sysMessageType
 * @author hus lay
 */
class sysMessageType extends base_model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    public $timestamps = false;

    protected $guarded = [];
}
