<?php

namespace App\Repositories\Contracts;

interface UserContract
{
    public function findById(int $id);
    public function updateById(int $id, array $data);
    public function updatePassword(int $id, string $password);
    public function updateImage(int $id, string $imagePath);
    public function createImage(int $id, string $imagePath);
    public function deleteById(int $id);
}
