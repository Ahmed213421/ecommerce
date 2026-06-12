<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminStatusService;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    protected $adminStatusService;

    public function __construct(AdminStatusService $adminStatusService)
    {
        $this->adminStatusService = $adminStatusService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $this->adminStatusService->toggleStatus($request->status, $id, $request->commentid);

        return back();
    }
}
