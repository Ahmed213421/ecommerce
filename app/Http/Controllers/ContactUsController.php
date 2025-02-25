<?php

namespace App\Http\Controllers;

use App\Events\NewContactEvent;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shop.contactus.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'message' => 'required',
            'email' => 'required',
            'subject' => 'required',

        ]);

        if ($validator->fails()) {
            // Redirect back to the form with the error messages
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        Contact::create(['name'=> $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'subject' => $request->subject,
        'message' => $request->message,
        ]);

        $admins = Admin::all();
        Notification::send($admins,new NewContactNotification($request->name));

        NewContactEvent::dispatch($request->name);
        toastr()->success(__('shop.contact'));

        return redirect()->route('customer.home');
    }


}
