<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Admin\AdminCategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $adminCategoryService;

    public function __construct(AdminCategoryService $adminCategoryService)
    {
        $this->adminCategoryService = $adminCategoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->adminCategoryService->getAllCategoriesAndSubcategories();
        return view('dashboard.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $success = $this->adminCategoryService->createCategory($request->validated());
        
        if ($success) {
            toastr()->success(__('toaster.cat_create'));
        } else {
            toastr()->error(__('error'));
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->adminCategoryService->getCategoryById($id);
        return view('dashboard.category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,Category $category)
    {
        $success = $this->adminCategoryService->updateCategory($category, $request->validated());
        
        if ($success) {
            toastr()->success(__('toaster.cat_create'));
        } else {
            toastr()->error(__('error'));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $success = $this->adminCategoryService->deleteCategory($category);
        
        if ($success) {
            toastr()->success(__('toaster.del'));
        } else {
            toastr()->error(__('error'));
        }

        return back();
    }
}
