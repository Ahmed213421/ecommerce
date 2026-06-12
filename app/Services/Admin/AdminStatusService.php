<?php

namespace App\Services\Admin;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subscriber;
use App\Models\Testmonial;

class AdminStatusService
{
    public function toggleStatus($type, $id, $commentId = null)
    {
        switch ($type) {
            case 'review':
                $review = Review::find($id);
                if ($review) {
                    $review->update(['status' => $review->status == 0 ? 1 : 0]);
                }
                break;

            case 'testmonial':
                $testmonial = Testmonial::find($id);
                if ($testmonial) {
                    $testmonial->update(['status' => $testmonial->status == 0 ? 1 : 0]);
                }
                break;

            case 'featured':
                $product = Product::find($id);
                if ($product) {
                    $product->update(['featured' => $product->featured == 0 ? 1 : 0]);
                }
                break;

            case 'subscribe':
                $subscriber = Subscriber::find($id);
                if ($subscriber) {
                    $subscriber->update(['status' => $subscriber->status == 'active' ? 'unactive' : 'active']);
                }
                break;

            case 'comment':
                $comment = Comment::where('id', $commentId)->first();
                if ($comment) {
                    $comment->update(['status' => $comment->status == 1 ? 0 : 1]);
                }
                break;
        }

        return true;
    }
}
