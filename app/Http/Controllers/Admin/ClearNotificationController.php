<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClearNotificationController extends Controller
{
    protected $adminNotificationService;

    public function __construct(AdminNotificationService $adminNotificationService)
    {
        $this->adminNotificationService = $adminNotificationService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $success = $this->adminNotificationService->clearAllNotifications($admin);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'All notifications deleted.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No admin authenticated.'
        ]);
    }
}
