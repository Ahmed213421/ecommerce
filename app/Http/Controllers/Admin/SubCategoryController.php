<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
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
    public function store(Request $request)
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
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name_en' => 'required',
            'name_ar' => 'required',
            'category_id' => 'exists:categories,id',
            'simage' => 'image',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $category = Subcategory::find($id);
        $img = $category->imagepath;

        if ($request->hasFile('simage')) {
            if ($category->imagepath &&  file_exists(public_path($category->imagepath))) {
                unlink(public_path($category->imagepath));
            }
            $img =  'dashboard/'.$request->simage->storeAs('subcategory', time().'_'.$request->simage->getClientOriginalName(),'images');
        }

        Subcategory::find($id)->update([
            'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
            'category_id' => $request->category_id,
            'imagepath' => $img,
            'slug' => Str::slug($request->name_en),
        ]);

        toastr()->success(__('toaster.update'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $subcategory = Subcategory::find($id);
        if($subcategory){

            if ($subcategory->imagepath &&  file_exists(public_path($subcategory->imagepath))) {
                unlink(public_path($subcategory->imagepath));
            }
        }
        Subcategory::destroy($id);
        toastr()->success(__('toaster.del'));
        return back();
    }
}
