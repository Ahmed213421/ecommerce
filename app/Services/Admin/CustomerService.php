<?php

namespace App\Services\Admin;

use App\Models\User;

class CustomerService
{
    public function getAllCustomers()
    {
        return User::latest()->get();
    }

    public function updateCustomerStatus($id, $status, $email = null)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['status' => $status]);

            if ($status == 'blocked') {
                if (auth('web')->check() && auth('web')->user()->email === $email) {
                    auth('web')->logout();
                }
            }
        }

        return $user;
    }
}
