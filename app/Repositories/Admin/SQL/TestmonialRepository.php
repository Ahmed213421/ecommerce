<?php

namespace App\Repositories\Admin\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Events\NewCustomerReviewEvent;
use App\Models\Admin;
use App\Models\Testmonial;
use App\Notifications\NewCustomerReviewNotification;
use App\Repositories\Admin\Contracts\TestmonialContract;
use Illuminate\Support\Facades\Notification;

class TestmonialRepository extends BaseRepository implements TestmonialContract
{

    public function __construct(Testmonial $model)
    {
        parent::__construct($model);
    }

    public function create(array $data = []): mixed
    {

        $review = $this->model->create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 0,
        ]);

        $this->notifyAdmins($review);
        $this->dispatchEvent($review);

        return $review;
    }
    


    protected function notifyAdmins(Testmonial $review)
    {
        $admins = Admin::all();
        Notification::send($admins, new NewCustomerReviewNotification($review));
    }

    protected function dispatchEvent(Testmonial $review)
    {
        NewCustomerReviewEvent::dispatch($review);
    }
}
