<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller

{
    public function formLogin()
    {
        return view('pages.auth.login-user');
    }

    public function login(Request $request)
    {
        // Login user
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Autentikasi Berhasil
            $redirectURL = url('');
            return "<div class='alert alert-success'>Login berhasil</div>
                <script>
                    setTimeout(function () {
                        location.href = '$redirectURL';
                    }, 1500);
                </script>";
        }

        // Jika login gagal
        return "<div class='alert alert-danger'>Login gagal</div>";
    }


    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('formLogin');
    }

}
