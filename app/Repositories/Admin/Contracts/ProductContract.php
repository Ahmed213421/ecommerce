<?php

namespace App\Repositories\Admin\Contracts;

use App\Models\Product;

interface ProductContract
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function deleteAll();
}
