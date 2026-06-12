<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Repositories\Admin\Contracts\ProductContract;
use Illuminate\Support\Facades\DB;

class AdminProductService
{
    protected $productRepository;

    public function __construct(ProductContract $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->all();
    }

    public function getProductFormData()
    {
        return [
            'subcategories' => Subcategory::all(),
            'categories' => Category::all()
        ];
    }

    public function getProductFormDataWithProduct($id)
    {
        $data = $this->getProductFormData();
        $data['product'] = $this->productRepository->find($id);
        return $data;
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function getProductWithRelations($id)
    {
        return Product::with(['subcategory', 'subcategory.category'])->findOrFail($id);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProducts($id, $page)
    {
        DB::transaction(function () use ($id, $page) {
            if ($page == 1) {
                $this->productRepository->delete($id);
            }

            if ($page == 2) {
                $this->productRepository->deleteAll();
            }
        });
    }
}
