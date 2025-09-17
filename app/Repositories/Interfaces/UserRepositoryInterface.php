<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function findById(int $id);
    public function update(int $id, array $data);
    public function updatePassword(int $id, string $password);
    public function updateImage(int $id, string $imagePath);
    public function createImage(int $id, string $imagePath);
    public function delete(int $id);
}
