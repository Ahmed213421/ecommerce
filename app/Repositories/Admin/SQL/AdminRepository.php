<?php

namespace App\Repositories\Admin\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Repositories\Admin\Contracts\AdminContract;
use Illuminate\Support\Facades\Hash;

class AdminRepository extends BaseRepository implements AdminContract
{

    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function create(array $data = []): mixed
    {
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 1;
        return $this->model->create($data);
    }

    public function find(int $id, array $relations = [], array $filters = []): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, array $data = []): mixed
    {
        $user = $this->find($id);

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }

    public function syncRoles($user, array $roles)
    {
        return $user->syncRoles($roles);
    }
}
