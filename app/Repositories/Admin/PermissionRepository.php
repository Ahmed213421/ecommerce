<?php

namespace App\Repositories\Admin;

use App\Repositories\Admin\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $model;

    public function __construct(Permission $model)
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
        $permission = $this->find($id);
        $permission->update($data);
        return $permission;
    }

    public function delete($id)
    {
        $permission = $this->find($id);
        return $permission->delete();
    }
}
