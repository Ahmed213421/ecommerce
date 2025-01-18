<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ChangeStatusContnroller extends Controller
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
    }
}
