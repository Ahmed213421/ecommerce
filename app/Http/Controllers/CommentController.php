<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'message' => 'required',
            'email' => 'required',
            'postid' => 'required|exists:posts,id',
        ]);

        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $this->commentRepository->create([
            'post_id' => $request->postid,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'status' => 0,
        ]);

        return back()->with('success','your message has sent please wait for verification');
    }

}
