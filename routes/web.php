
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth', 'role:user'])->get('/list-company', [\App\Http\Controllers\User\CompanyController::class, 'index'])->name('list-company');
Route::middleware(['auth', 'role:user'])->post('/create-company', [\App\Http\Controllers\User\CompanyController::class, 'store'])->name('company.store');
Route::middleware(['auth', 'role:user'])->post('/session-company/{company}', [\App\Http\Controllers\User\CompanyController::class, 'session'])->name('company.session');

Route::middleware(['auth', 'role:user', 'company-session'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');

    // Penjualan
    Route::get('/penjualan', [\App\Http\Controllers\User\PenjualanController::class, 'index'])->name('penjualan');
    Route::get('/penawaran-penjualan', [\App\Http\Controllers\User\PenawaranController::class, 'index'])->name('penawaran-penjualan');
    Route::get('/pesanan-penjualan', [\App\Http\Controllers\User\PesananController::class, 'index'])->name('pesanan-penjualan');
    Route::get('/pengiriman-barang', [\App\Http\Controllers\User\PengirimanController::class, 'index'])->name('pengiriman-barang');
    Route::get('/faktur-penjualan', [\App\Http\Controllers\User\FakturController::class, 'index'])->name('faktur-penjualan');
    Route::get('/retur-penjualan', [\App\Http\Controllers\User\ReturController::class, 'index'])->name('retur-penjualan');


    // Inventory
    Route::get('/inventory', [\App\Http\Controllers\User\InventoryController::class, 'index'])->name('inventory');

     // Report
     Route::get('/pelaporan', [\App\Http\Controllers\User\PelaporanController::class, 'index'])->name('pelaporan');
     Route::get('/laporan-keuangan', [\App\Http\Controllers\User\KeuanganController::class, 'index'])->name('laporan-keuangan');
     Route::get('/laporan-penjualan', [\App\Http\Controllers\User\LaporanPenjualan::class, 'index'])->name('laporan-penjualan');

    // Data Lainnya - Data Bank 
    Route::get('/data-bank/list', [\App\Http\Controllers\User\DataBankController::class, 'list'])->name('data-bank.list');
    Route::resource('/data-bank', \App\Http\Controllers\User\DataBankController::class);

});