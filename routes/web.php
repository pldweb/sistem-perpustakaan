<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamController;


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

Route::get('/daftar', [RegisterController::class, 'formRegistrasi'])->name('halamanRegistrasi');
Route::post('/daftar', [RegisterController::class, 'registrasi'])->name('daftar');

Route::get('/login', [LoginController::class, 'formLogin'])->name('halamanLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/list-buku', [BukuController::class, 'ListBuku'])->middleware('auth.user')->name('ListBuku');
Route::get('/input-buku', [BukuController::class, 'InputBuku'])->middleware('auth.user')->name('InputBuku');
Route::post('/simpan-buku', [BukuController::class, 'SimpanBuku'])->middleware('auth.user')->name('SimpanBuku');

Route::get('/list-pinjam', [PinjamController::class, 'ListPinjam'])->middleware('auth.user')->name('ListPinjam');
Route::get('/pinjam-buku', [PinjamController::class, 'PinjamBuku'])->middleware(('auth.user'))->name('PinjamBuku');
Route::post('/simpan-pinjam-buku', [PinjamController::class, 'store'])->middleware(('auth.user'))->name('SimpanPinjamBuku');


Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->middleware('auth.user')->name('Dashboard');
Route::get('/', [DashboardController::class, 'Dashboard'])->middleware('auth.user')->name('Dashboard');





// Route::get('/', [TodoController::class, 'index'])->name('todo');
// Route::post('/', [TodoController::class, 'store'])->name('todo.post');
// Route::put('/{id}', [TodoController::class, 'update'])->name('todo.update');
// Route::delete('/{id}', [TodoController::class, 'destroy'])->name('todo.delete');