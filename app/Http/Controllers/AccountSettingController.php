<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shop.setting.index');
    }

    
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'string|max:255',
            'email' => 'email|max:255|unique:admins,email,' . auth()->id(),
            'password' => 'string|min:8|confirmed|nullable',
            'photo' => 'image',
        ]);
        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;


        if ($request->hasFile('photo')) {
            if($user->image){
                if (file_exists(public_path($user->image->imagepath))) {
                    unlink(public_path($user->image->imagepath));
                }
                $path = 'dashboard/'.$request->photo->storeAs('user_profile', time().'_'.$request->photo->getClientOriginalName(),'images');

                $user->image->update(['imagepath' => $path]);

            }
            else{
                $path = 'dashboard/'.$request->photo->storeAs('user_profile', time().'_'.$request->photo->getClientOriginalName(),'images');

                $user->image()->create(['imagepath' => $path]);
            }
        }

        if(!Hash::check($request->oldpassword, $user->password)){
            return back()->withErrors(['oldpassword' => 'The old password is incorrect.']);
        }

        if ($request->filled('password') && Hash::check($request->oldpassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();


            Auth::logout();


            return redirect()->route('customer.logout');
        }

        $user->save();

        return back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
