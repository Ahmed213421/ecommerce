<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Repositories\Admin\Interfaces\SliderRepositoryInterface;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    protected $sliderRepository;

    public function __construct(SliderRepositoryInterface $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sliders'] = $this->sliderRepository->getAll();
        return view('dashboard.slider.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $this->sliderRepository->create($request->validated());

        toastr()->success(__('toaster.add'));
        return back();
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        $this->sliderRepository->update($request->validated(), $id);

        toastr()->success(__('toaster.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->sliderRepository->delete($id);

        toastr()->success(__('toaster.del'));
        return back();
    }
}
