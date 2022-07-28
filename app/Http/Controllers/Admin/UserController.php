<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $all = User::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.user.index', compact('all'));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => 'required',
        ],[
            'name.required' => 'please enter your name.',
            'phone.required' => 'please enter your phone number.',
        ]);

        $user = User::insertGetId([
            'name' => $request['name'],
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'slug' => Str::slug($request->name, '-'),
            'password' => Hash::make($request->password),
            'address' => $request['address'],
            'status' => 1,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($user){
            Session::flash('success','Successfully insert user.');
            return redirect()->back();
        }else{
            Session::flash('error', 'User create failed.');
            return redirect()->back();
        }
    }

    public function show($id){
        $data =  User::where('status',1)->where('id',$id)->firstOrFail();
        return view('admin.user.show', compact('data'));
    }

    public function edit($id){
        $data = User::where('status',1)->where('id',$id)->firstOrFail();
        return view('admin.user.edit', compact('data'));
    }

    public function update(Request $request){
        $id = $request['id'];

        $update = User::where('id',$id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role' => $request['role'],
            'slug' => Str::slug($request->name, '-'),
            'address' => $request['address'],
            'updated_at' => Carbon::now()->toDateString()
        ]);

        if($update){
            Session::flash('success','Successfully update user.');
            return redirect()->back();
        }else{
            Session::flash('error','opps! failed user.');
            return redirect()->back();
        }
    }

    public function softdelete($slug){
        $soft = User::where('status',1)->where('slug',$slug)->update([
            'status' => 0,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if($soft){
            Session::flash('success','Successfully delete.');
            return redirect()->back();
        }else{
            Session::flash('error','Opps! Failed to delete.');
            return redirect()->back();
        }
    }

}
