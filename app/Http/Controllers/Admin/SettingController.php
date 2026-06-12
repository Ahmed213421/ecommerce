<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Services\Admin\AdminSettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $adminSettingService;

    public function __construct(AdminSettingService $adminSettingService)
    {
        $this->adminSettingService = $adminSettingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['settings'] = $this->adminSettingService->getAllSettings();
        return view('dashboard.setting.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($this->adminSettingService->getSettingCount() == 1) {
            abort(404);
        }
        return view('dashboard.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $this->adminSettingService->createSetting($request->validated(), $request);

        toastr()->success(__('toaster.add'));
        return redirect()->route('admin.setting.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('dashboard.setting.edit', [
            'setting' => $this->adminSettingService->getSettingById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, string $id)
    {
        $this->adminSettingService->updateSetting($id, $request->validated(), $request);

        toastr()->success(__('toaster.update'));
        return redirect()->route('admin.setting.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->adminSettingService->deleteSetting($id);

        toastr()->success(__('toaster.del'));
        return back();
    }
}
