<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CartContract;
use App\Repositories\Contracts\OrderContract;
use App\Models\OrderDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Cashier\Checkout;

use App\Services\CheckoutService;
use App\Http\Requests\CheckoutRequest;

class CheckOutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->checkoutService->getIndexData();

        return view('shop.cart.checkout', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CheckoutRequest $request)
    {
        if (Auth::check()) {
            return $this->checkoutService->processCheckout($request->validated());
        }
    }
}
