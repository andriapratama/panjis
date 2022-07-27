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

Route::post('/gallery', [PublikasiController::class, 'store']);

Route::post('/member', [AnggotaController::class, 'store']);

Route::post('/absent', [AbsenController::class, 'store']);
Route::post('/absent/update', [AbsenController::class, 'updateAbsentDetail']);

Route::post('/product', [BarangController::class, 'store']);

Route::post('/loan', [PeminjamanController::class, 'store']);
Route::post('/loan/status/{id}', [PeminjamanController::class, 'updateStatus']);

Route::post('/announ', [PengumumanController::class, 'store']);

Route::post('/note', [NotulenController::class, 'store']);

Route::post('/report', [LpjController::class, 'store']);

Route::post('/user/role', [AdminController::class, 'updateRole']);