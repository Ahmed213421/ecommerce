<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function updateProfile($user, array $validatedData)
    {
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
    }

    public function destroyProfile($user, $session)
    {
        Auth::logout();

        $user->delete();

        $session->invalidate();
        $session->regenerateToken();
    }
}
