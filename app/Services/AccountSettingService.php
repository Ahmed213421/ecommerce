<?php

namespace App\Services;

use App\Repositories\Contracts\UserContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountSettingService
{
    protected $userRepository;

    public function __construct(UserContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateAccountSettings($userId, array $data, $request)
    {
        $user = $this->userRepository->findById($userId);
        
        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;

        if ($request->hasFile('photo')) {
            if ($user->image) {
                if (file_exists(public_path($user->image->imagepath))) {
                    unlink(public_path($user->image->imagepath));
                }
                $path = 'dashboard/' . $request->photo->storeAs('user_profile', time() . '_' . $request->photo->getClientOriginalName(), 'images');

                $user->image->update(['imagepath' => $path]);
            } else {
                $path = 'dashboard/' . $request->photo->storeAs('user_profile', time() . '_' . $request->photo->getClientOriginalName(), 'images');

                $user->image()->create(['imagepath' => $path]);
            }
        }

        if (!empty($data['password'])) {
            if (!Hash::check($request->oldpassword, $user->password)) {
                return ['success' => false, 'error' => ['oldpassword' => 'The old password is incorrect.']];
            }

            $user->password = Hash::make($data['password']);
            $user->save();

            Auth::logout();

            return ['success' => true, 'logout' => true];
        }

        $user->save();

        return ['success' => true, 'logout' => false];
    }
}
