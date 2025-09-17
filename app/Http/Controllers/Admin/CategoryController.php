<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Repositories\Admin\Interfaces\CategoryRepositoryInterface;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        return view('dashboard.category.index',compact('categories','subcategories'));
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
        try{
            DB::beginTransaction();

            $this->categoryRepository->create($request->validated());
            toastr()->success(__('toaster.cat_create'));
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            toastr()->error(__('error'));
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
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
        try{
            DB::beginTransaction();
            $this->categoryRepository->update($category,$request->validated());
            DB::commit();
            toastr()->success(__('toaster.cat_create'));
        }
        catch(\Exception $e){
            DB::rollBack();
            toastr()->error(__('error'));
        }



        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try{
            DB::beginTransaction();
            $this->categoryRepository->destroy($category);
            toastr()->success(__('toaster.del'));
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            toastr()->error(__('error'));
        }

        return back();


    }
}
