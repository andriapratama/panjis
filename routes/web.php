<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\PengembanganController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\AbsenController;
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

//Bendahara
Route::get('/bendahara', [BendaharaController::class, 'index'])->name('bendahara');

//Sekretaris
Route::get('/sekretaris', [SekretarisController::class, 'index'])->name('sekretaris');

//Pengembangan
Route::get('/pengembangan', [PengembanganController::class, 'index'])->name('pengembangan');

//Publikasi
Route::get('/publikasi', [PublikasiController::class, 'index'])->name('publikasi');


	//Pengurus
	Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus');
	Route::get('/pengurus/detail/{id_pengurus}', [PengurusController::class, 'detail']);
	Route::get('/pengurus/add', [PengurusController::class, 'add']);
	Route::post('/pengurus/insert', [PengurusController::class, 'insert']);
	Route::get('/pengurus/edit/{id_pengurus}', [PengurusController::class, 'edit']);
	Route::post('/pengurus/update/{id_pengurus}', [PengurusController::class, 'update']);
	Route::get('/pengurus/delete/{id_pengurus}', [PengurusController::class, 'delete']);

	//Anggota
	Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');
	Route::get('/anggota/new', [AnggotaController::class, 'new'])->name('anggota.new');
	Route::get('/anggota/detail/{id}', [AnggotaController::class, 'detail'])->name('anggota.detail');
	Route::get('/member', [AnggotaController::class, 'getData']);
	Route::get('/member/{id}', [AnggotaController::class, 'getOneData']);

	//Absen
	Route::get('/absen', [AbsenController::class, 'index'])->name('absen');
	Route::get('/absen/new', [AbsenController::class, 'new'])->name('absen.new');
	Route::get('/absen/detail/{id}', [AbsenController::class, 'detail'])->name('absen.detail');
	
	Route::get('/absen/first-data', [AbsenController::class, 'getFirstData']);
	Route::get('/absen/data', [AbsenController::class, 'getData']);
	Route::get('/absen/{id}', [AbsenController::class, 'getOneData']);

	//Bendahara
	Route::get('/bendahara', [BendaharaController::class, 'index'])->name('bendahara');
	Route::get('/bendahara/new/{status}', [BendaharaController::class, 'new'])->name('bendahara.new');
	Route::get('/bendahara/detail/{id}', [BendaharaController::class, 'detail'])->name('bendahara.detail');
	Route::get('/transaction', [BendaharaController::class, 'getData']);
	Route::get('/transaction/{id}', [BendaharaController::class, 'getOneData']);



	//Sekretaris
	Route::get('/sekretaris', [SekretarisController::class, 'index'])->name('sekretaris');

	//Pengembangan
	Route::get('/pengembangan', [PengembanganController::class, 'index'])->name('pengembangan');

	//Publikasi
	Route::get('/publikasi', [PublikasiController::class, 'index'])->name('publikasi');
	Route::get('/publikasi/new', [PublikasiController::class, 'new'])->name('publikasi.new');
	Route::get('/publikasi/detail/{id}', [PublikasiController::class, 'detail'])->name('publikasi.detail');
	Route::get('/gallery', [PublikasiController::class, 'getData']);
	Route::get('/gallery/{id}', [PublikasiController::class, 'getOneData']);


	Route::get('/sekretaris', [SekretarisController::class, 'index'])->name('sekretaris');

	Route::get('/pengembangan', [PengembanganController::class, 'index'])->name('pengembangan');
