<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Http\Requests\Admin\UpdateSubCategoryRequest;
use App\Repositories\Admin\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
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
        // // return $request;
        // $validator = Validator::make($request->all(),[
        //     'name_en' => 'required',
        //     'name_ar' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        // ]);
        // if ($validator->fails()) {
        //     // Redirect back to the form with the error messages
        //     return back()
        //     ->withErrors($validator)
        //     ->withInput();
        // }

        // if ($request->hasFile('simage')) {
        //     $img =  'dashboard/'.$request->simage->storeAs('subcategory', time().'_'.$request->simage->getClientOriginalName(),'images');
        // }
        // else{
        //     $img = null;
        // }
        // // return $request;

        // Subcategory::create([
        //     'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
        //     'category_id' => $request->category_id,
        //     'imagepath' => $img,
        // ]);

        // toastr()->success(__('toaster.add'));

        // return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.category.subcategory.show',['subcategory' => Subcategory::find($id)]);
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
        $this->subCategoryRepository->update($request->validated(), $id);
        toastr()->success(__('toaster.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->subCategoryRepository->delete($id);
        toastr()->success(__('toaster.del'));
        return back();
    }
}
