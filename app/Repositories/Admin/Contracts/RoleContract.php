<?php

namespace App\Repositories\Admin\Contracts;

use App\Repositories\Contracts\BaseContract;
use App\Models\Role;

interface RoleContract extends BaseContract
{
    public function getRolePermissions($roleId);
    public function syncPermissions($roleId, array $permissions);
}
