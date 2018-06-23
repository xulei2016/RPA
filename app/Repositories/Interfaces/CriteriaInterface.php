<?php
namespace App\Repositories\Interfaces;

use App\Repositories\Criteria\Criteria; 

/**
 * interface CriteriaInterface
 * Repository
 * @author hsu lay
 * @link http://www.easyWeb.com
 * @copyright easyweb
 * @version 1.0 2018.02
 */
interface CriteriaInterface {
    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true);
    /**
     * @return mixed
     */
    public function getCriteria();
    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria);
    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria);
    /**
     * @return $this
     */
    public function applyCriteria();
}