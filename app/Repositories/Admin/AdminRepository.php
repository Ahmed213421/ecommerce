<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Repositories\Admin\Interfaces\AdminRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminRepositoryInterface
{
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 1;
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, array $data)
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
