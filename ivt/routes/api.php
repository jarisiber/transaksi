<?php

use App\Http\Controllers\API\CommodityAcquisitionController;
use App\Http\Controllers\API\CommodityController;
use App\Http\Controllers\API\CommodityLocationController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\PcController;
use App\Http\Controllers\API\TiketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->group(function () {
    // Barang
    Route::get('/barang/{commodity}', [CommodityController::class, 'show'])->name('barang.show');
    Route::get('/barang/{commodity}/qrcode', [CommodityController::class, 'generateQrCode'])->name('barang.generate-qrcode');

    // Ruangan
    Route::get('/ruangan/{commodity_location}', [CommodityLocationController::class, 'show'])->name('ruangan.show');

    // Perolehan
    Route::get('/perolehan/{commodity_acquisition}',[CommodityAcquisitionController::class, 'show'])->name('perolehan.show');

    // PC
    Route::get('/pc/{pc}',[PcController::class, 'show'])->name('pc.show');

    // Tiket
    Route::get('/tiket/{ticket}',[TiketController::class, 'show'])->name('tiket.show');
    Route::put('/tiket/{id}', [TicketController::class, 'update'])->name('tiket.update');
    Route::post('/tiket/{id}/komentar', [TicketController::class, 'addComment'])->name('tiket.addComment');

    // Pengguna
    Route::get('/pengguna/{user}', [UserController::class, 'show'])->name('pengguna.show');
    
    // Peran dan Hak Akses
    Route::get('/peran-dan-hak-akses/{role}', [RoleController::class, 'show'])->name('peran-dan-hak-akses.show');
});
