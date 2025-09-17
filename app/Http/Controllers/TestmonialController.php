<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ReviewRequest;
use App\Http\Requests\Admin\TestmonialRequest;
use App\Repositories\Admin\Interfaces\ReviewRepositoryInterface;
use App\Repositories\Admin\Interfaces\TestmonialRepositoryInterface;
use Illuminate\Http\Request;

class TestmonialController extends Controller
{
    protected $reviewRepository;

    public function __construct(TestmonialRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
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
        $this->reviewRepository->create($request->validated());

        return back()->with('success', 'your message has been sent please wait for verification');
    }
}
