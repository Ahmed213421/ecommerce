<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $validator = Validator::make($request->all(),[
            'message' => 'required',
            'postid' => 'required|exists:posts,id',
        ]);

        if ($validator->fails()) {

            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $reeply = new Comment();
        $reeply->post_id = $request->postid;
        $reeply->message = $request->message;
        $reeply->parent_id = $request->parent_id;
        $reeply->save();

        return back()->with('success','your message has sent please wait for verification');
    }

}
