<?php

namespace App\Repositories\SQL;

use App\Models\User;
use App\Repositories\Contracts\UserContract;

class UserRepository extends BaseRepository implements UserContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function updatePassword(int $id, string $password)
    {
        $user = $this->findOrFail($id);
        return $this->update($user, ['password' => $password]);
    }

    public function updateImage(int $id, string $imagePath)
    {
        $user = $this->findOrFail($id);
        if ($user->image) {
            $user->image->update(['imagepath' => $imagePath]);
        }
        return $user;
    }

    public function createImage(int $id, string $imagePath)
    {
        $user = $this->findOrFail($id);
        $user->image()->create(['imagepath' => $imagePath]);
        return $user;
    }
}
