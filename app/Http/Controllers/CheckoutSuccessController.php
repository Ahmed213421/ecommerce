<?php

namespace App\Http\Controllers;

use App\Events\NewOrderEvent;
use App\Models\Admin;
use App\Repositories\Contracts\CartContract;
use App\Repositories\Contracts\OrderContract;
use App\Models\OrderDetail;
use App\Notifications\NewOrderNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

use App\Services\CheckoutService;
    

class CheckoutSuccessController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $status)
    {
        try {
            DB::beginTransaction();

            $result = $this->checkoutService->handleCheckoutSuccess($request->get('session_id'));

            if (!$result['success']) {
                DB::rollBack();
                return response()->json(['message' => $result['message']], 400);
            }

            DB::commit();
            toastr()->success('تم الدفع');

            return redirect()->route('customer.home');
        } catch (Exception $e) {
            DB::rollBack(); 

            Log::error('Cart update failed: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return back()->withErrors(['error' => 'Something went wrong, please try again later.']);
        }
    }
}
