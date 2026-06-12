<?php

namespace App\Services\Admin;

use App\Repositories\Admin\Contracts\SliderContract;

class AdminSlideService
{
    protected $sliderRepository;

    public function __construct(SliderContract $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    public function getAllSlides()
    {
        return $this->sliderRepository->getAll();
    }

    public function createSlide(array $data)
    {
        return $this->sliderRepository->create($data);
    }

    public function updateSlide($id, array $data)
    {
        return $this->sliderRepository->update($id, $data);
    }

    public function deleteSlide($id)
    {
        return $this->sliderRepository->delete($id);
    }
}
