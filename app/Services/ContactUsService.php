<?php

namespace App\Services;

use App\Events\NewContactEvent;
use App\Models\Admin;
use App\Repositories\Contracts\ContactContract;
use App\Notifications\NewContactNotification;
use Illuminate\Support\Facades\Notification;

class ContactUsService
{
    protected $contactRepository;

    public function __construct(ContactContract $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function submitContact(array $data)
    {
        $this->contactRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);

        $admins = Admin::all();
        Notification::send($admins, new NewContactNotification($data['name']));

        NewContactEvent::dispatch($data['name']);
    }
}
