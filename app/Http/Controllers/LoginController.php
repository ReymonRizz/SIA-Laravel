<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function registeruser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        //     'remember_token' => Str::random(60),
        // ]);
        return redirect('/');
    }

    public function loginuser(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            $user = User::where([['email', $request->input('email')]])->first();
            session()->put('user', $user);
            return redirect('/akun');
        }

        Session::flash('error', 'Email atau Password Salah');
        return redirect('/');
    }

    public function actionlogout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}