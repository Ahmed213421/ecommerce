<?php

namespace App\Repositories\Admin\Contracts;

use App\Models\User;

interface UserContract
{
    public function getAll();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
