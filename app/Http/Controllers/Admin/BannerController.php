<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $all = Banner::where('banner_status',1)->orderBy('banner_id','DESC')->get();
        return view('admin.banner.index', compact('all'));
    }

    public function create(){
        return view('admin.banner.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'banner_title' => ['required', 'string'],
            'banner_mid_title' => ['required', 'string'],
            'banner_subtitle' => ['required', 'string'],
            'banner_order' => ['required', 'integer']
        ],[
            'banner_title.required' => 'Please Enter Banner Title',
            'banner_order.required' => 'Please Enter Banner Order',
        ]);

        $slug = Str::slug($request['banner_title'], '-');
        $creator = Auth::user()->id;
        $insert = Banner::insertGetId([
            'banner_title' => $request['banner_title'],
            'banner_mid_title' => $request['banner_mid_title'],
            'banner_subtitle' => $request['banner_subtitle'],
            'banner_button' => $request['banner_button'],
            'banner_url' => $request['banner_url'],
            'banner_order' => $request['banner_order'],
            'banner_publish' => Auth::user()->id,
            'banner_creator' => $creator,
            'banner_slug' => $slug,
            'banner_status' => 1,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($request->hasFile('banner_image')){
            $image = $request->file('banner_image');
            $imageName = $insert . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/banner/' . $imageName);

            Banner::where('banner_id',$insert)->update([
                'banner_image' => $imageName,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
        if($insert){
            Session::flash('success','successfully insert partner');
            return redirect()->back();
        }else{
            Session::flash('error','Opps! Failed to insert.');
            return redirect()->back();
        }
    }

    public function show($slug){
        $data = Banner::where('banner_status',1)->where('banner_slug',$slug)->firstOrFail();
        return view('admin.banner.show', compact('data'));
    }

    public function edit($slug){
        $data = Banner::where('banner_status',1)->where('banner_slug',$slug)->firstOrFail();
        return view('admin.banner.edit', compact('data'));
    }

    public function update(Request $request){
        $id = $request->banner_id;
        $this->validate($request,[
            'banner_title' => ['required', 'string'],
            'banner_mid_title' => ['required', 'string'],
            'banner_subtitle' => ['required', 'string'],
            'banner_order' => ['required', 'integer']
        ],[
            'banner_title.required' => 'Please Enter Banner Title',
            'banner_order.required' => 'Please Enter Banner Order',
        ]);

        $slug = Str::slug($request->banner_title, '-');
        $editor = Auth::user()->id;
        $update = Banner::where('banner_id',$id)->update([
            'banner_title' => $request['banner_title'],
            'banner_mid_title' => $request['banner_mid_title'],
            'banner_subtitle' => $request['banner_subtitle'],
            'banner_button' => $request['banner_button'],
            'banner_url' => $request['banner_url'],
            'banner_order' => $request['banner_order'],
            'banner_editor' => $editor,
            'banner_slug' => $slug,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($request->hasFile('banner_image')){
            $image = $request->file('banner_image');
            $imageName = $id . time() . '-' . rand(100,1000) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/banner/' . $imageName);

            Banner::where('banner_id',$id)->update([
                'banner_image' => $imageName,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        if($update){
            Session::flash('success','Successfully updated Banner.');
            return redirect()->back();
        }else{
            Session::flash('error','Opps!! Failed to Updated Banner.');
            return redirect()->back();
        }
    }

    public function softdelete($slug){
        $soft = Banner::where('banner_slug',$slug)->where('banner_status',1)->update([
            'banner_status' => 0,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($soft){
            Session::flash('success','Successfully SoftDelete Partner.');
            return redirect()->back();
        }else{
            Session::flash('error','Opps! Failed to SoftDelete.');
            return redirect()->back();
        }
    }

}
