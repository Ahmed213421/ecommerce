<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminSubscriberService;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    protected $adminSubscriberService;

    public function __construct(AdminSubscriberService $adminSubscriberService)
    {
        $this->adminSubscriberService = $adminSubscriberService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['subscribers'] = $this->adminSubscriberService->getAllSubscribers();
        return view('dashboard.subscribers.index', $data);
    }

}
