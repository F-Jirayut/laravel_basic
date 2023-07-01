<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        // case 1
        // $user = User::where('username', $request->username)
        // ->where('password', $request->password)->first();

        $user = User::where('username', $request->username)->first();

        if($user == null){
            return back()->with('success', 'Login ไม่ผ่าน 1');
        }
        else{
            $check = Hash::check($request->password, $user->password);
            if($check == true){
                session(['user' => $user]);
                // Session::forget('user');
                return redirect()->route('department.index')->with('success', 'Login ผ่าน');
            }
            else{
                return back()->with('success', 'Login ไม่ผ่าน 2');
            }
        }
    }
}
