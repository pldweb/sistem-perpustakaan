<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function ListUser() {

        $title = 'List Data User';
        $users = User::all();
        $subtitle = 'Data Seluruh User';
        $slug = 'Ini untuk slug';

        return view('pages.user.list_user', compact('title', 'users', 'subtitle', 'slug'));
    }
}
