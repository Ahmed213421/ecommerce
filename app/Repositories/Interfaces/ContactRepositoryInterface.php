<?php

namespace App\Repositories\Interfaces;

interface ContactRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function all();
    public function update(int $id, array $data);
    public function delete(int $id);
}
