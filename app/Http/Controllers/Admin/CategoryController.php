<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class CategoryController extends Controller
{
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
    public function store(Request $request)
    {
        // return $request;

        $validator = Validator::make($request->all(),[
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'image' => 'image',
            'category_id' => 'nullable|exists:categories,id'
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('image')) {
            $img =  'dashboard/'.$request->image->storeAs('category', time().'_'.$request->image->getClientOriginalName(),'images');
        }
        else{
            $img = null;
        }

        if($request->category_id){
            Subcategory::create([
                'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
                'category_id' => $request->category_id,
                'imagepath' => $img,
                'slug' => Str::slug($request->name_en),
            ]);
        }
        else{
            Category::create([
                'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
                'description' => ['en' => $request->description_en , 'ar' => $request->description_ar],
                'imagepath' => $img,
                'slug' => Str::slug($request->name_en),
            ]);
        }

        toastr()->success(__('toaster.cat_create'));

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
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'image',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $category = Category::find($id);
        $img = $category->imagepath;

        if ($request->hasFile('image')) {
            if ($category->imagepath &&  file_exists(public_path($category->imagepath))) {
                unlink(public_path($category->imagepath));
            }
            $img =  'dashboard/'.$request->image->storeAs('category', time().'_'.$request->image->getClientOriginalName(),'images');
        }
        Category::find($id)->update([
            'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
            'description' => ['en' => $request->description_en , 'ar' => $request->description_ar],
            'imagepath' => $img,
            'slug' => Str::slug($request->name_en),
        ]);

        toastr()->success(__('toaster.cat_create'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        Category::destroy($id);
        if ($category->imagepath &&  file_exists(public_path($category->imagepath))) {
            unlink(public_path($category->imagepath));
        }
        toastr()->success(__('toaster.del'));
        return back();
    }
}
