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
            "email" => ["required", Rule::exists("users", "email")],
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
        $role = Auth::user()->role;

        if ($role == 3) {
            $data = DB::table('videos')->orderBy('updated_at', 'desc')->get();
            if (count($data) < 1) {
                $data = "No record found";
                return view("admin.pages.dashboard", ['no_record' => $data]);
            }
            return view("admin.pages.dashboard", ['data_found' => $data]);
        }
        if ($role == 2) {
            $data = DB::table('videos')->whereIn('role', [1, 2])->orderBy('updated_at', 'desc')->get();
            if (count($data) < 1) {
                $data = "No record found";
                return view("admin.pages.dashboard", ['no_record' => $data]);
            }
            return view("admin.pages.dashboard", ['data_found' => $data]);
        }
        if ($role == 1) {
            $data = DB::table('videos')->whereIn('role', [1])->orderBy('updated_at', 'desc')->get();
            if (count($data) < 1) {
                $data = "No record found";
                return view("admin.pages.dashboard", ['no_record' => $data]);
            }
            return view("admin.pages.dashboard", ['data_found' => $data]);
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
            "url" => ["required", "unique:videos,url"],
            "file" => ["required"],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 500);
        }

        try {
            $name = now()->timestamp . $request->file->getClientOriginalName();
            $filepath = $request->file('file')->move(public_path('uploads/'), $name);
            $insert = new Video();
            $insert->title = $request->title;
            $insert->description = $request->description;
            $insert->url = $request->url;
            $insert->file = $name;
            $insert->ip = $request->ip();
            $insert->user_id = Auth::user()->id;
            $insert->role = Auth::user()->role;
            $insert->save();
            return response()->json("file up loaded", 200);
        } catch (\Throwable $e) {
            return response()->json($e->getMessage(), 501);
        }
    }
    public function edit(Request $request, $id)
    {
        $data = DB::table('videos')->where('id', $id)->get();
        return view('admin.pages.edit', ['val' => $data]);
        // 1
    }
    public function post_edit_record(Request $request)
    {
        $data = DB::table('videos')->where('url',$request->url_edit)->where('id',$request->id_edit)->get();
        if(count($data) < 1){
            $validator = Validator::make($request->all(), [
                "title_edit" => ["required"],
                "description_edit" => ["required"],
                "url_edit" => ["required","unique:videos,url"],
            ]);
        }else {
            $validator = Validator::make($request->all(), [
                "title_edit" => ["required"],
                "description_edit" => ["required"],
                "url_edit" => ["required"],
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('data')) {
            # code...
            $name = now()->timestamp . $request->data->getClientOriginalName();
            $filepath = $request->file('data')->move(public_path('uploads/'), $name);
            unlink(public_path("uploads/" . $request->old_file));
        } else {

            $name = $request->old_file;
        }
        $insert = Video::find($request->id_edit);
        $insert->title = $request->title_edit;
        $insert->description = $request->description_edit;
        $insert->url = $request->url_edit;
        $insert->file = $name;
        $insert->ip = $request->ip();
        $insert->user_id = Auth::user()->id;
        $insert->role = Auth::user()->role;
        $insert->save();

        return redirect()->route('get_dashboard');
    }
    public function delete(Request $request, $id)
    {
        $data = DB::table('videos')->where('id', $id)->get();
        unlink(public_path("uploads/" . $data[0]->file));
        $data = DB::table('videos')->delete($id);
        return redirect()->route('get_dashboard');
        // 1
    }
    public function event(Request $request, $id)
    {
        $data = DB::table('videos')->where('url', $id)->get();
        if(count($data) > 0){
            $up = DB::table('videos')->where('url',$id)->update([
                'view' => $data[0]->view + 1,
            ]);
            $king = DB::table('videos')->where('url', $id)->get();
            DB::table('download')->insert([
                'ip' => $request->ip(),
                'download' => $data[0]->download,
                'view' => $king[0]->view,
                'url' => $id,
            ]);
            return view('event',['data' => $data,'count' => $data[0]->download,'view' => $king[0]->view]);
        }
        else{
            abort(404);
        }
    }
    public function download(Request $request)
    {
        $data = DB::table('videos')->where('file',$request->key)->get();
        if($data){
            $up = DB::table('videos')->where('file',$request->key)->update([
                'download' => $data[0]->download + 1,
            ]);
            if($up){
                // $data = DB::table('videos')->where('file',$request->key)->get();
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.public_path("uploads\\").$request->key);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize(public_path("uploads\\").$request->key));
                ob_clean();
                flush();
                readfile(public_path("uploads\\").$request->key);
                exit;
            }
        }
    }
    public function download_count(Request $request)
    {
        # code...
        $data = DB::table('videos')->where('file',$request->key)->get();
    }
}
