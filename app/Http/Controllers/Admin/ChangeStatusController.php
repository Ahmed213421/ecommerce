<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subscriber;
use App\Models\Testmonial;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$id)
    {
        if($request->status == 'review'){
            $review = Review::find($id);
            if($review->status == 0){
                $review->update(['status' => 1]);
            }
            else{
                $review->update(['status' => 0]);
            }

            return back();
        }
        if($request->status == 'testmonial'){
            $review = Testmonial::find($id);
            if($review->status == 0){
                $review->update(['status' => 1]);
            }
            else{
                $review->update(['status' => 0]);
            }

            return back();
        }
        if($request->status == 'featured'){
            $product = Product::find($id);
            if($product->featured == 0){
                $product->update(['featured' => 1]);
            }
            else{
                $product->update(['featured' => 0]);
            }

            return back();
        }
        if($request->status == 'subscribe'){
            $subscriber = Subscriber::find($id);
            if($subscriber->status == 'active'){
                $subscriber->update(['status' => 'unactive']);
            }
            else{
                $subscriber->update(['status' => 'active']);
            }

            return back();
        }
        if($request->status == 'comment'){
            $comment = Comment::where('id',$request->commentid)->first();
            if($comment->status == 1){
                $comment->update(['status' => 0]);
            }
            else{
                $comment->update(['status' => 1]);
            }

            return back();
        }
    }
}
