<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BasicSetting;
use App\Models\ContactInfo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function basic_index(){
        $data = BasicSetting::where('basic_status',1)->where('basic_id','ASC')->firstOrFail();
        return view('admin.settings.basic_setting', compact('data'));
    }


    Public function contact_index(){
        $data = ContactInfo::where('cont_status',1)->where('cont_id', 1)->firstOrFail();
        return view('admin.settings.contact_info', compact('data'));
    }
}
