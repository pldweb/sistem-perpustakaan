<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Scrapping\ScrapeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Http\Middleware\RedirectIfAuthenticated;


Route::middleware([RedirectIfAuthenticated::class])->group(function () {

    // Autentikasi Daftar
    Route::get('/daftar', [RegisterController::class, 'formRegistrasi'])->name('halamanRegistrasi');
    Route::post('/daftar', [RegisterController::class, 'registrasi'])->name('daftar');

    // Autentikasi Login
    Route::get('/login', [LoginController::class, 'formLogin'])->name('halamanLogin');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([EnsureUserIsAuthenticated::class])->group(function () {

    // Data Master Buku
    Route::get('/list-buku', [BukuController::class, 'ListBuku'])->name('ListBuku');
    Route::delete('/list-buku/{id}', [BukuController::class, 'destroyBuku'])->name('destroyBuku');
    Route::get('/input-buku', [BukuController::class, 'InputBuku'])->name('InputBuku');
    Route::post('/simpan-buku', [BukuController::class, 'SimpanBuku'])->name('SimpanBuku');
    Route::get('/edit-buku/{id}/edit', [BukuController::class, 'EditBuku'])->name('EditBuku');
    Route::put('/edit-buku/{id}', [BukuController::class, 'UpdateBuku'])->name('UpdateBuku');

    Route::get('/history-buku/{id}', [BukuController::class, 'history'])->name('history');


    // Data Buku yang dipinjam
    Route::get('/search/result', [PinjamController::class, 'searchResult'])->name('searchPage');
    Route::get('/list-pinjam', [PinjamController::class, 'ListPinjam'])->name('ListPinjam');
    Route::get('/pinjam-buku', [PinjamController::class, 'PinjamBuku'])->name('PinjamBuku');
    Route::get('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'DetailPinjam'])->name('DetailPinjam');
    Route::put('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'UpdatePinjam'])->name('UpdatePinjam');
    Route::delete('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'destroy'])->name('destroyPinjam');
    Route::post('/simpan-pinjam-buku', [PinjamController::class, 'store'])->name('SimpanPinjamBuku');

    // Pengembalian Buku yang telah dipinjam
    Route::get('/pengembalian/{id}', [PengembalianController::class, 'index'])->name('showPengembalian');
    Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('storePengembalian');


    // Data Master User
    Route::get('/list-user', [UserController::class, 'ListUser'])->name('ListUser');
    Route::get('/input-user', [UserController::class, 'InputUser'])->name('InputUser');
    Route::get('/list-user/{id}/edit', [UserController::class, 'EditUser'])->name('EditUser');
    Route::put('/list-user/{id}', [UserController::class, 'UpdateUser'])->name('UpdateUser');
    Route::post('/simpan-user', [UserController::class, 'SimpanUser'])->name('SimpanUser');
    Route::delete('/list-user/{id}', [UserController::class, 'DestroyUser'])->name('DestroyUser');


    // Index website
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('Dashboard');
    Route::get('/', [DashboardController::class, 'Dashboard'])->name('Dashboard');


    // Scrapping
    Route::get('/scrape', [ScrapeController::class, 'scrape'])->name('scrape');
    Route::get('/scraping', [ScrapeController::class, 'index'])->name('scraping');
    Route::delete('/delete', [ScrapeController::class, 'delete'])->name('scrape-delete');
    Route::get('/contact/export', [ScrapeController::class, 'export'])->name('export');

});


// Route::get('/', [TodoController::class, 'index'])->name('todo');
// Route::post('/', [TodoController::class, 'store'])->name('todo.post');
// Route::put('/{id}', [TodoController::class, 'update'])->name('todo.update');
// Route::delete('/{id}', [TodoController::class, 'destroy'])->name('todo.delete');