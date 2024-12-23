<?php

use App\Helpers\TelegramHelper;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\JadwalSholatController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Tools\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Scrapping\ScrapeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Http\Middleware\RedirectIfAuthenticated;
use Telegram\Bot\Laravel\Facades\Telegram;


Route::get('/list-file', [StorageController::class, 'listFile'])->name('list-file');
Route::post('/upload-file', [StorageController::class, 'uploadFile'])->name('uploadFile');
Route::get('/download-file/{id}', [StorageController::class, 'downloadFile'])->name('downloadFile');
Route::post('/delete-file', [StorageController::class, 'deleteFile'])->name('deleteFile');

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Exceptions\TelegramSDKException;

Route::get('/mail/send', [MailController::class, 'sendEmail'])->name('sendEmail');

Route::get('/send-notification', [telegramController::class, 'sendNotification'])->name('sendTelegram');

Route::middleware([RedirectIfAuthenticated::class])->group(function () {

    // Autentikasi Daftar
    Route::get('/daftar', [RegisterController::class, 'formRegistrasi'])->name('formRegistrasi');
    Route::post('/daftar', [RegisterController::class, 'registrasi'])->name('registrasi');

    // Autentikasi Login
    Route::get('/login', [LoginController::class, 'formLogin'])->name('formLogin');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([EnsureUserIsAuthenticated::class])->group(function () {

    // Index website
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/mail/send', [MailController::class, 'sendMail'])->name('sendMail');
    Route::get('/peminjaman-perbulan', [DashboardController::class, 'getPeminjamanPerbulan'])->name('peminjamanPerbulan');


    // Data Master Buku
    Route::get('/list-data-buku', [BukuController::class, 'listBuku'])->name('listBuku');
    Route::get('/list-data-buku/export', [BukuController::class, 'tableBookExport'])->name('tableBookExport');

    Route::get('/table-list-buku', [BukuController::class, 'tableListBuku']);
    Route::get('/input-buku', [BukuController::class, 'inputBuku'])->name('inputBuku');
    Route::post('/simpan-buku', [BukuController::class, 'simpanBuku'])->name('simpanBuku');
    Route::get('/edit-buku/{id}/edit', [BukuController::class, 'editBuku'])->name('editBuku');
    Route::put('/simpan-buku/{id}', [BukuController::class, 'updateBuku'])->name('updateBuku');
    Route::delete('/list-buku/{id}', [BukuController::class, 'destroyBuku'])->name('destroyBuku');

    Route::get('/laporan-history-buku', [BukuController::class, 'historyBuku'])->name('historyBuku');
    Route::get('/table-list-history-buku', [BukuController::class, 'tableListHistoryBuku']);
    Route::get('/show-table-laporan-buku/{id}', [BukuController::class, 'showTableLaporanBuku']);


    // Data Master User
    Route::get('/list-data-user', [UserController::class, 'listUser'])->name('listUser');
    Route::get('/table-list-user', [UserController::class, 'tableListUser'])->name('tableListUser');
    Route::get('/input-user', [UserController::class, 'inputUser'])->name('inputUser');
    Route::post('/simpan-user', [UserController::class, 'simpanUser'])->name('simpanUser');
    Route::get('/list-user/{id}/edit', [UserController::class, 'editUser'])->name('editUser');
    Route::put('/list-user/{id}', [UserController::class, 'updateUser'])->name('updateUser');
    Route::delete('/list-user/{id}', [UserController::class, 'destroyUser'])->name('destroyUser');


    Route::get('/laporan-history-user', [UserController::class, 'historyUser'])->name('historyUser');
    Route::get('/table-list-history-user', [UserController::class, 'tableListHistoryUser'])->name('tableListHistoryUser');
    Route::get('/show-table-laporan-user/{id}', [UserController::class, 'showTableLaporanUser']);


    // Data Buku yang dipinjam
    Route::get('/search/result', [PinjamController::class, 'searchResult'])->name('searchPage');
    Route::get('/list-pinjam', [PinjamController::class, 'listPinjam'])->name('listPinjam');
    Route::get('/pinjam-buku', [PinjamController::class, 'pinjamBuku'])->name('pinjamBuku');
    Route::post('/simpan-pinjam-buku', [PinjamController::class, 'store'])->name('simpanPinjamBuku');

    Route::get('/peminjaman/{id}/preview', [PdfController::class, 'showPreview']);
    Route::get('peminjaman/{id}/generate-pdf', [PdfController::class, 'generatePdf']);


    Route::get('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'detailPinjam'])->name('detailPinjam');


    Route::get('list-pinjam/{tanggal_pinjam}/{id}/edit', [PinjamController::class, 'editPinjam'])->name('editPinjam');
    Route::put('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'updatePinjam'])->name('updatePinjam');
    Route::delete('/list-pinjam/{tanggal_pinjam}/{id}', [PinjamController::class, 'destroy'])->name('destroyPinjam');




    // Pengembalian Buku yang telah dipinjam
    Route::get('/detail-pengembalian/{id}', [PengembalianController::class, 'detailPengembalian'])->name('showPengembalian');
    Route::post('/simpan-pengembalian/{id}', [PengembalianController::class, 'storePengembalian'])->name('storePengembalian');
    Route::get('/list-pengembalian', [PengembalianController::class, 'listPengembalian'])->name('listPengembalian');

    Route::get('/table-list-pinjam', [PinjamController::class, 'tableListPinjam'])->name('tableListPinjam');
    Route::get('/table-list-pengembalian', [PengembalianController::class, 'tableListPengembalian'])->name('tableListPengembalian');

    Route::get('jadwal-shalat', [JadwalSholatController::class, 'getJadwalShalat'])->name('jadwalShalat');
    Route::get('lokasi-shalat', [JadwalSholatController::class, 'getLocation'])->name('location');
    Route::get('jadwal-shalat-ajax', [JadwalSholatController::class, 'getJadwalShalatAjax'])->name('jadwalShalatAjax');



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
