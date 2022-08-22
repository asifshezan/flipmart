<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Coupon;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
// use Darryldecode\Cart\Cart;
use App\Models\Division;
use App\Models\District;
use Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use function Sodium\Compare;

class CartController extends Controller
{
    public function index(){
        $allcart = Cart::getContent();
        $country = Division::select('id','name')->get();
        $city = District::select('id','name')->get();
        return view('website.shopping_cart', compact('allcart', 'country', 'city'));
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


    public function city_list(Request $request){
        $city_search = "";
        foreach(City::where('country_id',$request->country_id)->select('id','name')->get() as $city){
        $city_search = $city_search."<option value='".$city->id."'>$city->name</option>";
        }
        echo $city_search;
    }
}
