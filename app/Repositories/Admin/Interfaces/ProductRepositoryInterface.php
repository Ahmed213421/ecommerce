<?php

namespace App\Repositories\Admin\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    /**
     * Get all products
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find product by ID
     *
     * @param int $id
     * @return Product|null
     */
    public function find($id);

    /**
     * Create new product
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data);

    /**
     * Update product
     *
     * @param int $id
     * @param array $data
     * @return bool|Product
     */
    public function update($id, array $data);

    /**
     * Delete product
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);

    /**
     * Delete all products
     *
     * @return bool
     */
    public function deleteAll();
}
