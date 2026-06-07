<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function index()
    {
        return view('website.index');
    }

    public function boards()
    {
        return view('website.boards');
    }

    public function contact()
    {
        return view('website.contact');
    }
    public function guidelines()
    {
        return view('website.guidelines');
    }

    public function interviewVideo()
    {
        return view('website.interviewVideo');
    }
// First Issue
    public function firstIssue()
    {
        return view('website.firstIssue');
    }
    public function firstIssuepdf()
    {
        return view('website.firstIssuepdf');
    }
    public function downloadfirstIssue()
    {
        $file = public_path() . "/assets/issues/Final-Version-Trends-in-Physics-Mars.pdf";
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($file, 'Final-Version-Trends-in-Physics-Mars.pdf', $headers);
    }
// Second Issue
    public function secondIssue()
    {
        return view('website.secondIssue');
    }
    public function  secondIssuepdf()
    {
        return view('website.secondIssuepdf');
    }
    public function downloadsecondIssue()
    {
        $file = public_path() . "/assets/issues/TiP-June-Final-1.pdf";
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($file, 'TiP-June-Final-1.pdf', $headers);
    }
    // therdIssue Issue
    public function therdIssue()
    {
        return view('website.therdIssue');
    }
    public function  therdIssuepdf()
    {
        return view('website.therdIssuepdf');
    }
    public function downloadtherdIssue()
    {
        $file = public_path() . "/assets/issues/TiP-Sep-Final-Final.pdf";
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($file, 'TiP-Sep-Final-Final.pdf', $headers);
    }
    // fourthIssue Issue
    public function fourthIssue()
    {
        return view('website.fourthIssue');
    }
    public function  fourthIssuepdf()
    {
        return view('website.fourthIssuepdf');
    }
    public function downloadfourthIssue()
    {
        $file = public_path() . "/assets/issues/TiP-Sep-Final-Final.pdf";
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($file, 'TiP-Sep-Final-Final.pdf', $headers);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
