<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BendaharaController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\LpjController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();

Route::post('/transaction', [BendaharaController::class, 'store']);
Route::post('/transaction/update/{id}', [BendaharaController::class, 'update']);
Route::post('/transaction/delete/{id}', [BendaharaController::class, 'delete']);

Route::post('/gallery', [PublikasiController::class, 'store']);
Route::post('/gallery/update/{id}', [PublikasiController::class, 'update']);
Route::post('/gallery/image/{id}', [PublikasiController::class, 'storeImage']);
Route::post('/gallery/delete/image/{id}', [PublikasiController::class, 'deleteImage']);

Route::post('/member', [AnggotaController::class, 'store']);
Route::post('/member/update/{id}', [AnggotaController::class, 'update']);

Route::post('/absent', [AbsenController::class, 'store']);
Route::post('/absent/update', [AbsenController::class, 'updateAbsentDetail']);
Route::post('/absent/update/title/{id}', [AbsenController::class, 'updateDataTitle']);

Route::post('/product', [BarangController::class, 'store']);
Route::post('/product/update/{id}', [BarangController::class, 'update']);

Route::post('/loan', [PeminjamanController::class, 'store']);
Route::post('/loan/status/{id}', [PeminjamanController::class, 'updateStatus']);

Route::post('/announ', [PengumumanController::class, 'store']);
Route::post('/announ/update/{id}', [PengumumanController::class, 'update']);
Route::post('/announ/delete/{id}', [PengumumanController::class, 'delete']);

Route::post('/note', [NotulenController::class, 'store']);
Route::post('/note/update/{id}', [NotulenController::class, 'update']);

Route::post('/report', [LpjController::class, 'store']);
Route::post('/report/update/title/{id}', [LpjController::class, 'updateTitle']);
Route::post('/report/update/file/{id}', [LpjController::class, 'updateFile']);

Route::post('/user/role', [AdminController::class, 'updateRole']);