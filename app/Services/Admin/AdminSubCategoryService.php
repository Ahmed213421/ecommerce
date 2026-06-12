<?php

namespace App\Services\Admin;

use App\Models\Subcategory;
use App\Repositories\Admin\Contracts\SubCategoryContract;

class AdminSubCategoryService
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryContract $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function getSubCategoryWithCategory($id)
    {
        return Subcategory::with('category')->findOrFail($id);
    }

    public function updateSubCategory($id, array $data)
    {
        return $this->subCategoryRepository->update($id, $data);
    }

    public function deleteSubCategory($id)
    {
        return $this->subCategoryRepository->delete($id);
    }
}
