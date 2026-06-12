<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $adminContactService;

    public function __construct(AdminContactService $adminContactService)
    {
        $this->adminContactService = $adminContactService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = $this->adminContactService->getAllContacts();
        return view('dashboard.contactors.index', compact('contacts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->adminContactService->deleteContact($id);

        toastr()->success(__('toaster.del'));
        return back();
    }
}
