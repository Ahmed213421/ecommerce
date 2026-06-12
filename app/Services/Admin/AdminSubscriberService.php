<?php

namespace App\Services\Admin;

use App\Models\Subscriber;

class AdminSubscriberService
{
    public function getAllSubscribers()
    {
        return Subscriber::latest()->get();
    }
}
