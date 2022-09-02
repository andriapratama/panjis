<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\LpjController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

	//Admin
	Route::get('/admin', [AdminController::class, 'index'])->name('admin');
	Route::get('/user', [AdminController::class, 'getData']);

	//Anggota
	Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');
	Route::get('/anggota/new', [AnggotaController::class, 'new'])->name('anggota.new');
	Route::get('/anggota/detail/{id}', [AnggotaController::class, 'detail'])->name('anggota.detail');
	Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
	Route::get('/member', [AnggotaController::class, 'getData']);
	Route::get('/member/{id}', [AnggotaController::class, 'getOneData']);

	//Absen
	Route::get('/absen', [AbsenController::class, 'index'])->name('absen');
	Route::get('/absen/new', [AbsenController::class, 'new'])->name('absen.new');
	Route::get('/absen/detail/{id}', [AbsenController::class, 'detail'])->name('absen.detail');
	
	Route::get('/absen/first-data', [AbsenController::class, 'getFirstData']);
	Route::get('/absen/data', [AbsenController::class, 'getData']);
	Route::get('/absen/title/{id}', [AbsenController::class, 'getTitleData']);
	Route::get('/absen/{id}', [AbsenController::class, 'getOneData']);

	//Bendahara
	Route::get('/bendahara', [BendaharaController::class, 'index'])->name('bendahara');
	Route::get('/bendahara/new/{status}', [BendaharaController::class, 'new'])->name('bendahara.new');
	Route::get('/bendahara/detail/{id}', [BendaharaController::class, 'detail'])->name('bendahara.detail');
	Route::get('/bendahara/edit/{id}', [BendaharaController::class, 'edit'])->name('bendahara.edit');
	Route::get('/transaction', [BendaharaController::class, 'getData']);
	Route::get('/transaction/money', [BendaharaController::class, 'getTotalMoney']);
	Route::get('/transaction/{id}', [BendaharaController::class, 'getOneData']);

	//Barang
	Route::get('/barang', [BarangController::class, 'index'])->name('barang');
	Route::get('/barang/new', [BarangController::class, 'new'])->name('barang.new');
	Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
	Route::get('/product', [BarangController::class, 'getData']);
	Route::get('/product/{id}', [BarangController::class, 'getOneData']);

	//Peminjaman
	Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman');
	Route::get('/peminjaman/new', [PeminjamanController::class, 'new'])->name('peminjaman.new');
	Route::get('/peminjaman/detail/{id}', [PeminjamanController::class, 'detail'])->name('peminjaman.detail');
	Route::get('/peminjaman/print/{id}', [PeminjamanController::class, 'print'])->name('peminjaman.print');
	Route::get('/loan', [PeminjamanController::class, 'getData']);
	Route::get('/loan/{id}', [PeminjamanController::class, 'getOneData']);

	//Pengumuman
	Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
	Route::get('/pengumuman/new', [PengumumanController::class, 'new'])->name('pengumuman.new');
	Route::get('/pengumuman/edit/{id}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
	Route::get('/announ', [PengumumanController::class, 'getData']);
	Route::get('/announ/date', [PengumumanController::class, 'getDataByDate']);
	Route::get('/announ/{id}', [PengumumanController::class, 'getOneData']);

	//Notulen
	Route::get('/notulen', [NotulenController::class, 'index'])->name('notulen');
	Route::get('/notulen/new', [NotulenController::class, 'new'])->name('notulen.new');
	Route::get('/notulen/detail/{id}', [NotulenController::class, 'detail'])->name('notulen.detail');
	Route::get('/notulen/edit/{id}', [NotulenController::class, 'edit'])->name('notulen.edit');
	Route::get('/note', [NotulenController::class, 'getData']);
	Route::get('/note/{id}', [NotulenController::class, 'getOneData']);

	//LPJ
	Route::get('/lpj', [LpjController::class, 'index'])->name('lpj');
	Route::get('/lpj/new', [LpjController::class, 'new'])->name('lpj.new');
	Route::get('/lpj/edit/{id}', [LpjController::class, 'edit'])->name('lpj.edit');
	Route::get('/report', [LpjController::class, 'getData']);
	Route::get('/report/{id}', [LpjController::class, 'getOneData']);

	//Publikasi
	Route::get('/publikasi', [PublikasiController::class, 'index'])->name('publikasi');
	Route::get('/publikasi/new', [PublikasiController::class, 'new'])->name('publikasi.new');
	Route::get('/publikasi/detail/{id}', [PublikasiController::class, 'detail'])->name('publikasi.detail');
	Route::get('/publikasi/edit/{id}', [PublikasiController::class, 'edit'])->name('publikasi.edit');
	Route::get('/publikasi/image/{id}', [PublikasiController::class, 'image'])->name('publikasi.image');
	Route::get('/gallery', [PublikasiController::class, 'getData']);
	Route::get('/gallery/{id}', [PublikasiController::class, 'getOneData']);
	Route::get('/gallery/edit/{id}', [PublikasiController::class, 'getEditData']);

