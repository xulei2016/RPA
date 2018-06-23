<?php 

namespace App\Repositories\Criteria;

use App\Repositories\Interfaces\RepositoryInterface as Repository;

abstract class Criteria {
    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}