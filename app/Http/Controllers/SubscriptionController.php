<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\SubscriberRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SubscriptionController extends Controller
{
    protected $subscriberRepository;

    public function __construct(SubscriberRepositoryInterface $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $this->subscriberRepository->create([
            'email' => $request->email,
        ]);

        toastr()->success(__('dashboard.subscribe_success'));
        return back();

    }

    public function unsubscribe($token)
    {

        $decryptedToken = Crypt::decrypt($token);
        $subscriber = $this->subscriberRepository->findByToken($decryptedToken);

        if (!$subscriber) {
            return 'Invalid unsubscribe link.';
        }

        $this->subscriberRepository->deleteByToken($decryptedToken);

        return 'unsubscribed successfully';
    }


}
