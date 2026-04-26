<?php

namespace App\Repositories\Admin\Contracts;

use App\Repositories\Contracts\BaseContract;
use App\Models\Admin;

interface AdminContract extends BaseContract
{
    public function syncRoles($user, array $roles);
}
