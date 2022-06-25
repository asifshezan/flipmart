<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $all = Product::where('Product_status',1)->orderBy('Product_id','DESC')->get();
        return view('admin.product.index', compact('all'));
    }

    public function create(){
        return view('admin.product.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'product_name' => 'required',
            'pro_category_id' => 'required',
            'brand_id' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
            'product_image' => 'required',
        ]);

        // Multiple Image
        if($request->hasFile('product_gallery')){
            $gallerys = $request->file('product_gallery');
            foreach($gallerys as $gallery){
                $gallery_name = 'pro' . '_' . rand(100000, 10000000) . '.' . $gallery->getClientOriginalExtension();
                Image::make($gallery)->resize(700, 700)->save('uploads/product/gallery/' . $gallery_name);
                $data[] = $gallery_name;
            }
        }
        else{
            $data[] = '';
        }

        // // Product Image Update
        if ($request->hasFile('product_image')) {
            $product_image = $request->file('product_image');
            $product_image_name = time() . '_' . rand(100000, 10000000) . '.' . $product_image->getClientOriginalExtension();
            Image::make($product_image)->resize(700, 700)->save('uploads/product/' . $product_image_name);
        }

        // Feature List
        if ($request->product_feature == 'on') {
            $product_feature = 1;
        }else{
            $product_feature = 0;
        }

        $product = Product::create([
            'product_name' => $request->product_name,
            'pro_category_id' => $request->pro_category_id,
            'brand_id' => $request->brand_id,
            'product_price' => $request->product_price,
            'product_discount_price' => $request->product_discount_price,
            'product_quantity' => $request->product_quantity,
            'product_unit' => $request->product_unit,
            'product_feature' => $product_feature,
            'product_details' => $request->product_details,
            'product_image' => $product_image_name,
            'product_order' => $request->product_order,
            'product_gallery' => implode(',', $data),
            'product_order' => $request->product_order,
            'product_description' => $request->product_description,
            'product_creator' => Auth::user()->id,
            'product_slug' => 'pro' . uniqid(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if ($product) {
            Session::flash('success', 'Product Created successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'Product Created Failed');
            return redirect()->back();
        }
    }
}
