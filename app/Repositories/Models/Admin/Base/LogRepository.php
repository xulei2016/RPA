<?php
namespace App\Repositories\Models\Admin\Base;

use App\Repositories\Eloquent\Repository;
use App\Model\Admin\Base\sysLog;

/**
 * log model
 * @author hsu lay
 * @link http://www.easyWeb.com
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class LogRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return new sysLog;
    }

}