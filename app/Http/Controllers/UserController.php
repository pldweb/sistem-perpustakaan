<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function ListUser()
    {

        $title = 'List Data User';
        $users = User::all();
        $subtitle = 'Data Seluruh User';
        $slug = 'Ini untuk slug';

        return view('pages.user.list_user', compact('title', 'users', 'subtitle', 'slug'));
    }

    public function InputUser()
    {

        $slug = 'Ini slug';
        $title = 'Form Data User Baru';
        $subtitle = 'Data User Baru';

        return view('.pages.user.input_user', compact('title', 'slug', 'subtitle'));

    }

    public function SimpanUser(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5']
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
        ];

        User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'siswa',
        ]);

        return redirect()->route('ListUser');

    }


    public function EditUser($id)
    {

        $user = User::findOrFail($id);
        $slug = 'Ini slug';
        $title = 'Form Data User Baru';
        $subtitle = 'Data User Baru';

        return view('pages.user.edit_user', compact('user', 'title', 'slug', 'subtitle', 'id'));

    }

    public function UpdateUser(Request $request, $id)
    {

        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:5']
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
        ];

        $updateData = [
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];

        User::where('id', $id)->update($updateData);

        return redirect()->route('ListUser');

    }


    public function DestroyUser($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('ListUser');
    }

}


