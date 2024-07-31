<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function formRegistrasi() {

        return view('pages.auth.daftar_user');

    }

    public function registrasi(Request $request) {

        // dd($request->all());

        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        auth()->login($user);

        return redirect()->route('Dashboard');

    }

    protected function validator(array $data) {

        return validator::make($data, [
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:5']
        ]);
    }

    protected function create(array $data) {

        return User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'siswa',
        ]);
    }




}
