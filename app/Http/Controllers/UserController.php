<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listUser()
    {

        $data = [
            'title' => 'List Data Master User',
            'users' => User::all(),
            'subtitle' => 'Data Seluruh User',
            'slug' => 'Ini untuk slug',
        ];

        return view('pages.user.list-user', $data);
    }

    public function inputUser()
    {

        $data = [
            'slug' => 'Ini slug',
            'title' => 'Form Data User Baru',
            'subtitle' => 'Data User Baru',
        ];

        return view('.pages.user.input_user', $data);

    }

    public function simpanUser(Request $request)
    {
        $namaUser = $request->input('nama');
        if (strlen(strval($namaUser)) == 0) {
            return 'Nama tidak valid';
        }

        $emailUser = $request->input('email');
        if (strlen(strval($emailUser)) == 0) {
            return 'Email tidak valid';
        }

        $passwordUser = $request->input('password');
        if (strlen(strval($passwordUser)) == 0) {
            return 'Password tidak valid';
        } elseif (strlen(strval($passwordUser)) < 5) {
            return 'Password harus minimal 5 karakter';
        }

        DB::beginTransaction();
        try {
            $data = [
                'nama' => $namaUser,
                'email' => $emailUser,
                'password' => Hash::make($passwordUser),
            ];

            User::create($data);

            DB::commit();

            return redirect()->route('ListUser');

        }catch (\Exception $exception){

            DB::rollBack();

            return 'Error: ' . $exception->getMessage();
        }
    }

    public function editUser($id)
    {
        $data = [
            'user' => User::findOrFail($id),
            'slug' => 'Ini slug',
            'title' => 'Form Data User Baru',
            'subtitle' => 'Data User Baru',
        ];

        return view('pages.user.edit-user', $data);
    }

    public function updateUser(Request $request, $id)
    {
        $namaUser = $request->input('nama');
        if (strlen(strval($namaUser)) == 0) {
            return 'Nama tidak valid';
        }

        $emailUser = $request->input('email');
        if (strlen(strval($emailUser)) == 0) {
            return 'Email tidak valid';
        }

        $passwordUser = $request->input('password');
        if (strlen(strval($passwordUser)) == 0) {
            return 'Password tidak valid';
        } elseif (strlen(strval($passwordUser)) < 5) {
            return 'Password harus minimal 5 karakter';
        }

        DB::beginTransaction();
        try {

            $updateData = [
                'nama' => $namaUser,
                'email' => $emailUser,
                'password' => Hash::make($passwordUser),
            ];

            User::where('id', $id)->update($updateData);

        DB::commit();

            return redirect()->route('ListUser');

        }catch (\Exception $exception){

            return 'Error: ' . $exception->getMessage();
        }

    }

    public function destroyUser($id)
    {
        DB::beginTransaction();
        try {

            $user = User::findOrFail($id);
            $user->delete();

            DB::commit();

            return redirect()->route('ListUser');

        }catch (\Exception $exception){
            DB::rollBack();
            return 'Error: ' . $exception->getMessage();
        }
    }

}


