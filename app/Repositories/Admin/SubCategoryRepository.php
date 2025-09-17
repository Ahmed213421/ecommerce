<?php

namespace App\Repositories\Admin;

use App\Models\Subcategory;
use Illuminate\Support\Facades\File;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    protected $subcategory;

    public function __construct(Subcategory $subcategory)
    {
        $this->subcategory = $subcategory;
    }



    public function update(array $data, $id)
    {
        $subcategory = $this->subcategory->find($id);
        if ($subcategory) {
            if (isset($data['imagepath']) && $subcategory->imagepath !== $data['imagepath']) {
                $oldImagePath = public_path('images/' . $subcategory->imagepath);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $subcategory->update($data);
            return $subcategory;
        }
        return false;
    }

    public function delete($id)
    {
        $subcategory = $this->subcategory->find($id);
        if ($subcategory) {
            $imagePath = public_path('images/' . $subcategory->imagepath);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            return $subcategory->delete();
        }
        return false;
    }

}
