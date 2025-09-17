<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Testmonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestmonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['reviews'] = Testmonial::latest()->get();
        return view('dashboard.testmonials.index',$data);
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        Testmonial::find($id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        toastr()->success(__('toaster.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Testmonial::find($id)->delete();

        toastr()->success(__('toaster.del'));

        return back();
    }

}
