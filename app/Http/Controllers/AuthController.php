<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function registration(Request $request)
    {
        $validator = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth()->login($data);

        return redirect('/');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except('_token');
        
        if(Auth::attempt($credentials)){
            return redirect('/');
        }

        return redirect()->to('/login');
    }
}
