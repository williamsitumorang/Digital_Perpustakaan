<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriBukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataBukuController;


// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/', [AuthenticationController::class, 'login']);
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//register
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');


// Route::get('/data_buku', [DataBukuController::class, 'index'])->name('index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {

    Route::get('/dashboard/admin)', [DashboardController::class, 'indexAdmin'])->name('dashboard_admin');

    Route::get('/data/buku/admin)', [AdminController::class, 'indexAdmin'])->name('data_buku_admin');

    //tambah_buku
    // Route::get('/tambah/buku)', [DataBukuController::class, 'tambahBuku'])->name('tambah_buku');
    // Route::post('/admin/tambah-buku', [DataBukuController::class, 'store'])->name('store_buku');
    Route::delete('/admin/delete-buku/{id}', [AdminController::class, 'destroy'])->name('delete_buku');
        // Menampilkan formulir edit
    Route::get('/admin/edit-buku/{id}', [AdminController::class, 'edit'])->name('edit_buku');

    // Mengupdate data buku
    Route::post('/admin/update-buku/{id}', [AdminController::class, 'update'])->name('update_buku');

    //to pdf
    Route::get('/export-buku-pdf/admin', [AdminController::class, 'exportPDFAll'])->name('export_pdf_admin');

});

Route::group(['prefix' => 'user', 'middleware' => ['auth'], 'as' => 'user.'], function () {

    Route::get('/dashboard/user)', [DashboardController::class, 'indexUser'])->name('dashboard_user');
    
    Route::get('/data/buku/user)', [DataBukuController::class, 'index'])->name('data_buku');

    //tambah buku
    Route::get('/tambah/buku)', [DataBukuController::class, 'tambahBuku'])->name('tambah_buku');
    Route::post('/user/tambah-buku', [DataBukuController::class, 'store'])->name('store_buku');

    Route::delete('/user/delete-buku/{id}', [DataBukuController::class, 'destroy'])->name('delete_buku');

    // Menampilkan formulir edit
    Route::get('/edit/buku/{id})', [DataBukuController::class, 'editBuku'])->name('edit');

    // Mengupdate data buku
    Route::post('/update/user/{id}', [DataBukuController::class, 'updateBuku'])->name('update');

    Route::get('/data/kategori/user)', [KategoriBukuController::class, 'index'])->name('kategori_buku');

    //tambah kategori
    Route::get('/tambah/kategori)', [KategoriBukuController::class, 'tambahKategori'])->name('tambah_kategori');
    Route::post('/user/tambah-kategori', [KategoriBukuController::class, 'store'])->name('store_kategori');
    Route::delete('/user/delete-kategori/{id}', [KategoriBukuController::class, 'destroy'])->name('delete_kategori');
    // Menampilkan formulir edit
    Route::get('/user/edit-buku/{id}', [KategoriBukuController::class, 'edit'])->name('edit_kategori');
    // Mengupdate data buku
    Route::post('/user/update-buku/{id}', [KategoriBukuController::class, 'update'])->name('update_kategori');

    //to pdf
    Route::get('/export-buku-pdf', [DataBukuController::class, 'exportPDF'])->name('export.buku.pdf');
});