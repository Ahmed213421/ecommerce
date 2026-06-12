<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ReviewRequest;
use App\Http\Requests\Admin\TestmonialRequest;
use App\Services\TestmonialService;
use Illuminate\Http\Request;

class TestmonialController extends Controller
{
    protected $testmonialService;

    public function __construct(TestmonialService $testmonialService)
    {
        $this->testmonialService = $testmonialService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shop.review');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestmonialRequest $request)
    {
        $this->testmonialService->submitTestmonial($request->validated());

        return back()->with('success', 'your message has been sent please wait for verification');
    }
}
