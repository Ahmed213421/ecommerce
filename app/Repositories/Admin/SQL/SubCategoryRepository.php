<?php

namespace App\Repositories\Admin\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use App\Repositories\Admin\Contracts\SubCategoryContract;
use Illuminate\Support\Facades\File;

class SubCategoryRepository extends BaseRepository implements SubCategoryContract
{

    public function __construct(Subcategory $subcategory)
    {
        parent::__construct($subcategory);
    }



    public function update($id, array $data = []): mixed
    {
        $subcategory = $this->model->find($id);
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
        $subcategory = $this->model->find($id);
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
