<?php

namespace App\Repositories\Admin;

use App\Models\Slider;
use App\Repositories\Admin\Interfaces\SliderRepositoryInterface;
use Illuminate\Support\Facades\File;

class SliderRepository implements SliderRepositoryInterface
{
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function getAll()
    {
        return $this->slider->latest()->get();
    }

    public function create(array $data)
    {
        return $this->slider->create($data);
    }

    public function update(array $data, $id)
    {
        $slider = $this->slider->find($id);
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
        $slider = $this->slider->find($id);
        if ($slider) {
            $imagePath = public_path('images/' . $slider->imagepath);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            return $slider->delete();
        }
        return false;
    }

    public function find($id)
    {
        return $this->slider->find($id);
    }
}
