
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
    Route::get('/penawaran-harga/list', [\App\Http\Controllers\User\PenawaranHargaController::class, 'list'])->name('penawaran-harga.list');
    Route::resource('/penawaran-harga', \App\Http\Controllers\User\PenawaranHargaController::class);
    //Route::get('/index', [\App\Http\Controllers\User\PesananPenjualanController::class, 'index'])->name('index');
    //Route::get('/index', [\App\Http\Controllers\User\FakturPenjualanController::class, 'index'])->name('index');
    //Route::get('/index', [\App\Http\Controllers\User\PengirimanBarangController::class, 'index'])->name('index');
    //Route::get('/index', [\App\Http\Controllers\User\ReturPenjualanController::class, 'index'])->name('index');

    // Pembelian
    Route::get('/pembelian', [\App\Http\Controllers\User\PembelianController::class, 'index'])->name('pembelian');
    Route::get('/penawaran-pembelian', [\App\Http\Controllers\User\PermintaanPenawaranController::class, 'index'])->name('penawaran-pembelian');
    Route::get('/pesanan-pembelian', [\App\Http\Controllers\User\PesananPembelianController::class, 'index'])->name('pesanan-pembelian');
    Route::get('/penerimaan-barang', [\App\Http\Controllers\User\PenerimaanBarangController::class, 'index'])->name('pengiriman-barang');
    Route::get('/faktur-pembelian', [\App\Http\Controllers\User\FakturPembelianController::class, 'index'])->name('faktur-pembelian');
    Route::get('/retur-pembelian', [\App\Http\Controllers\User\ReturPembelianController::class, 'index'])->name('retur-pembelian');

    // Inventory
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\Inventory\HomeController::class, 'index'])->name('index');

        // Data Produk
        Route::prefix('data-produk')->name('data-produk.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'delete'])->name('delete');
            Route::get('/list', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'list'])->name('list');
            Route::get('/export', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'export'])->name('export');
        });

        // Penyesuaian Barang
        Route::prefix('penyesuaian-barang')->name('penyesuaian-barang.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Inventory\PenyesuaianBarangController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Inventory\PenyesuaianBarangController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\User\Inventory\PenyesuaianBarangController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Inventory\PenyesuaianBarangController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\PenyesuaianBarangController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [\App\Http\Controllers\User\Inventory\PenyesuaianBarangController::class, 'delete'])->name('delete');
            Route::get('/export', [\App\Http\Controllers\User\Inventory\PenyesuaianBarangController::class, 'export'])->name('export');
        });

        // Stok Opname
        Route::prefix('stok-opname')->name('stok-opname.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Inventory\StokOpnameController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Inventory\StokOpnameController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\User\Inventory\StokOpnameController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Inventory\StokOpnameController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\StokOpnameController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [\App\Http\Controllers\User\Inventory\StokOpnameController::class, 'delete'])->name('delete');
            Route::get('/export', [\App\Http\Controllers\User\Inventory\StokOpnameController::class, 'export'])->name('export');
        });

        // Pindah Gudang
        Route::prefix('pindah-gudang')->name('pindah-gudang.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Inventory\PindahGudangController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Inventory\PindahGudangController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\User\Inventory\PindahGudangController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Inventory\PindahGudangController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\PindahGudangController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [\App\Http\Controllers\User\Inventory\PindahGudangController::class, 'delete'])->name('delete');
            Route::get('/export', [\App\Http\Controllers\User\Inventory\PindahGudangController::class, 'export'])->name('export');
        });
    });

    // Pengelolaan Kas
    Route::prefix('pengelolaan-kas')->name('pengelolaan-kas.')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\PengelolaanKas\HomeController::class, 'index'])->name('index');

        // Pengelolaan Kas - Expense 
        Route::get('/expense/list', [\App\Http\Controllers\User\PengelolaanKas\ExpenseController::class, 'list'])->name('expense.list');
        Route::resource('/expense', \App\Http\Controllers\User\PengelolaanKas\ExpenseController::class);

        // Pengelolaan Kas - Bank Account
        Route::get('/bank-account/list', [App\Http\Controllers\User\PengelolaanKas\BankAccountController::class, 'list'])->name('bank-account.list');
        Route::resource('/bank-account', App\Http\Controllers\User\PengelolaanKas\BankAccountController::class);
    });

     // Report
     Route::get('/pelaporan', [\App\Http\Controllers\User\PelaporanController::class, 'index'])->name('pelaporan');
     Route::get('/laporan-keuangan', [\App\Http\Controllers\User\KeuanganController::class, 'index'])->name('laporan-keuangan');
     Route::get('/laporan-penjualan', [\App\Http\Controllers\User\LaporanPenjualan::class, 'index'])->name('laporan-penjualan');

    // Data Lainnya - Data Bank 
    Route::get('/data-bank/list', [\App\Http\Controllers\User\DataBankController::class, 'list'])->name('data-bank.list');
    Route::get('/data-bank/data', [\App\Http\Controllers\User\DataBankController::class, 'data'])->name('data-bank.data');
    Route::resource('/data-bank', \App\Http\Controllers\User\DataBankController::class);
    // Data Lainnya - Data Contact 
    Route::get('/data-contact/list', [\App\Http\Controllers\User\DataContactController::class, 'list'])->name('data-contact.list');
    Route::resource('/data-contact', \App\Http\Controllers\User\DataContactController::class);
    // Data Lainnya - Subclassification
    Route::get('/subclassification/data', [App\Http\Controllers\User\SubclassificationController::class, 'data'])->name('subclassification.data');
    // Data Lainnya - Ticket
    Route::get('/ticket/list', [\App\Http\Controllers\User\TicketController::class, 'list'])->name('ticket.list');
    Route::get('/ticket/view/{id}', [\App\Http\Controllers\User\TicketController::class, 'view'])->name('ticket.view');
    Route::get('/ticket/update', [\App\Http\Controllers\User\TicketController::class, 'update'])->name('ticket.update');
    Route::resource('/ticket', \App\Http\Controllers\User\TicketController::class);

    Route::get('/ticket_response/store', [\App\Http\Controllers\User\TicketResponseController::class, 'store'])->name('ticket_response.store');
    Route::resource('/ticket_response', \App\Http\Controllers\User\TicketResponseController::class);
});
