<?php
namespace App\Repositories\Models\Admin\Rpa;

use App\Repositories\Eloquent\Repository;
use App\Model\Admin\Rpa\RpaTimetask;

/**
 * TimeTasks model
 * @author hsu lay
 * @version 1.0 2018.02
 */
class TimeTasksRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return new RpaTimetask;
    }

}