<?php

namespace App\Repositories\Admin\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Slider;
use App\Repositories\Admin\Contracts\SliderContract;
use Illuminate\Support\Facades\File;

class SliderRepository extends BaseRepository implements SliderContract
{

    public function __construct(Slider $slider)
    {
        parent::__construct($slider);
    }

    public function getAll()
    {
        return $this->model->latest()->get();
    }

    public function create(array $data = []): mixed
    {
        return $this->model->create($data);
    }

    public function update($id, array $data = []): mixed
    {
        $slider = $this->model->find($id);
        if ($slider) {
            if (isset($data['imagepath']) && $slider->imagepath !== $data['imagepath']) {
                $oldImagePath = public_path('images/' . $slider->imagepath);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $slider->update($data);
            return $slider;
        }
        return false;
    }

    public function delete($id)
    {
        $slider = $this->model->find($id);
        if ($slider) {
            $imagePath = public_path('images/' . $slider->imagepath);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            return $slider->delete();
        }
        return false;
    }

    public function find(int $id, array $relations = [], array $filters = []): mixed
    {
        return $this->model->find($id);
    }
}
