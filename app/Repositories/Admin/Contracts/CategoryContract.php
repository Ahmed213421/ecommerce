<?php

namespace App\Repositories\Admin\Contracts;

use App\Models\Category;

interface CategoryContract
{
    public function create(array $data);
    public function update($model, array $data);
    public function destroy($model);
}
