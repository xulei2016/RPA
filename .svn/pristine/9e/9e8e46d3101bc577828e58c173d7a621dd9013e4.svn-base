<?php
namespace App\Repositories\Models\Admin\Rpa;

use App\Repositories\Eloquent\Repository;
use App\Model\Admin\Rpa\RpaTasksRepository;

/**
 * RpaTasksRepository model
 * @author hsu lay
 * @version 1.0 2018.02
 */
class TasksRepositoryRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return new RpaTasksRepository;
    }

    //pagination
    public function paginations($request){
        $conditionCFA = [['name','=','SupervisionCFA']];
        $conditionSF = [['name','=','SupervisionSF']];
        $sort = ['id','asc'];
        try{
            $result = RpaTasksRepository::where($conditionCFA)->orWhere($conditionSF)->paginate(10);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }
}