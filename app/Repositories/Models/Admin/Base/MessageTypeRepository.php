<?php
namespace App\Repositories\Models\Admin\Base;

use App\Repositories\Eloquent\Repository;
use App\Model\Admin\Base\sysMessageType;

/**
 * sysMessageType model
 * @author hsu lay
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class MessageTypeRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return new sysMessageType;
    }

}