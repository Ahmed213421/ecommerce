<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $this->commentService->submitComment($request->validated());

        return back()->with('success','your message has sent please wait for verification');
    }
}
