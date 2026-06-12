<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Contracts\RoleContract;
use Spatie\Permission\Models\Permission;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleContract $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRoles()
    {
        return $this->roleRepository->getAll();
    }

    public function createRole(array $data)
    {
        return $this->roleRepository->create($data);
    }

    public function updateRole($roleId, array $data)
    {
        return $this->roleRepository->update($roleId, $data);
    }

    public function deleteRole($roleId)
    {
        return $this->roleRepository->delete($roleId);
    }

    public function getRolePermissionsData($roleId)
    {
        return [
            'role' => $this->roleRepository->find($roleId),
            'permissions' => Permission::get(),
            'rolePermissions' => $this->roleRepository->getRolePermissions($roleId)
        ];
    }

    public function assignPermissionsToRole($roleId, array $permissions)
    {
        return $this->roleRepository->syncPermissions($roleId, $permissions);
    }
}
