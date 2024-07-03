<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Todo\TodoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('pages.board');
});

// Route::get('/', [TodoController::class, 'index'])->name('todo');
// Route::post('/', [TodoController::class, 'store'])->name('todo.post');
// Route::put('/{id}', [TodoController::class, 'update'])->name('todo.update');
// Route::delete('/{id}', [TodoController::class, 'destroy'])->name('todo.delete');


Route::get('/daftar', [RegisterController::class, 'halamanRegistrasi'])->name('halamanRegistrasi');
Route::post('/daftar', [RegisterController::class, 'registrasi'])->name('daftar');

Route::get('/login', [LoginController::class, 'formLogin'])->name('halamanLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/login', function () {
    return view('pages/login');
});

Route::get('/daftar', function () {
    return view('pages/daftar');
});

Route::get('/list-buku', [DashboardController::class, 'ListBuku'])->name('ListBuku');
Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('Dashboard');