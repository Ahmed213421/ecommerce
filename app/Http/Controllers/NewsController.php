<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts'] = Post::latest()->paginate(12);
        return view('shop.news.index',$data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $data['post'] = Post::where('slug', $slug)->with(['comments' => function($query) {
            $query->where('status', 1);
        }])->firstOrFail();
        $data['posts'] = Post::latest()->take(5)->get();
        return view('shop.news.show',$data);
    }



}
