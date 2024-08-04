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
    Route::get('/list-buku', [BukuController::class, 'listBuku'])->name('ListBuku');
    Route::delete('/list-buku/{id}', [BukuController::class, 'destroyBuku'])->name('destroyBuku');
    Route::get('/input-buku', [BukuController::class, 'inputBuku'])->name('InputBuku');
    Route::post('/simpan-buku', [BukuController::class, 'simpanBuku'])->name('SimpanBuku');
    Route::get('/edit-buku/{id}/edit', [BukuController::class, 'editBuku'])->name('EditBuku');
    Route::put('/edit-buku/{id}', [BukuController::class, 'updateBuku'])->name('UpdateBuku');

//    History Buku
    Route::get('/history-buku', [BukuController::class, 'history'])->name('history');
    Route::get('/history-buku/{id}', [BukuController::class, 'historyBuku'])->name('HistoryBuku');


    // Data Buku yang dipinjam
    Route::get('/search/result', [PinjamController::class, 'searchResult'])->name('searchPage');
    Route::get('/list-pinjam', [PinjamController::class, 'listPinjam'])->name('ListPinjam');
    Route::get('/pinjam-buku', [PinjamController::class, 'pinjamBuku'])->name('PinjamBuku');
    Route::get('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'detailPinjam'])->name('DetailPinjam');
    Route::put('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'updatePinjam'])->name('UpdatePinjam');
    Route::delete('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'destroy'])->name('destroyPinjam');
    Route::post('/simpan-pinjam-buku', [PinjamController::class, 'store'])->name('SimpanPinjamBuku');

    // Pengembalian Buku yang telah dipinjam
    Route::get('/detail-pengembalian/{id}', [PengembalianController::class, 'detailPengembalian'])->name('showPengembalian');
    Route::post('/simpan-pengembalian/{id}', [PengembalianController::class, 'storePengembalian'])->name('storePengembalian');
    Route::get('/list-pengembalian', [PengembalianController::class, 'listPengembalian'])->name('ListPengembalian');


    // Data Master User
    Route::get('/list-user', [UserController::class, 'listUser'])->name('ListUser');
    Route::get('/input-user', [UserController::class, 'inputUser'])->name('InputUser');
    Route::get('/list-user/{id}/edit', [UserController::class, 'editUser'])->name('EditUser');
    Route::put('/list-user/{id}', [UserController::class, 'updateUser'])->name('UpdateUser');
    Route::post('/simpan-user', [UserController::class, 'simpanUser'])->name('SimpanUser');
    Route::delete('/list-user/{id}', [UserController::class, 'destroyUser'])->name('DestroyUser');


    // Index website
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('Dashboard');
    Route::get('/', [DashboardController::class, 'dashboard'])->name('Dashboard');


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
