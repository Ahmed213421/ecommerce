<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Contracts\PermissionContract;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionContract $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAllPermissions()
    {
        return $this->permissionRepository->getAll();
    }

    public function createPermission(array $data)
    {
        return $this->permissionRepository->create($data);
    }

    public function updatePermission($permissionId, array $data)
    {
        return $this->permissionRepository->update($permissionId, $data);
    }

    public function deletePermission($permissionId)
    {
        return $this->permissionRepository->delete($permissionId);
    }
}
