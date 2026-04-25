<?php

namespace App\Repositories\Admin\Contracts;

use App\Models\Tag;

interface TagContract
{
    public function getAll();
    public function find($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
