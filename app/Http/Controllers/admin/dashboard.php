<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class dashboard extends Controller
{
    //
    public function get_login()
    {
        return view('admin.pages.login');
    }
    public function post_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => ["required", Rule::exists("users","email")],
            "password" => ["required",],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return back()->withErrors(["error" => "User name and email not match"])->onlyInput('error');
            }
            return redirect()->route('get_dashboard');
        } catch (\Throwable $e) {
            return back()->withErrors(["error" => $e->getMessage()])->onlyInput('error');
        }
    }
    public function get_register()
    {
        return view('admin.pages.register');
    }

    public function post_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "min:3", "max:20"],
            "email" => ["required", "unique:users,email"],
            "role" => ['required'],
            "username" => ["required", "min:3", "max:20"],
            "password" => ["required", "confirmed"],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $insert = new User();
            $insert->name = $request->name;
            $insert->email = $request->email;
            $insert->username = $request->username;
            $insert->role = $request->role;
            $insert->password = Hash::make($request->password);
            $insert->ip = $request->ip();
            $insert->save();
            if (!$insert) {
                return back()->withErrors(["error" => "User name and email not match"])->onlyInput('error');
            }
            try {
                if (!Auth::attempt($request->only('email', 'password'))) {
                    return back()->withErrors(["error" => "User name and email not match"])->onlyInput('error');
                }
                return redirect()->route('get_dashboard');
            } catch (\Throwable $e) {
                return back()->withErrors(["error" => $e->getMessage()])->onlyInput('error');
            }
        } catch (\Throwable $e) {
            return back()->withErrors(["error" => $e->getMessage()])->onlyInput('error');
        }
    }
    public function get_dashboard()
    {
        return view('admin.pages.dashboard');
    }
    public function load_get_dashboard_table()
    {
        $role = Auth::user()->role;

        if ($role == 3) {
            $data = DB::table('videos')->orderBy('updated_at', 'desc')->get();
            if (count($data) < 1) {
                $data = "No record found";
                return response()->json($data, 500);
            }
            return response()->json($data, 200);
        }
        if ($role == 2) {
            $data = DB::table('videos')->whereIn('role', [1, 2])->orderBy('updated_at', 'desc')->get();
            if (count($data) < 1) {
                $data = "No record found";
                return response()->json($data, 500);
            }
            return response()->json($data, 200);
        }
        if ($role == 1) {
            $data = DB::table('videos')->whereIn('role', [1])->orderBy('updated_at', 'desc')->get();
            if (count($data) < 1) {
                $data = "No record found";
                return response()->json($data, 500);
            }
            return response()->json($data, 200);
        }
    }
    public function get_destroy_login()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('get_login');
    }
    public function post_add_record(Request $request)
    {
        # code...
        $validator = Validator::make($request->all(), [
            "title" => ["required"],
            "description" => ["required"],
            "url" => ["required","unique:videos,url"],
            "file" => ["required"],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),500);
        }

        try {
            $name = now()->timestamp.$request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs("uploads/".Auth::user()->id,$name,"public");
            $insert = new Video();
            $insert->title = $request->title;
            $insert->description = $request->description;
            $insert->url = $request->url;
            $insert->file = $filepath;
            $insert->ip = $request->ip();
            $insert->user_id = Auth::user()->id;
            $insert->role = Auth::user()->role;
            $insert->save();
            return response()->json("file up loaded",200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(),501);
        }
    }
    public function edit(Request $request,$id)
    {
        $data = DB::table('videos')->where('id',$id)->get();
        return view('admin.pages.edit',['val' => $data]);
    }
    public function post_edit_record(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title_edit" => ["required"],
            "description_edit" => ["required"],
            "description_edit" => ["required","unique:videos,url"],
            "file" => ["required"],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
