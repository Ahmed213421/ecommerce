<?php

namespace App\Http\Controllers;

use App\Services\ContactUsService;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    protected $contactUsService;

    public function __construct(ContactUsService $contactUsService)
    {
        $this->contactUsService = $contactUsService;
    }
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
    public function store(ContactUsRequest $request)
    {
        $this->contactUsService->submitContact($request->validated());

        toastr()->success(__('shop.contact'));

        return redirect()->route('customer.home');
    }


}
