<?php 
namespace App\Repositories\Eloquent;

use Illuminate\Util\UtilImage;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Exceptions\RepositoryException;
use App\Repositories\Interfaces\CriteriaInterface;
use App\Repositories\Criteria\Criteria;
use Illuminate\Container\Container as App;

/**
 * Class Repository
 * @package App\Repositories\Eloquent
 * @author hsu lay
 * @link http://www.easyWeb.com
 * @copyright easyweb
 * @version 1.0 2018.02
 */
abstract class Repository implements RepositoryInterface, CriteriaInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;
    protected $newModel;

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipCriteria = true;

    /**
     * Prevents from overwriting same criteria in chain usage
     * @var bool
     */
    protected $preventCriteriaOverwriting = true;

    /**
     * @param App $app
     * @param Collection $collection
     * @throws \Bosnadev\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        $this->app = $app;
        $this->criteria = $collection;
        $this->resetScope();
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public abstract function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        try{
            $this->applyCriteria();
            $result= $this->model->get($columns);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param array $relations
     * @return $this
     */
    public function with(array $relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }

    /**
     * @param array $condition
     * @return $count
     */
    public function count(array $condition = [])
    {
        try{
            $result = $this->where($condition)->count();
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param  string $value
     * @param  string $key
     * @return array
     */
    public function lists($value, $key = null)
    {
        try{
            $this->applyCriteria();
            $lists = $this->model->lists($value, $key);
            if (is_array($lists)) {
                return $lists;
            }
            $result = $lists->all();
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }
       
    /**
     * @param string $sort 
     * @param string $asc
     * @return mixed
     */
    public function orderBy($sort = 'id', $asc = 'asc') {
        try{
            return $this->model->orderBy($sort, $asc);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        try{
            $result = $this->model->create($data);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        try{
            $result = $this->model->insert($data);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * save a model without massive assignment
     *
     * @param array $data
     * @return bool
     */
    public function saveModel(array $data)
    {
        try{
            foreach ($data as $k => $v) {
                $this->model->$k = $v;
            }
            $result = $this->model->save();
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        try{
            $result = $this->model->where($attribute, '=', $id)->update($data);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param array $data
     * @param array $condition
     * @return mixed
     */
    public function updateBy(array $data, $condition)
    {
        try{
            $result = $this->where($condition)->update($data);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param  array $data
     * @param  $id
     * @return mixed
     */
    public function updateRich(array $data, $id)
    {
        try{
            if (!($model = $this->model->find($id))) {
                return false;
            }
            $result = $model->fill($data)->save();
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        try{
            $result = $this->model->destroy($id);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * deleteBy
     * 
     * @param array $condition
     * @return mixed
     */
    public function deleteBy($condition)
    {
        try{
            $result = $this->where($condition)->delete();
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        try{
            $this->applyCriteria();
            $result = $this->model->find($id, $columns);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param array $condition
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($condition, $columns = array('*'), $sort = ['id', 'asc'])
    {
        try{
            $this->applyCriteria();
            $result = $this->where($condition)->orderBy($sort[0], $sort[1])->first($columns);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param array $condition
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($condition, $sort = ['id', 'asc'], $columns = array('*'), $groupBy = [])
    {
        try{
            $this->applyCriteria();
            if(!empty($groupBy)){
                $result = $this->where($condition)->orderBy($sort[0], $sort[1])->groupBy($groupBy)->get($columns);
            }else{
                $result = $this->where($condition)->orderBy($sort[0], $sort[1])->get($columns);
            }
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @param array $condition
     * @return mixed
     */
    public function increment($condition, $columns = 'id')
    {
        try{
            $this->applyCriteria();
            $result = $this->where($condition)->increment($columns);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * where
     * 
     * @param array $where
     * @param bool $or
     * @return mixed
     */
    public function where($where, $or = false)
    {
        $this->applyCriteria();
        $model = $this->model;
        foreach ($where as $field => $value) {
            if ($value instanceof \Closure) {
                $model = (!$or)
                    ? $model->where($value)
                    : $model->orWhere($value);
            } elseif (is_array($value)) {
                if (count($value) === 3) {
                    list($field, $operator, $search) = $value;
                    $model = (!$or)
                        ? $model->where($field, $operator, $search)
                        : $model->orWhere($field, $operator, $search);
                } elseif (count($value) === 2) {
                    list($field, $search) = $value;
                    $model = (!$or)
                        ? $model->where($field, '=', $search)
                        : $model->orWhere($field, '=', $search);
                }
            } elseif (is_string($value)){
                $model = $model->whereRaw($where);
            }else {
                $model = (!$or)
                    ? $model->where($field, '=', $value)
                    : $model->orWhere($field, '=', $value);
            }
        }
        return $model;
    }
    
    /**
     * union
     * 
     * @param array $data
     * @return model
     */
    public function union($data)
    {
        try{
            return $this->model->union($data);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }
    
    /**
     * leftJoin
     * 
     * @param string $table
     * [
     *  'table'=> $table,
     *  'left' => $left_constraint,
     *  'mode' => $mode,
     *  'right' => $right_constraint,
     * ]
     * @return model
     */
    public function leftJoin(array $table)
    {
        try{
            return $this->model->leftJoin($table['table'],  $table['left'], $table['mode'], $table['right']);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }
    
    /**
     * rightJoin
     * 
     * @param string $table
     * [
     *  'table'=> $table,
     *  'left' => $left_constraint,
     *  'mode' => $mode,
     *  'right' => $right_constraint,
     * ]
     * @return model
     */
    public function rightJoin(array $table)
    {
        try{
            return $this->model->rightJoin($table['table'],  $table['left'], $table['mode'], $table['right']);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }
    
    /**
     * paginate
     * 
     * @param array $condition
     * @param array $sort
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($condition, $sort, $perPage = 10, $columns = array('*'))
    {
        try{
            $this->applyCriteria();
            $result = $this->where($condition)->orderBy($sort[0], $sort[1])->paginate($perPage, $columns);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * left_paginate
     * 
     * @param array $tables table 
     * @param array $condition
     * @param array $sort
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function left_paginate($tables, $condition, $sort, $perPage = 10, $columns = array('*'))
    {
        try{
            $model = $this->model;
            foreach($tables as $table){
                $model = $model->leftJoin($table['table'],  $table['left'], $table['mode'], $table['right']);
            }
            $result = $model->where($condition)->orderBy($sort[0], $sort[1])->paginate($perPage, $columns);
            return $this->model->error_return('200',$result,true);
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }
    
    /**
     * Find a collection of models by the given query conditions.
     *
     * @param array $where
     * @param array $columns
     * @param bool $or
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findWhere($where, $columns = ['*'], $or = false)
    {
        $this->applyCriteria();
        try{
            return $this->where($where)->get($columns)->tpArray();
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel()
    {
        try{
            return $this->setModel($this->model());
        }catch (\Exception $ex){
            return $this->model->errorLog(static::class, __FUNCTION__, $ex);
        }
    }

    /**
     * Set Eloquent Model to instantiate
     *
     * @param $eloquentModel
     * @return Model
     * @throws RepositoryException
     */
    public function setModel($eloquentModel)
    {
        return $this->model = $this->newModel = $eloquentModel;
    }

    /**
     * @return $this
     */
    public function resetScope()
    {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria)
    {
        if ($this->preventCriteriaOverwriting) {
            // Find existing criteria
            $key = $this->criteria->search(function ($item) use ($criteria) {
                return (is_object($item) && (get_class($item) == get_class($criteria)));
            });
            // Remove old criteria
            if (is_int($key)) {
                $this->criteria->offsetUnset($key);
            }
        }
        $this->criteria->push($criteria);
        return $this;
    }
    
    /**
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->skipCriteria === true)
            return $this;
        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }
        return $this;
    }

    /**
     * util image
     * 生成缩略图
     * @param string     源图绝对完整地址{带文件名及后缀名}
     * @param string     目标图绝对完整地址{带文件名及后缀名}
     * @param int        缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
     * @param int        缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
     * @param int        是否裁切{宽,高必须非0}
     * @param int/float  缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
     * @return boolean
     */
    public function utilImage2thumb($src_img, $dst_img, $width = 200, $height = 260, $cut = 0, $proportion = 0){
        try{
            return UtilImage::img2thumb($src_img, $dst_img, $width, $height, $cut, $proportion);
        }catch(\Exception $ex){
            $this->model->errorLog(static::class, __FUNCTION__, $ex);
            return false;
        }
    }

    /**
     * 上传图片同时为其生成缩略图
     * @param string $picName 页面文件流name
     * @param string $targetPath 保存在服务器的路径
     * @param int $width 缩率图宽度
     * @param int $height 缩率图高度
     * @return multitype:array|boolean
     */
    public function utilUploadPhoto($picName,$targetPath,$width = 100,$height = 100){
        try{
            return UtilImage::uploadPhoto($picName,$targetPath,$width,$height);
        }catch(\Exception $ex){
            $this->model->errorLog(static::class, __FUNCTION__, $ex);
            return false;
        }
    }

    /**
     * 仅仅上传图片
     * @param string $picName 页面文件流name
     * @param string $targetPath 保存在服务器的路径
     * @param int $width 缩率图宽度
     * @param int $height 缩率图高度
     * @param int $proportion 缩放比率 设置时width和height均失效 (0-1之间的数值)
     * @return string url
     */
    public function utilUploadPhotoJust($picName,$targetPath,$width = 0,$height = 0,$proportion = 0){
        try{
            return UtilImage::uploadPhotoJust($picName,$targetPath,$width,$height,$proportion);
        }catch(\Exception $ex){
            $this->model->errorLog(static::class, __FUNCTION__, $ex);
            return false;
        }
    }
}