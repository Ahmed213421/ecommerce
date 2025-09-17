<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);
        return $user;
    }

    public function updatePassword(int $id, string $password)
    {
        $user = $this->findById($id);
        $user->password = $password;
        $user->save();
        return $user;
    }

    public function updateImage(int $id, string $imagePath)
    {
        $user = $this->findById($id);
        if ($user->image) {
            $user->image->update(['imagepath' => $imagePath]);
        }
        return $user;
    }

    public function createImage(int $id, string $imagePath)
    {
        $user = $this->findById($id);
        $user->image()->create(['imagepath' => $imagePath]);
        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->findById($id);
        return $user->delete();
    }
}
