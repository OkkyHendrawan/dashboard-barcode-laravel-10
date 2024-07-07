<?php

use App\Http\Controllers\OkkyHendrawan1462200279HomeController;
use App\Http\Controllers\OkkyHendrawan1462200279TiketController;
use App\Http\Controllers\OkkyHendrawan1462200279TransaksiController;
use Illuminate\Support\Facades\Route;

//CETAK EXCEL DAN PDF Untuk Home dan Tiket
Route::get('/home/export/{type}', [OkkyHendrawan1462200279HomeController::class, 'export'])->name('page.home.export');
Route::get('/tiket/export/{type}', [OkkyHendrawan1462200279TiketController::class, 'export'])->name('page.tiket.export');

//CRUD HOME
Route::get('/', [OkkyHendrawan1462200279HomeController::class, 'index'])->name('page.home.list');
Route::get('page/home/form_create', [OkkyHendrawan1462200279HomeController::class, 'form_create'])->name('page.home.form_create');
Route::post('page/home/proses_create', [OkkyHendrawan1462200279HomeController::class, 'proses_create'])->name('page.home.proses_create');
Route::get('page/home/{id}/edit', [OkkyHendrawan1462200279HomeController::class, 'edit'])->name('page.home.edit');
Route::put('page/home/{id}/update', [OkkyHendrawan1462200279HomeController::class, 'update'])->name('page.home.update');
Route::post('page/home/soft-delete/{id}', [OkkyHendrawan1462200279HomeController::class, 'softDeleteHome'])->name('page.home.softDeleteHome');
Route::get('/home/search', [OkkyHendrawan1462200279HomeController::class, 'search'])->name('page.home.search');


//CRUD TIKET
Route::get('page/tiket', [OkkyHendrawan1462200279TiketController::class, 'index'])->name('page.tiket.list');
Route::get('page/tiket/form_create', [OkkyHendrawan1462200279TiketController::class, 'form_create'])->name('page.tiket.form_create');
Route::post('page/tiket/proses_create', [OkkyHendrawan1462200279TiketController::class, 'proses_create'])->name('page.tiket.proses_create');
Route::get('page/tiket/{id}/edit', [OkkyHendrawan1462200279TiketController::class, 'edit'])->name('page.tiket.edit');
Route::put('page/tiket/{id}/update', [OkkyHendrawan1462200279TiketController::class, 'update'])->name('page.tiket.update');
Route::post('page/tiket/soft-delete/{id}', [OkkyHendrawan1462200279TiketController::class, 'softDeleteTiket'])->name('page.tiket.softDeleteTiket');
Route::get('/tiket/search', [OkkyHendrawan1462200279TiketController::class, 'search'])->name('page.tiket.search');

//CRUD TRANSAKSI
Route::get('page/transaksi', [OkkyHendrawan1462200279TransaksiController::class, 'index'])->name('page.transaksi.list');
Route::get('page/transaksi/form_create', [OkkyHendrawan1462200279TransaksiController::class, 'form_create'])->name('page.transaksi.form_create');
Route::post('page/transaksi/proses_create', [OkkyHendrawan1462200279TransaksiController::class, 'proses_create'])->name('page.transaksi.proses_create');
Route::get('page/transaksi/{id}/edit', [OkkyHendrawan1462200279TransaksiController::class, 'edit'])->name('page.transaksi.edit');
Route::put('page/transaksi/{id}/update', [OkkyHendrawan1462200279TransaksiController::class, 'update'])->name('page.transaksi.update');
Route::post('page/transaksi/soft-delete/{id}', [OkkyHendrawan1462200279TransaksiController::class, 'softDeleteTransaksi'])->name('page.transaksi.softDeleteTransaksi');

