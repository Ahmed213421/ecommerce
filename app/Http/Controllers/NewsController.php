<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts'] = $this->postRepository->getLatestPaginated(12);
        return view('shop.news.index',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $data['post'] = $this->postRepository->findBySlug($slug);
        $data['posts'] = $this->postRepository->getLatest(5);
        return view('shop.news.show',$data);
    }



}
