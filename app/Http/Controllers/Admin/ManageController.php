<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasicSetting;
use App\Models\ContactInfo;
use App\Models\SocialInfo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function basic_index(){
        $basic = BasicSetting::where('basic_id',1)->firstorFail();
        return view('admin.settings.basic_setting',compact('basic'));
    }

    public function basic_update(Request $request){

        $basic = BasicSetting::where('Basic_id',1)->firstorFail();
        //basic_logo
        if($request->hasfile('basic_logo')){
        $image = $request->file('basic_logo');
        $header_logo = 'Basic' . time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(250,250)->save('uploads/basic_info/' . $header_logo);
        }else{
            $header_logo = $basic->basic_logo;
        }

    //basic_flogo
    if($request->hasfile('basic_flogo')){
        $image = $request->file('basic_flogo');
        $footer_logo = 'Fotter' . time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(250,250)->save('uploads/basic_info/' . $footer_logo);
    }else{
        $footer_logo = $basic->basic_flogo;
    }

        //basic_favicon
        if($request->hasfile('basic_favicon')){
            $image = $request->file('basic_favicon');
            $favicon_image = 'Favicon' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(250,250)->save('uploads/basic_info/' . $favicon_image);
        }else{
            $favicon_image = $basic->basic_favicon;
        }

        $update = BasicSetting::where('Basic_id', 1)->update([
            'basic_company' => $request['basic_company'],
            'basic_title' => $request['basic_title'],
            'basic_logo' => $header_logo,
            'basic_flogo' => $footer_logo,
            'basic_favicon' => $favicon_image,
            'updated_at' => Carbon::now()->toDateTimestring(),
        ]);

            if($update){
                Session::flash('success', 'Successfully Updated');
                return redirect()->back();
            }else{
                Session::flash('error', 'Opps! Updated Failed');
                return redirect()->back();
            }

    }


    Public function contact_index(){
        $data = ContactInfo::where('cont_status',1)->where('cont_id', 1)->firstOrFail();
        return view('admin.settings.contact_info', compact('data'));
    }

    Public function contact_update(Request $request){
        // dd($request->all());
        $data = ContactInfo::where('cont_id', 1)->where('cont_status', 1)->update([
            'cont_phone1' => $request->cont_phone1,
            'cont_phone2' => $request->cont_phone2,
            'cont_email1' => $request->cont_email1,
            'cont_email2' => $request->cont_email2,
            'cont_add1' => $request->cont_add1,
            'cont_add2' => $request->cont_add2,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($data) {
            Session::flash('success', 'Successfully Update');
            return redirect()->back();
        } else {
            Session::flash('error', 'OPPs!Update Failed');
            return redirect()->back();
        }
    }

    Public function social_index(){
        $data = SocialInfo::where('sm_status',1)->where('sm_id',1)->firstOrFail();
        return view('admin.settings.social_info', compact('data'));
    }

    Public function social_update(Request $request){
        $update = SocialInfo::where('sm_id', 1)->update([
        'sm_facebook' => $request->sm_facebook,
        'sm_twitter' => $request->sm_twitter,
        'sm_linkedin' => $request->sm_linkedin,
        'sm_dribble' => $request->sm_dribble,
        'sm_youtube' => $request->sm_youtube,
        'sm_slack' => $request->sm_slack,
        'sm_instagram' => $request->sm_instagram,
        'sm_behance' => $request->sm_behance,
        'sm_google' => $request->sm_google,
        'sm_raddit' => $request->sm_raddit,
        'sm_status' => 1,
        'updated_at' => Carbon::now()->toDateTimestring()
        ]);

        if($update){
            Session::flash('success', 'Successfully Update Social Setting');
            return redirect()->back();
        }else{
        Session::flash('error', 'Update Failed');
        return redirect()->back();

        }

    }

}
