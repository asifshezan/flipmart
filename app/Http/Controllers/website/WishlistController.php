<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index(){
        $wishlists = Wishlist::where('wishlist_status',1)->get();
        return view('website.wishlist', compact('wishlists'));
    }
}
