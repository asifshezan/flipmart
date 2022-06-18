<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $all = Partner::where('partner_status',1)->orderBy('partner_id','DESC')->get();
        return view('admin.partner.index', compact('all'));
    }

    public function create(){
        return view('admin.partner.create');
    }

    public function show($slug){
        $data = Partner::where('partner_status',1)->where('partner_slug',$slug)->firstOrFail();
        return view('admin.partner.show', compact('data'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'partner_title' => 'required',
            'partner_url' => 'required',
            'partner_logo' => 'required',
        ],[
            'partner_title' => 'Please enter title',
            'partner_logo' => 'Please enter logo',
        ]);

        $slug = Str::slug($request['partner_title']);
        $creator = Auth::user()->id;
        $insert = Partner::insertGetId([
            'partner_title' => $request->partner_title,
            'partner_slug' => $slug,
            'partner_url' => $request['partner_url'],
            'partner_order' => $request['partner_order'],
            'partner_creator' => $creator,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        if($request->hasFile('partner_logo')){
            $image = $request->file('partner_logo');
            $imageName = $insert . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/partner/' . $imageName);

            Partner::where('partner_id',$insert)->update([
                'partner_logo' => $imageName,
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

        public function edit($slug){
            $data = Partner::where('partner_status',1)->where('partner_slug',$slug)->firstOrFail();
            return view('admin.partner.edit', compact('data'));
        }

        public function update(Request $request){
            $id = $request->partner_id;
            $this->validate($request,[
                'partner_title' => 'required',
                'partner_url' => 'required',
            ],[
                'partner_title' => 'Please enter title',
                'partner_logo' => 'Please enter logo',
            ]);

            $editor = Auth::user()->id;
            $slug = Str::slug($request['partner_title']);
            $update = Partner::where('partner_id',$id)->update([
            'partner_title' => $request['partner_title'],
            'partner_slug' => $slug,
            'partner_url' => $request['partner_url'],
            'partner_order' => $request['partner_order'],
            'partner_editor' => $editor,
            'updated_at' => Carbon::now()->toDateTimeString()
            ]);

            if($request->hasFile('partner_logo')){
                $image = $request->file('partner_logo');
                $imageName = $id . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(200,200)->save('uploads/partner/' . $imageName);

                Partner::where('partner_id',$id)->update([
                    'partner_logo' => $imageName,
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
            }

            if($update){
                Session::flash('success','Successfully update partner info.');
                return redirect()->back();
            }else{
                Session::flash('error','Opps! Failed update.');
                return redirect()->back();
            }
        }

        public function softdelete($slug){
            $soft = Partner::where('partner_status',1)->where('partner_slug',$slug)->update([
                'partner_status' => 0,
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

