<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminProfileService
{
    public function updateProfile($adminId, array $data, $request)
    {
        $user = Admin::find($adminId);
        
        if (!empty($data['name'])) {
            $user->name = $data['name'];
        }

        if (!empty($data['email'])) {
            $user->email = $data['email'];
        }

        if ($request->hasFile('photo')) {
            if ($user->image) {
                if (file_exists(public_path($user->image->imagepath))) {
                    unlink(public_path($user->image->imagepath));
                }
                $path = 'dashboard/' . $request->photo->storeAs('admin_profile', time() . '_' . $request->photo->getClientOriginalName(), 'images');
                $user->image->update(['imagepath' => $path]);
            } else {
                $path = 'dashboard/' . $request->photo->storeAs('admin_profile', time() . '_' . $request->photo->getClientOriginalName(), 'images');
                $user->image()->create(['imagepath' => $path]);
            }
        }

        if (!empty($data['password'])) {
            if (!Hash::check($request->oldpassword, $user->password)) {
                return ['success' => false, 'error' => ['oldpassword' => 'The old password is incorrect.']];
            }

            $user->password = Hash::make($data['password']);
            $user->save();

            Auth::guard('admin')->logout();

            return ['success' => true, 'logout' => true];
        }

        $user->save();

        return ['success' => true, 'logout' => false];
    }
}
