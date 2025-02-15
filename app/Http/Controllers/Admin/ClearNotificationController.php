<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClearNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $admin = Auth::guard('admin')->user();
                if ($admin) {
                    $admin->notifications->each->delete(); // Mark all unread notifications as read
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
