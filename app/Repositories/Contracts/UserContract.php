<?php

namespace App\Repositories\Contracts;

interface UserContract extends BaseContract
{
    public function updatePassword(int $id, string $password);
    public function updateImage(int $id, string $imagePath);
    public function createImage(int $id, string $imagePath);
}
