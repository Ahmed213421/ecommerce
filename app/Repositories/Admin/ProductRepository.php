<?php

namespace App\Repositories\Admin;

use App\Models\Product;
use App\Repositories\Admin\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        if (request()->hasFile('imagepath')) {
            $data['imagepath'] = 'dashboard/' . request()->file('imagepath')->storeAs('products', time() . '_' . request()->file('imagepath')->getClientOriginalName(), 'images');
        }

        $product = $this->model->create($data);

        if (request()->hasFile('images')) {
            foreach (request()->file('images') as $imgFile) {
                $imgPath = 'dashboard/' . $imgFile->storeAs('products', time() . '_' . $imgFile->getClientOriginalName(), 'images');
                $product->images()->create(['imagepath' => $imgPath]);
            }
        }

        return $product;
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        if ($record) {
            if (request()->hasFile('imagepath')) {
                if ($record->imagepath && file_exists(public_path($record->imagepath))) {
                    unlink(public_path($record->imagepath));
                }
                $data['imagepath'] = 'dashboard/' . request()->file('imagepath')->storeAs('products', time() . '_' . request()->file('imagepath')->getClientOriginalName(), 'images');
            } else {
                $data['imagepath'] = $record->imagepath;
            }

            $record->update($data);

            if (request()->hasFile('images')) {
                foreach ($record->images as $existingImage) {
                    if (file_exists(public_path($existingImage->imagepath))) {
                        unlink(public_path($existingImage->imagepath));
                    }
                    $existingImage->delete();
                }

                foreach (request()->file('images') as $imgFile) {
                    $imgPath = 'dashboard/' . $imgFile->storeAs('products', time() . '_' . $imgFile->getClientOriginalName(), 'images');
                    $record->images()->create(['imagepath' => $imgPath]);
                }
            }

            return $record;
        }
        return false;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function destroy($id)
    {
        if (request()->page == 1) {
            $product = $this->model->findOrFail($id);
            if ($product) {
                foreach ($product->images as $image) {
                    if (file_exists(public_path($image->imagepath))) {
                        unlink(public_path($image->imagepath));
                    }
                    $image->delete();
                }
            }
            $product->delete();
            return true;
        }
        return false;
    }

    public function deleteAll()
{
    $ids = json_decode(request()->delete_all_id, true);

    foreach ($ids as $id) {
        $product = $this->model->with('images')->find($id);

        if (!$product) continue;
        if ($product->imagepath && file_exists(public_path($product->imagepath))) {
            unlink(public_path($product->imagepath));
        }

        foreach ($product->images as $image) {
            if (file_exists(public_path($image->imagepath))) {
                unlink(public_path($image->imagepath));
            }
            $image->delete();
        }

        $product->delete();
    }

    return true;
}

}
