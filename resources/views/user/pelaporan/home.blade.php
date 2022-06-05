<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-md-4 mb-5">
                <a href="{{ route('laporan.keuangan.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Laporan Keuangan</h4>
                                <i class="text-white fas fa-balance-scale fa-5x my-3"></i>
                                <p class="text-white">
                                    Draft Laporan Keuangan.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="{{ route('laporan.penjualan.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Laporan Penjualan dan Piutang</h4>
                                <i class="text-white fas fa-cash-register fa-5x my-3"></i>
                                <p class="text-white">
                                    Draft Laporan Penjualan dan Piutang.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="{{ route('pengelolaan-kas.fund-transfer.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Laporan Pembelian dan Utang</h4>
                                <i class="text-white fas fa-shopping-basket fa-5x my-3"></i>
                                <p class="text-white">
                                    Draft Laporan Pembelian dan Utang.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="{{ route('pengelolaan-kas.data-account.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Laporan Produk</h4>
                                <i class="text-white fas fa-sitemap fa-5x my-3"></i>
                                <p class="text-white">
                                    Draft Laporan Produk.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="{{ route('pengelolaan-kas.data-account.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Laporan Lainnya</h4>
                                <i class="text-white fas fa-th-list fa-5x my-3"></i>
                                <p class="text-white">
                                    Draft Laporan Lainnya.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-template-layout>
