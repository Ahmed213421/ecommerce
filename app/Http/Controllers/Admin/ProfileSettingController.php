<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminProfileService;
use App\Http\Requests\Admin\AdminProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSettingController extends Controller
{
    protected $adminProfileService;

    public function __construct(AdminProfileService $adminProfileService)
    {
        $this->adminProfileService = $adminProfileService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.auth.profileSetting');
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileUpdateRequest $request, string $id)
    {
        $result = $this->adminProfileService->updateProfile(Auth::guard('admin')->id(), $request->validated(), $request);

        if (isset($result['success']) && !$result['success']) {
            return back()->withErrors($result['error']);
        }

        if (isset($result['logout']) && $result['logout']) {
            return redirect()->route('admin.logout');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
