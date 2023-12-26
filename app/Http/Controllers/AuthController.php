<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }

        return redirect('login')->withError('Login details are not valid');
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);

        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }

        return redirect('register')->withError('Error');
    }

    public function home()
    {
        $existingUsers = User::all();
        return view('home', compact('existingUsers'));
    }

    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }
}
