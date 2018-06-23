<?php
namespace App\Repositories\Models\Admin\Base;

use App\Repositories\Eloquent\Repository;
use App\Model\Admin\Base\sysUserHeadImg;

/**
 * log model
 * @author hsu lay
 * @link http://blog.mihuyu.top
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class UserHeadImgRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return new sysUserHeadImg;
    }

}