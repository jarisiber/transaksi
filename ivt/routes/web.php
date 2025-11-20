<?php

use App\Http\Controllers\CommodityAcquisitionController;
use App\Http\Controllers\CommodityController;
use App\Http\Controllers\CommodityLocationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\KredensialPenggunaController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Models\Messages;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard/otobitz-mth', [HomeController::class, 'getOtobitzMth'])->name('dashboard.otobitzMth');
    Route::get('/dashboard/otobitz-bks', [HomeController::class, 'getOtobitzBks'])->name('dashboard.otobitzBks');
    Route::get('/dashboard/otobitz-smd', [HomeController::class, 'getOtobitzSmd'])->name('dashboard.otobitzSmd');
    Route::get('/dashboard/merce-mth', [HomeController::class, 'getMerceMth'])->name('dashboard.merceMth');
    Route::get('/dashboard/re-ats', [HomeController::class, 'getReAts'])->name('dashboard.reAts');
    Route::get('/dashboard/honda-mth', [HomeController::class, 'getHondaMth'])->name('dashboard.hondaMth');
    Route::get('/dashboard/honda-bks', [HomeController::class, 'getHondaBks'])->name('dashboard.hondaBks');
    Route::get('/dashboard/odoo-mth', [HomeController::class, 'getOdooMth'])->name('dashboard.odooMth');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/tiket/open-count', [ProfileController::class, 'getOpenTicketCount'])->name('tiket.open-count');
    Route::get('/pesan/unread-count', [ProfileController::class, 'getUnreadPesanCount'])->name('pesan.unread-count');

    // MENU COMMODITY
    Route::resource('barang', CommodityController::class)->except('create', 'edit', 'show')
        ->parameter('barang', 'commodity');
    Route::prefix('barang')->name('barang.')->group(function () {
        Route::post('/print', [CommodityController::class, 'generatePDF'])->name('print');
        Route::post('/print/{id}', [CommodityController::class, 'generatePDFIndividually'])->name('print-individual');
        Route::post('/export', [CommodityController::class, 'export'])->name('export');
        Route::post('/import', [CommodityController::class, 'import'])->name('import');
    });

    // MENU COMMODITY ACQUISITION
    Route::resource('perolehan', CommodityAcquisitionController::class)->except('create', 'edit', 'show')
        ->parameter('perolehan', 'commodity_acquisition');

    // MENU BRANCH
    Route::resource('branch', BranchController::class)->except('create', 'edit', 'show')
        ->parameter('branch', 'cabang');

    // MENU DATA KARYAWAN
    Route::resource('karyawan', KaryawanController::class)->except('create', 'edit', 'show')
        ->parameter('karyawan', 'karyawan');

    // MENU COMMODITY LOCATION
    Route::resource('ruangan', CommodityLocationController::class)->except('create', 'edit', 'show')
        ->parameter('ruangan', 'commodity_location');
    Route::post('/ruangan/import', [CommodityLocationController::class, 'import'])->name('ruangan.import');
    Route::post('/ruangan/export', [CommodityLocationController::class, 'export'])->name('ruangan.export');

    // MENU USER
    Route::resource('pengguna', UserController::class)->except('create', 'edit', 'show')
        ->parameter('pengguna', 'user');

    // MENU KREDENSIAL
    Route::resource('kredensial', KredensialPenggunaController::class)->except('create', 'edit', 'show')
        ->parameter('kredensial', 'portal');
    
    // MENU Desktop
    Route::resource('pc', PcController::class)->except('create', 'edit', 'show')
        ->parameter('pc', 'pc');

    // MENU WIFI
    Route::resource('wifi', WifiController::class)->except('create', 'edit', 'show')
        ->parameter('wifi', 'wifi');

    // MENU Email
    Route::resource('email', EmailController::class)->except('create', 'edit', 'show')
        ->parameter('email', 'email');

    // MENU TIKET
    Route::resource('tiket', TicketController::class)->except('create', 'edit', 'show')
        ->parameter('tiket', 'tiket');
    Route::prefix('tiket')->name('tiket.')->group(function () {
        Route::put('/tiket/tutup/{id}', [TicketController::class, 'tutupTiket'])->name('tutupTiket');
        Route::post('/tiket/addComment/{id}', [TicketController::class, 'addComment'])->name('addComment');
        Route::post('/tiket/{id}', [TicketController::class, 'generatePDFSatuTiket'])->name('print-satu');
    });
    Route::get('ticket-notify', [TicketController::class, 'ticketNotify'])->name('ticket.notify');

    // MENU PESAN
    Route::resource('pesan', PesanController::class)->except('create', 'edit', 'show', 'reply')
        ->parameter('pesan', 'pesan');
    Route::get('/pesan/{id}', [PesanController::class, 'getDetailMessage'])->name('pesans.show_detail');
    Route::post('/pesans/toggle-read/{id}', [MessageController::class, 'toggleReadStatus'])
        ->name('pesans.toggle_read')
        ->middleware('auth'); // Ensure only logged-in users can use this

    // MENU PERAN DAN HAK AKSES
    Route::resource('peran-dan-hak-akses', RoleController::class)
        ->parameter('peran-dan-hak-akses', 'role');

    Route::get('/verify/qrcode/{encrypted_id}', [VerificationController::class, 'show'])->name('verify.qrcode');

});
