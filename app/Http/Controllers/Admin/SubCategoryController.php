<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Http\Requests\Admin\UpdateSubCategoryRequest;
use App\Models\Subcategory;
use App\Services\Admin\AdminSubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $adminSubCategoryService;

    public function __construct(AdminSubCategoryService $adminSubCategoryService)
    {
        $this->adminSubCategoryService = $adminSubCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        // store method is commented out
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory = $this->adminSubCategoryService->getSubCategoryWithCategory($id);
        return view('dashboard.category.subcategory.show',['subcategory' => $subcategory]);
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
    public function update(UpdateSubCategoryRequest $request, string $id)
    {
        $this->adminSubCategoryService->updateSubCategory($id, $request->validated());
        toastr()->success(__('toaster.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->adminSubCategoryService->deleteSubCategory($id);
        toastr()->success(__('toaster.del'));
        return back();
    }
}
