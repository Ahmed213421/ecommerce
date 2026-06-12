<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Services\Admin\AdminSlideService;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    protected $adminSlideService;

    public function __construct(AdminSlideService $adminSlideService)
    {
        $this->adminSlideService = $adminSlideService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sliders'] = $this->adminSlideService->getAllSlides();
        return view('dashboard.slider.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $this->adminSlideService->createSlide($request->validated());

        toastr()->success(__('toaster.add'));
        return back();
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        $this->adminSlideService->updateSlide($id, $request->validated());

        toastr()->success(__('toaster.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->adminSlideService->deleteSlide($id);

        toastr()->success(__('toaster.del'));
        return back();
    }
}
