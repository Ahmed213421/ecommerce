<?php

namespace App\Repositories\Admin\Contracts;

use App\Models\Post;

interface PostContract
{
    public function create(array $data);
    public function update($model, array $data);
    public function destroy($model);
    public function deleteAll();
}
