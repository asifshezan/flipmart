<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $coupons = Coupon::where('coupon_status',1)->orderBy('coupon_id','DESC')->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create(){
        return view('admin.coupon.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'coupon_code' => 'required',
        ],[
            'coupon_code.required' => 'please enter code.'
        ]);

        $insert = Coupon::insertGetId([
            'coupon_title' => $request['coupon_title'],
            'coupon_code' => $request['coupon_code'],
            'coupon_amount' => $request['coupon_amount'],
            'coupon_starting' => $request['coupon_starting'],
            'coupon_ending' => $request['coupon_ending'],
            'coupon_remarks' => $request['coupon_remarks'],
            'coupon_slug' => Str::slug($request['coupon_code']),
            'coupon_creator' => Auth::user()->id,
            'coupon_status' => 1,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            Session::flash('success','Successfully insert');;
            return redirect()->back();
        }else{
            Session::flash('error','Opps!');
            return redirect()->back();
        }
    }

}
