<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function listUser()
    {

        $data = [
            'title' => 'List Data Master User',
            'users' => User::paginate(10),
            'subtitle' => 'Data Seluruh User',
            'slug' => 'Ini untuk slug',
        ];

        return view('pages.user.list-user', $data);
    }

    public function tableListUser()
    {
        $data = [
            'title' => 'List Data Master User',
            'users' => User::paginate(10),
            'subtitle' => 'Data Seluruh User',
            'slug' => 'Ini untuk slug',
        ];

        return view('pages.user.table.table-list-user', $data);
    }

    public function inputUser()
    {

        $data = [
            'slug' => 'Ini slug',
            'title' => 'Form Data User Baru',
            'subtitle' => 'Data User Baru',
        ];

        return view('.pages.user.input-user', $data);

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

        if ($request->hasFile('photo')) {

            $photoUser = $request->file('photo');

            $originalNamePhoto = $photoUser->getClientOriginalName();

            $hashNamePhoto = md5($originalNamePhoto . time());

            $fileName = $hashNamePhoto . '.' . $originalNamePhoto;

            $filePath = $photoUser->storeAs('uploads/user/images', $fileName, [
                'disk' => 's3',
                'visibility' => 'public'
            ]);

            Storage::disk('s3')->url($filePath);

            $data['photo'] = $filePath;

        } else {

            $photoPath = null;
        }


        DB::beginTransaction();
        try {

            $data = [
                'nama' => $namaUser,
                'email' => $emailUser,
                'password' => Hash::make($passwordUser),
                'photo' => $photoPath,
            ];

            User::create($data);

            DB::commit();

            return redirect()->route('listUser');

        } catch (\Exception $exception) {

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

            return redirect()->route('listUser');

        } catch (\Exception $exception) {

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

            return redirect()->route('listUser');

        } catch (\Exception $exception) {
            DB::rollBack();
            return 'Error: ' . $exception->getMessage();
        }
    }

    public function historyUser()
    {
        $data = [
            'title' => 'List Data Master User',
            'users' => User::paginate(10),
            'subtitle' => 'Data Seluruh User',
            'slug' => 'Ini untuk slug',
        ];

        return view('pages.user.list-history-user', $data);
    }

    public function showTableLaporanUser($id, Request $request)
    {

        $data = DB::table('peminjaman_buku')
            ->join('peminjaman', 'peminjaman_buku.peminjaman_id', '=', 'peminjaman.id')
            ->join('books', 'peminjaman_buku.buku_id', '=', 'books.id')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->where('peminjaman.user_id', '=', $id)
            ->select('peminjaman_buku.jumlah', 'peminjaman.tanggal_pinjam', 'books.judul_buku')
            ->orderBy('peminjaman.tanggal_pinjam', 'desc')
            ->get();

        $params = [
            'data' => $data,
            'title' => 'List History User',
            'slug' => 'ini slug',
            'subtitle' => 'Ini sub title'
        ];

        if ($request->ajax()) {
            return view('pages.user.table.table-laporan', $params);
        }

        return 'error';
    }

}


