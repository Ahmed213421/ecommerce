<?php

namespace App\Repositories\Admin\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Admin\Contracts\PermissionContract;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionContract
{

    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function create(array $data = []): mixed
    {
        return $this->model->create($data);
    }

    public function find(int $id, array $relations = [], array $filters = []): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, array $data = []): mixed
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
