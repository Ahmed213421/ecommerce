<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminTestmonialService;
use App\Http\Requests\Admin\TestmonialUpdateRequest;
use Illuminate\Http\Request;

class TestmonialController extends Controller
{
    protected $adminTestmonialService;

    public function __construct(AdminTestmonialService $adminTestmonialService)
    {
        $this->adminTestmonialService = $adminTestmonialService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['reviews'] = $this->adminTestmonialService->getAllTestmonials();
        return view('dashboard.testmonials.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestmonialUpdateRequest $request, string $id)
    {
        $this->adminTestmonialService->updateTestmonial($id, $request->validated());

        toastr()->success(__('toaster.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->adminTestmonialService->deleteTestmonial($id);

        toastr()->success(__('toaster.del'));
        return back();
    }

}
