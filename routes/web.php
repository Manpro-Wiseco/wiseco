
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

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
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\Inventory\HomeController::class, 'index'])->name('index');
    });
    // Route::get('/inventory', [\App\Http\Controllers\User\InventoryController::class, 'index'])->name('inventory');

    // Pengelolaan Kas
    Route::prefix('pengelolaan-kas')->name('pengelolaan-kas.')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\PengelolaanKas\HomeController::class, 'index'])->name('index');

        // Pengelolaan Kas - Expense 
        Route::get('/expense/list', [\App\Http\Controllers\User\PengelolaanKas\ExpenseController::class, 'list'])->name('expense.list');
        Route::resource('/expense', \App\Http\Controllers\User\PengelolaanKas\ExpenseController::class);
    });

    // Data Lainnya - Data Bank 
    Route::get('/data-bank/list', [\App\Http\Controllers\User\DataBankController::class, 'list'])->name('data-bank.list');
    Route::resource('/data-bank', \App\Http\Controllers\User\DataBankController::class);
    // Data Lainnya - Data Contact 
    Route::get('/data-contact/list', [\App\Http\Controllers\User\DataContactController::class, 'list'])->name('data-contact.list');
    Route::resource('/data-contact', \App\Http\Controllers\User\DataContactController::class);
});
