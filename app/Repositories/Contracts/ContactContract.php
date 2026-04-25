<?php

namespace App\Repositories\Contracts;

interface ContactContract
{
    public function create(array $data);
    public function findById(int $id);
    public function all();
    public function updateById(int $id, array $data);
    public function deleteById(int $id);
}
