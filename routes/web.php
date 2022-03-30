
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
    Route::get('/penawaran-harga/list', [\App\Http\Controllers\User\PenawaranHargaController::class, 'list'])->name('penawaran-harga.list');
    Route::resource('/penawaran-harga', \App\Http\Controllers\User\PenawaranHargaController::class);
    //Route::get('/index', [\App\Http\Controllers\User\PesananPenjualanController::class, 'index'])->name('index');
    //Route::get('/index', [\App\Http\Controllers\User\FakturPenjualanController::class, 'index'])->name('index');
    //Route::get('/index', [\App\Http\Controllers\User\PengirimanBarangController::class, 'index'])->name('index');
    //Route::get('/index', [\App\Http\Controllers\User\ReturPenjualanController::class, 'index'])->name('index');


    // Inventory
    Route::get('/inventory', [\App\Http\Controllers\User\InventoryController::class, 'index'])->name('inventory');

    // Data Lainnya - Data Bank 
    Route::get('/data-bank/list', [\App\Http\Controllers\User\DataBankController::class, 'list'])->name('data-bank.list');
    Route::resource('/data-bank', \App\Http\Controllers\User\DataBankController::class);

});