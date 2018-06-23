<?php
namespace App\Repositories\Models\Admin\Role;

use App\Repositories\Eloquent\Repository;
use App\Model\Admin\Base\sysRole;

/**
 * Role model
 * @author hsu lay
 * @copyright easyweb
 * @version 1.0 2018.02
 */
class RoleRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return new sysRole;
    }

    //getPermissions
    public function getPermissions($rid){
        return sysRole::find($rid)->permissions;
    }

}