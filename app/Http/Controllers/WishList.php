<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishList extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favorites;
        return view('shop.wishlist.index',compact('favorites'));
    }

}
