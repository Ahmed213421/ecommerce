<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $adminOrderService;

    public function __construct(AdminOrderService $adminOrderService)
    {
        $this->adminOrderService = $adminOrderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['orders'] = $this->adminOrderService->getAllOrders();
        return view('dashboard.orders.index', $data);
    }
}
