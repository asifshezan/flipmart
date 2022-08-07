<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Coupon;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
// use Darryldecode\Cart\Cart;
use Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use function Sodium\Compare;

class CartController extends Controller
{
    public function index(){
        $allcart = Cart::getContent();
        return view('website.shopping_cart', compact('allcart'));
    }


    public function store($slug){
        $product = Product::where('product_status', 1)->where('product_slug', $slug)->firstOrFail();
        Cart::add([
            'id' => $product->product_id,
            'name' => $product->product_name,
            'price' => $product->product_discount_price,
            'quantity' => 1,
            'attributes' => [
                'product_image' => $product->product_image
            ]
        ]);
        return redirect()->back();
    }

    public function destroy($id){
        $cart_remove = Cart::remove($id);
        if($cart_remove)    {
            Cart::clearCartConditions();
        }
        return redirect()->back();
    }


    public function coupon_apply(Request $request){
        $coupon = Coupon::where('coupon_status',1)->where('coupon_code', $request->coupon_code)->first();

        if($coupon){
            if($coupon->coupon_ending >= date('Y-m-d', strtotime(Carbon::now()))){
                Cart::clearCartConditions();
                $condition = new CartCondition(array(
                    'name' => $coupon->coupon_title,
                    'type' => 'coupon',
                    'target' => 'total',
                    'value' => -$coupon->coupon_amount,
                    'attributes' => array(
                        'user_id' => $request->user_id
                    )
                ));
                Cart::condition($condition);
                $condition_data = Cart::getConditions();
                return redirect()->back()->with('success', 'Coupon code applied successfully.', compact('condition_data'));
            }else{
                return 'Coupon card Expired.';
            }
        }else{
            return "Coupon code is not valid";
        }
    }

    public function coupon_remove(){
        Cart::clearCartConditions();
        return redirect()->back();
    }
}
