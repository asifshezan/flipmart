<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    $all = ProductCategory::where('pro_cat_status',1)->orderBy('pro_cat_id','ASC')->get();
    return view('admin.category.index', compact('all'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'pro_cat_name' => 'required',
        ],[
            'pro_cat_name.required' => 'Please enter Product Category name.'
        ]);
        $creator = Auth::user()->id;
        $insert = ProductCategory::insertGetId([
            'pro_cat_name' => $request->pro_cat_name,
            'pro_cat_slug' => Str::slug($request->pro_cat_name, '-'),
            'pro_cat_parent' => $request->pro_cat_parent,
            'pro_cat_order' => $request->pro_cat_order,
            'pro_cat_icon' => $request->pro_cat_icon,
            'pro_cat_creator' => $creator,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('pro_cat_image')){
            $image = $request->file('pro_cat_image');
            $imageName = $insert . time() . rand(1000,10000). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/category/' . $imageName);

            ProductCategory::where('pro_cat_id',$insert)->update([
                'pro_cat_image' => $imageName,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
        if($insert){
            Session::flash('success','successs');
            return redirect()->back();
        }else{
            Session::flash('error','error');
            return redirect()->back();
        }
    }

    public function edit($slug){
        $category = ProductCategory::where('pro_cat_status',1)->where('pro_cat_slug',$slug)->firstOrFail();
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'pro_cat_name' => 'required',
        ],[
            'pro_cat_name.required' => 'Enter Your oroduct category Name.'
        ]);
        $id = $request->pro_cat_id;
        $slug = Str::slug($request->pro_cat_name, '-');
        $editor = Auth::user()->id;
        $update = ProductCategory::where('pro_cat_id',$id)->update([
            'pro_cat_name' => $request->pro_cat_name,
            'pro_cat_slug' => $slug,
            'pro_cat_parent' => $request->pro_cat_parent,
            'pro_cat_order' => $request->pro_cat_order,
            'pro_cat_icon' => $request->pro_cat_icon,
            'pro_cat_editor' => $editor,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('pro_cat_image')){
            $image = $request->file('pro_cat_image');
            $imageName = $id . time() . rand(1000,10000). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/category/' . $imageName);

            ProductCategory::where('pro_cat_id',$id)->update([
                'pro_cat_image' => $imageName,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
        if($update){
            Session::flash('success','successs');
            return redirect()->back();
        }else{
            Session::flash('error','error');
            return redirect()->back();
        }
    }

    public function softdelete($slug){
        $soft = ProductCategory::where('pro_cat_slug',$slug)->where('pro_cat_status',1)->update([
            'pro_cat_status' => 0,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);
        if($soft){
            Session::flash('success','successfully update partner');
            return redirect()->back();
        }else{
            Session::flash('error','Opps! Failed to update.');
            return redirect()->back();
        }
    }
}
