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
	Route::get('/anggota/detail/{id_anggota}', [AnggotaController::class, 'detail']);
	Route::get('/anggota/add', [AnggotaController::class, 'add']);
	Route::post('/anggota/insert', [AnggotaController::class, 'insert']);
	Route::get('/anggota/edit/{id_anggota}', [AnggotaController::class, 'edit']);
	Route::post('/anggota/update/{id_anggota}', [AnggotaController::class, 'update']);
	Route::get('/anggota/delete/{id_anggota}', [AnggotaController::class, 'delete']);

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


	Route::get('/sekretaris', [SekretarisController::class, 'index'])->name('sekretaris');

	Route::get('/bendahara', [BendaharaController::class, 'index'])->name('bendahara');

	Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');
	Route::get('/anggota/detail/{id_anggota}', [AnggotaController::class, 'detail']);
	Route::get('/anggota/add', [AnggotaController::class, 'add']);
	Route::post('/anggota/insert', [AnggotaController::class, 'insert']);
	Route::get('/anggota/edit/{id_anggota}', [AnggotaController::class, 'edit']);
	Route::post('/anggota/update/{id_anggota}', [AnggotaController::class, 'update']);
	Route::get('/anggota/delete/{id_anggota}', [AnggotaController::class, 'delete']);
	Route::get('/pengembangan', [PengembanganController::class, 'index'])->name('pengembangan');


	Route::get('/publikasi', [PublikasiController::class, 'index'])->name('publikasi');