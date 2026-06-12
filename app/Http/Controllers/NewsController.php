<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->newsService->getLatestNews();
        return view('shop.news.index',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $data = $this->newsService->getNewsDetails($slug);
        return view('shop.news.show',$data);
    }



}
