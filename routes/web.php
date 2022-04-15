
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
    Route::prefix('penjualan')->name('penjualan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\Penjualan\HomeController::class, 'index'])->name('index');

        // Penawaran Harga
        Route::prefix('penawaran-harga')->name('penawaran-harga.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Penjualan\PenawaranHargaController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Penjualan\PenawaranHargaController::class, 'create'])->name('create');
            //Route::post('/store', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Penjualan\PenawaranHargaController::class, 'edit'])->name('edit');
            //Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [\App\Http\Controllers\Penjualan\PenawaranHargaController::class, 'destroy'])->name('destroy');
            Route::get('/list', [\App\Http\Controllers\User\Penjualan\PenawaranHargaController::class, 'list'])->name('list');
            //Route::get('/export', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'export'])->name('export');
        });

        // Pesanan Penjualan
        Route::prefix('pesanan-penjualan')->name('pesanan-penjualan.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Penjualan\PesananPenjualanController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Penjualan\PesananPenjualanController::class, 'create'])->name('create');
            //Route::post('/store', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Penjualan\PesananPenjualanController::class, 'edit'])->name('edit');
            //Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'update'])->name('update');
            //Route::get('/destroy/{id}', [\App\Http\Controllers\Penjualan\PenawaranHargaController::class, 'destroy'])->name('destroy');
            Route::get('/list', [\App\Http\Controllers\User\Penjualan\PesananPenjualanController::class, 'list'])->name('list');
            //Route::get('/export', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'export'])->name('export');
        });

        // Penjualan
        Route::prefix('penjualan')->name('penjualan.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Penjualan\PenjualanController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Penjualan\PenjualanController::class, 'create'])->name('create');
            //Route::post('/store', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Penjualan\PenjualanController::class, 'edit'])->name('edit');
            //Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'update'])->name('update');
            //Route::get('/destroy/{id}', [\App\Http\Controllers\Penjualan\PenawaranHargaController::class, 'destroy'])->name('destroy');
            Route::get('/list', [\App\Http\Controllers\User\Penjualan\PenjualanController::class, 'list'])->name('list');
            //Route::get('/export', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'export'])->name('export');
        });

        // Pengiriman Barang
        Route::prefix('pengiriman-barang')->name('pengiriman-barang.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Penjualan\PengirimanBarangController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Penjualan\PengirimanBarangController::class, 'create'])->name('create');
            //Route::post('/store', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Penjualan\PengirimanBarangController::class, 'edit'])->name('edit');
            //Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\PengirimanBarangController::class, 'update'])->name('update');
            //Route::get('/destroy/{id}', [\App\Http\Controllers\Penjualan\PengirimanBarangHargaController::class, 'destroy'])->name('destroy');
            Route::get('/list', [\App\Http\Controllers\User\Penjualan\PengirimanBarangController::class, 'list'])->name('list');
            //Route::get('/export', [\App\Http\Controllers\User\Inventory\PengirimanBarangController::class, 'export'])->name('export');
        });

        // Penjualan
        Route::prefix('faktur-penjualan')->name('faktur-penjualan.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Penjualan\FakturPenjualanController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Penjualan\FakturPenjualanController::class, 'create'])->name('create');
            //Route::post('/store', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Penjualan\FakturPenjualanController::class, 'edit'])->name('edit');
            //Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'update'])->name('update');
            //Route::get('/destroy/{id}', [\App\Http\Controllers\Penjualan\PenawaranHargaController::class, 'destroy'])->name('destroy');
            Route::get('/list', [\App\Http\Controllers\User\Penjualan\FakturPenjualanController::class, 'list'])->name('list');
            //Route::get('/export', [\App\Http\Controllers\User\Inventory\DataProdukController::class, 'export'])->name('export');
        });

        // Retur Penjualan
        Route::prefix('retur-penjualan')->name('retur-penjualan.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Penjualan\ReturPenjualanController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Penjualan\ReturPenjualanController::class, 'create'])->name('create');
            //Route::post('/store', [\App\Http\Controllers\User\Inventory\ReturPenjualanController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Penjualan\ReturPenjualanController::class, 'edit'])->name('edit');
            //Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\ReturPenjualanController::class, 'update'])->name('update');
            //Route::get('/destroy/{id}', [\App\Http\Controllers\Penjualan\ReturPenjualanHargaController::class, 'destroy'])->name('destroy');
            Route::get('/list', [\App\Http\Controllers\User\Penjualan\ReturPenjualanController::class, 'list'])->name('list');
            //Route::get('/export', [\App\Http\Controllers\User\Inventory\ReturPenjualanController::class, 'export'])->name('export');
        });
    });

    // Pembelian
    Route::get('/pembelian', [\App\Http\Controllers\User\PembelianController::class, 'index'])->name('pembelian');


    //Penawaran pembelian
    Route::get('/penawaran-pembelian', [\App\Http\Controllers\User\Pembelian\PermintaanPenawaranController::class, 'index'])->name('penawaran-pembelian');

    //pesanan pembelian
    Route::get('/pesanan-pembelian', [\App\Http\Controllers\User\Pembelian\PesananPembelianController::class, 'index'])->name('pesanan-pembelian');

    //penerimaan barang
    Route::get('/penerimaan-barang', [\App\Http\Controllers\User\Pembelian\PenerimaanBarangController::class, 'index'])->name('penerimaan-barang');

    //faktur pembelian
    Route::get('/faktur-pembelian', [\App\Http\Controllers\User\Pembelian\FakturPembelianController::class, 'index'])->name('faktur-pembelian');

    //retur pembelian
    Route::get('/retur-pembelian', [\App\Http\Controllers\User\Pembelian\ReturPembelianController::class, 'index'])->name('retur-pembelian');

    //daftar pembayaran utang
    Route::get('/Daftar-Pembayaran-Utang', [\App\Http\Controllers\User\Pembelian\DaftardanPembayaranUtangController::class, 'index'])->name('Daftar-Pembayaran-Utang');

    //penerimaan lebih bayar
    Route::get('/Penerimaan-lebih-bayar', [\App\Http\Controllers\User\Pembelian\DebitController::class, 'index'])->name('Penerimaan-lebih-bayar');

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

        // Gudang
        Route::prefix('gudang')->name('gudang.')->group(function () {
            Route::get('/', [\App\Http\Controllers\User\Inventory\GudangController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\User\Inventory\GudangController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\User\Inventory\GudangController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\User\Inventory\GudangController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [\App\Http\Controllers\User\Inventory\GudangController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [\App\Http\Controllers\User\Inventory\GudangController::class, 'delete'])->name('delete');
            Route::get('/export', [\App\Http\Controllers\User\Inventory\GudangController::class, 'export'])->name('export');
            Route::get('/list', [\App\Http\Controllers\User\Inventory\GudangController::class, 'list'])->name('list');
        });
    });

    // Pengelolaan Kas
    Route::prefix('pengelolaan-kas')->name('pengelolaan-kas.')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\PengelolaanKas\HomeController::class, 'index'])->name('index');

        // Pengelolaan Kas - Expense 
        Route::get('/expense/list', [\App\Http\Controllers\User\PengelolaanKas\ExpenseController::class, 'list'])->name('expense.list');
        Route::resource('/expense', \App\Http\Controllers\User\PengelolaanKas\ExpenseController::class);

        // Pengelolaan Kas - Income 
        Route::get('/income/list', [\App\Http\Controllers\User\PengelolaanKas\IncomeController::class, 'list'])->name('income.list');
        Route::resource('/income', \App\Http\Controllers\User\PengelolaanKas\IncomeController::class);

        // Pengelolaan Kas - Data Account
        Route::get('/data-account/list', [App\Http\Controllers\User\PengelolaanKas\DataAccountController::class, 'list'])->name('data-account.list');
        Route::get('/data-account/data', [App\Http\Controllers\User\PengelolaanKas\DataAccountController::class, 'data'])->name('data-account.data');
        Route::get('/data-account/data-only-cash', [App\Http\Controllers\User\PengelolaanKas\DataAccountController::class, 'dataOnlyIsCash'])->name('data-account.data-only-cash');
        Route::resource('/data-account', App\Http\Controllers\User\PengelolaanKas\DataAccountController::class);

        // Pengelolaan Kas - Fund Transfer
        Route::get('/fund-transfer/list', [App\Http\Controllers\User\PengelolaanKas\FundTransferController::class, 'list'])->name('fund-transfer.list');
        Route::get('/fund-transfer/fromBank', [App\Http\Controllers\User\PengelolaanKas\FundTransferController::class, 'fromBank'])->name('fund-transfer.fromBank');
        Route::get('/fund-transfer/toBank', [App\Http\Controllers\User\PengelolaanKas\FundTransferController::class, 'toBank'])->name('fund-transfer.toBank');
        Route::resource('/fund-transfer', App\Http\Controllers\User\PengelolaanKas\FundTransferController::class);
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
    // Data Lainnya - Classification
    Route::get('/classification/list', [\App\Http\Controllers\User\ClassificationController::class, 'list'])->name('classification.list');
    Route::resource('/classification', \App\Http\Controllers\User\ClassificationController::class);
    // Data Lainnya - Subclassification
    Route::get('{classification}/subclassification/list', [App\Http\Controllers\User\SubclassificationController::class, 'list'])->name('subclassification.list');
    Route::get('/subclassification/data', [App\Http\Controllers\User\SubclassificationController::class, 'data'])->name('subclassification.data');
    Route::resource('/subclassification', \App\Http\Controllers\User\SubclassificationController::class);
    // Data Lainnya - Ticket
    Route::get('/ticket/list', [\App\Http\Controllers\User\TicketController::class, 'list'])->name('ticket.list');
    Route::get('/ticket/view/{id}', [\App\Http\Controllers\User\TicketController::class, 'view'])->name('ticket.view');
    Route::get('/ticket/update', [\App\Http\Controllers\User\TicketController::class, 'update'])->name('ticket.update');
    Route::resource('/ticket', \App\Http\Controllers\User\TicketController::class);

    Route::get('/ticket_response/store', [\App\Http\Controllers\User\TicketResponseController::class, 'store'])->name('ticket_response.store');
    Route::resource('/ticket_response', \App\Http\Controllers\User\TicketResponseController::class);
});
