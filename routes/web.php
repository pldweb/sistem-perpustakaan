<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Autentikasi Daftar
Route::get('/daftar', [RegisterController::class, 'formRegistrasi'])->name('halamanRegistrasi');
Route::post('/daftar', [RegisterController::class, 'registrasi'])->name('daftar');

// Autentikasi Login
Route::get('/login', [LoginController::class, 'formLogin'])->name('halamanLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Data Master Buku
Route::get('/list-buku', [BukuController::class, 'ListBuku'])->middleware('auth.user')->name('ListBuku');
Route::delete('/list-buku/{id}', [BukuController::class, 'destroyBuku'])->middleware('auth.user')->name('destroyBuku');
Route::get('/input-buku', [BukuController::class, 'InputBuku'])->middleware('auth.user')->name('InputBuku');
Route::post('/simpan-buku', [BukuController::class, 'SimpanBuku'])->middleware('auth.user')->name('SimpanBuku');
Route::get('/edit-buku/{id}/edit', [BukuController::class, 'EditBuku'])->middleware('auth.user')->name('EditBuku');
Route::put('/edit-buku/{id}', [BukuController::class, 'UpdateBuku'])->middleware('auth.user')->name('UpdateBuku');


// Data Buku yang dipinjam
Route::get('/list-pinjam', [PinjamController::class, 'ListPinjam'])->middleware('auth.user')->name('ListPinjam');
Route::get('/pinjam-buku', [PinjamController::class, 'PinjamBuku'])->middleware(('auth.user'))->name('PinjamBuku');
Route::get('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'DetailPinjam'])->middleware(('auth.user'))->name('DetailPinjam');
Route::delete('/list-pinjam/{id}', [PinjamController::class, 'destroy'])->middleware(('auth.user'))->name('destroyPinjam');
Route::post('/simpan-pinjam-buku', [PinjamController::class, 'store'])->middleware(('auth.user'))->name('SimpanPinjamBuku');


// Data Master User
Route::get('/list-user', [UserController::class, 'ListUser'])->middleware(('auth.user'))->name('ListUser');
Route::get('/input-user', [UserController::class, 'InputUser'])->middleware(('auth.user'))->name('InputUser');
Route::post('/simpan-user', [UserController::class, 'SimpanUser'])->middleware(('auth.user'))->name('SimpanUser');


// Index website
Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->middleware('auth.user')->name('Dashboard');
Route::get('/', [DashboardController::class, 'Dashboard'])->middleware('auth.user')->name('Dashboard');





// Route::get('/', [TodoController::class, 'index'])->name('todo');
// Route::post('/', [TodoController::class, 'store'])->name('todo.post');
// Route::put('/{id}', [TodoController::class, 'update'])->name('todo.update');
// Route::delete('/{id}', [TodoController::class, 'destroy'])->name('todo.delete');