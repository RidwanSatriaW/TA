<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;

class CustomAuthController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended('dashboard'); // Ubah '/dashboard' sesuai dengan halaman yang ingin Anda arahkan
        }
        return view('auth.login');
    }

    public function custom_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->only('email', 'password');

        if (Auth::attempt($credential)) {
            return redirect()->intended('dashboard')->withSuccess('Login');
        }

        return redirect('login')->with('error', 'Login Failed');
    }
    public function registration()
    {
        return view('auth.registration');
    }

    public function custom_registration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'Admin'
        ]);

        return redirect('registration')->with('success', 'Registration Success');
    }

    public function dashboard()
    {
        if(Auth::check())
        {
            return view('dashboard');
        }

        return redirect('login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
