<?php

namespace App\Repositories\Admin;

use App\Repositories\Admin\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $role = $this->find($id);
        $role->update($data);
        return $role;
    }

    public function delete($id)
    {
        $role = $this->find($id);
        return $role->delete();
    }

    public function getRolePermissions($roleId)
    {
        $role = $this->find($roleId);
        return DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
    }

    public function syncPermissions($roleId, array $permissions)
    {
        $role = $this->find($roleId);
        return $role->syncPermissions($permissions);
    }
}
