<?php
namespace App\Repositories\Models\Admin\Base;

use App\Repositories\Eloquent\Repository;
use App\Model\Admin\Base\sysConfig;

/**
 * SysConfig model
 * @author hsu lay
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class SysConfigRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return new sysConfig;
    }

}