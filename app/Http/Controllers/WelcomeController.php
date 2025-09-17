<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\WelcomeRepositoryInterface;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    protected $welcomeRepository;

    public function __construct(WelcomeRepositoryInterface $welcomeRepository)
    {
        $this->welcomeRepository = $welcomeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->welcomeRepository->getHomePageData();
        return view('welcome',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
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
