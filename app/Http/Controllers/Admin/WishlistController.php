<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $auth_id = Auth::user()->id;
        }else{
            $auth_id = '';
        }

        $wishlists = Wishlist::where('wishlist_status',1)->where('user_id',$auth_id)->get();
        return view('website.wishlist', compact('wishlists'));
    }
}
