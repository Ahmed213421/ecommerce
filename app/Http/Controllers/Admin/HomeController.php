<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminHomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $adminHomeService;

    public function __construct(AdminHomeService $adminHomeService)
    {
        $this->adminHomeService = $adminHomeService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $chart1 = $this->adminHomeService->getChart();
        return view('dashboard.index', compact('chart1'));
    }
}
