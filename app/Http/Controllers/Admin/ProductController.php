<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\Admin\ProductRequest;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->all();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['subcategories'] = Subcategory::all();
        $data['categories'] = Category::all();
        return view('dashboard.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->create($request->validated());
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
        $product = $this->productRepository->find($id);
        $data['product'] = $product;
        $data['subcategories'] = Subcategory::all();
        $data['categories'] = Category::all();
        return view('dashboard.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $this->productRepository->update($id, $request->validated());
        toastr()->success(__('toaster.prod_update'));
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
{
    try {
        DB::transaction(function () use ($id, $request) {
            if ($request->page == 1) {
                $this->productRepository->delete($id);
                toastr()->success(__('toaster.del'));
            }

            if ($request->page == 2) {
                $this->productRepository->deleteAll();
                toastr()->success(__('dashboard.del'));
            }
        });

        return redirect()->route('admin.products.index');

    } catch (\Exception $e) {
        toastr()->error($e->getMessage());
        return back();
    }
}

}
