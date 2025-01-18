<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.products.index',[
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['subcategories'] = Subcategory::all();
        $data['categories'] = Category::all();
        return view('dashboard.products.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(),[
            'name_en' => 'required',
            'name_ar' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'numeric|min:0|max:100',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'image',
            'images.*' => 'image|nullable',
            'stripe_price_id' => 'required',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($request->hasFile('image')) {
            $img = 'dashboard/'.$request->image->storeAs('products', time().'_'.$request->image->getClientOriginalName(),'images');
        }
        else{
            $img = null;
        }


        $product = Product::create([
            'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
            'description' => ['en' => $request->description_en , 'ar' => $request->description_ar],
            'imagepath' => $img,
            'price' => $request->price,
            'subcategory_id' => $request->subcategory_id,
            'discount_percentage' => $request->discount,
            'slug' => Str::slug($request->name_en),
            'stripe_price_id' => $request->stripe_price_id,
        ]);


        if ($request->hasFile('images')) {
            foreach($request->file('images') as $imgFile){


                $imgs = 'dashboard/'.$imgFile->storeAs('products', time().'_'.$imgFile->getClientOriginalName(),'images');
                $product->images()->create(['imagepath' => $imgs]);
            }
        }

        toastr()->success(__('toaster.product_create'));

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['product'] = Product::find($id);
        $data['subcategories'] = Subcategory::all();
        return view('dashboard.products.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name_en' => 'required',
            'name_ar' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'numeric|min:0|max:100',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'image',
            'images.*' => 'image|nullable',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $product = Product::find($id);
        $img = $product->imagepath;

        if ($request->hasFile('image')) {
            if ($product->imagepath &&  file_exists(public_path($product->imagepath))) {
                unlink(public_path($product->imagepath));
            }
            $img = 'dashboard/'.$request->image->storeAs('products', time().'_'.$request->image->getClientOriginalName(),'images');
        }
        $product = Product::find($id)->update([
            'name' => ['en' => $request->name_en , 'ar' => $request->name_ar],
            'description' => ['en' => $request->description_en , 'ar' => $request->description_ar],
            'imagepath' => $img,
            'price' => $request->price,
            'subcategory_id' => $request->subcategory_id,
            'discount_percentage' => $request->discount,
            'slug' => Str::slug($request->name_en),
            'stripe_price_id' => $request->stripe_price_id,
        ]);

        if ($request->hasFile('images')) {
            foreach($request->file('images') as $imgFile){

                if (file_exists(public_path($imgFile->imagepath))) {
                    unlink(public_path($imgFile->imagepath));
                }

                $imgFile->delete();

                foreach($request->file('images') as $imgs){
                    $imgs = 'dashboard/'.$imgFile->storeAs('products', time().'_'.$imgFile->getClientOriginalName(),'images');
                    $product->images()->create(['imagepath' => $imgs]);
                }

            }
        }

        toastr()->success(__('toaster.prod_update'));

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {

            foreach ($product->images as $image) {

                if (file_exists(public_path($image->imagepath))) {
                    unlink(public_path($image->imagepath));
                }
                $image->delete();
            }
        }

        Product::destroy($id);
        toastr()->success(__('toaster.del'));
        return back();
    }
}
