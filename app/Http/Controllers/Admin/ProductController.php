<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\Admin\AdminProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $adminProductService;

    public function __construct(AdminProductService $adminProductService)
    {
        $this->adminProductService = $adminProductService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->adminProductService->getAllProducts();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->adminProductService->getProductFormData();
        return view('dashboard.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->adminProductService->createProduct($request->validated());
        toastr()->success(__('toaster.product_create'));
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->adminProductService->getProductWithRelations($id);
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->adminProductService->getProductFormDataWithProduct($id);
        return view('dashboard.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $this->adminProductService->updateProduct($id, $request->validated());
        toastr()->success(__('toaster.prod_update'));
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            $this->adminProductService->deleteProducts($id, $request->page);
            
            if ($request->page == 1) {
                toastr()->success(__('toaster.del'));
            } elseif ($request->page == 2) {
                toastr()->success(__('dashboard.del'));
            }

            return redirect()->route('admin.products.index');

        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return back();
        }
    }
}
