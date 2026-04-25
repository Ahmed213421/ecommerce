<?php

namespace App\Repositories\Admin\Contracts;

interface SubCategoryContract
{
    public function update(array $data, $id);
    public function delete($id);
}
