<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function ListUser() {

        $title = 'List User';
        $users = User::all();

        return view('pages.user.list_user', compact('title', 'users'));
    }
}
