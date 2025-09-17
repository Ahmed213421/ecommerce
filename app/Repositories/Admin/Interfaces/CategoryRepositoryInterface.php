<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{


    /**
     * Create new category
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data);

    /**
     * Update category
     *
     * @param Category $model
     * @param array $data
     * @return Category
     */
    public function update($model, array $data);

    /**
     * Delete category
     *
     * @param Category $model
     * @return Category
     */
    public function destroy($model);
}
