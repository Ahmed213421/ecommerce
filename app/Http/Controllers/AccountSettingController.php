<?php

namespace App\Http\Controllers;

use App\Services\AccountSettingService;
use App\Http\Requests\UpdateAccountSettingRequest;
use Illuminate\Http\Request;

class AccountSettingController extends Controller
{
    protected $accountSettingService;

    public function __construct(AccountSettingService $accountSettingService)
    {
        $this->accountSettingService = $accountSettingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shop.setting.index');
    }

    
    public function update(UpdateAccountSettingRequest $request, string $id)
    {
        $result = $this->accountSettingService->updateAccountSettings(auth()->id(), $request->validated(), $request);

        if (!$result['success']) {
            return back()->withErrors($result['error']);
        }

        if ($result['logout']) {
            return redirect()->route('customer.logout');
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
