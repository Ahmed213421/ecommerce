<?php

namespace App\Repositories\Admin\Contracts;

use App\Models\Role;

interface RoleContract
{
    public function getAll();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getRolePermissions($roleId);
    public function syncPermissions($roleId, array $permissions);
}
