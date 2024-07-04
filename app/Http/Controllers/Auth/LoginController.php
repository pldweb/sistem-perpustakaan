<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller

{
    public function formLogin() {
        return view('/pages/auth/login_user');
    }

    public function login(Request $request) {


        // Validasi Input
        $loginCredential = Validator::make($request->all(), [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi'
        ]);

        // Jika validasi gagal
        if($loginCredential->fails()) {
            return redirect()->back()
            ->withErrors($loginCredential)
            ->withInput($request->only('email'));
        }

        // Login user
        $loginCredential = $request->only('email', 'password');
        if(Auth::attempt($loginCredential)){
            // Autentikasi Berhasil
            return redirect()->route('Dashboard');

        }

        // Jika login gagal
        return redirect()->back()
            ->withErrors(['email' => 'Email password salah', 'password' => "Password salah"])
            ->withInput($request->only('email'));

    }


    public function logout(Request $request) {
        
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('halamanLogin');
    }

}
