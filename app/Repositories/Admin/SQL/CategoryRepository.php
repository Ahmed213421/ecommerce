<?php

namespace App\Repositories\Admin\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Repositories\Admin\Contracts\CategoryContract;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Str;

class CategoryRepository extends BaseRepository implements CategoryContract
{

    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function create(array $data = []): mixed
    {
        if (request()->hasFile('imagepath')) {
            $img =  'dashboard/'.$data['imagepath']->storeAs('category', time().'_'.$data['imagepath']->getClientOriginalName(),'images');
        }
        else{
            $img = null;
        }
        if (!empty($data['category_id'])) {
            $category = Subcategory::create([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'description' => $data['description'] ?? null,
                'imagepath' => $img,
                'slug' => Str::slug($data['name']['en']),
            ]);
        } else {
            $category = $this->model->create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'imagepath' => $img,
                'slug' => Str::slug($data['name']['en']),
            ]);
        }
        return $category;
    }

    public function update($model, array $data = []): mixed
    {
        $img = $model->imagepath;

        if (!empty($data['image'])) {
            if ($data['imagepath'] &&  file_exists(public_path($data['imagepath']))) {
                unlink(public_path($data['imagepath']));
            }
            $img =  'dashboard/'.$data['imagepath']->storeAs('category', time().'_'.$data['imagepath']->getClientOriginalName(),'images');
        }
        $model->update([
            'name' => ['en' => $data['name']['en'] , 'ar' => $data['name']['ar']],
            'description' => ['en' => $data['description']['en'] , 'ar' => $data['description']['ar']],
            'imagepath' => $img,
            'slug' => Str::slug($data['name']['en']),
        ]);

        return $model;
    }

    public function destroy($model){
        $model->delete();
        if ($model['imagepath'] &&  file_exists(public_path($model['imagepath']))) {
            unlink(public_path($model['imagepath']));
        }

        return $model;
    }
}
