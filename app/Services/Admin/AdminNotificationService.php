<?php

namespace App\Services\Admin;

class AdminNotificationService
{
    public function markNotificationAsRead($user, $notificationId)
    {
        if (!$user) {
            return false;
        }

        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
            return true;
        }

        return false;
    }

    public function clearAllNotifications($user)
    {
        if ($user) {
            $user->notifications->each->delete();
            return true;
        }
        return false;
    }
}
