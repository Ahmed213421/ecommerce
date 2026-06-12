<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Contracts\CategoryContract;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;

class AdminCategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategoriesAndSubcategories()
    {
        return [
            'categories' => Category::latest()->get(),
            'subcategories' => Subcategory::latest()->get()
        ];
    }

    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    public function createCategory(array $data)
    {
        DB::beginTransaction();
        try {
            $this->categoryRepository->create($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function updateCategory(Category $category, array $data)
    {
        DB::beginTransaction();
        try {
            $this->categoryRepository->update($category, $data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function deleteCategory(Category $category)
    {
        DB::beginTransaction();
        try {
            $this->categoryRepository->destroy($category);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
