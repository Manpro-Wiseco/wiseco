<x-template-layout>
    <section class="content">
        <div class="container">
            <div class="row">

                <div class="col-md-4 mb-5">
                    <a class="link" href="{{ route('pembelian.pesanan-pembelian.index') }}">
                        <div class="card bg-gradient-primary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Pesanan Pembelian</h4>
                                    <i class="text-white fas fa-file-invoice-dollar fa-5x my-3"></i>
                                    <p class="text-white">Membuat Pemesanan Pembelian Untuk Pemasok</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="{{ route('pembelian.penerimaan-barang.index') }}">
                        <div class="card bg-gradient-primary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Penerimaan Barang</h4>
                                    <i class="text-white fas fa-people-carry fa-5x my-3"></i>
                                    <p class="text-white">Membuat Transaksi Penerimaan Barang Untuk Pemasok</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="{{ route('pembelian.faktur-pembelian.index') }}">
                        <div class="card bg-gradient-primary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Faktur Pembelian</h4>
                                    <i class="text-white fas fa-file-import fa-5x my-3"></i>
                                    <p class="text-white">Menampilkan dan Mencatat Faktur Pembelian Dari Pemasok</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="{{ route('pembelian.retur-pembelian.index') }}">
                        <div class="card bg-gradient-primary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Retur Pembelian</h4>
                                    <i class="text-white fas fa-file-export fa-5x my-3"></i>
                                    <p class="text-white">Menampilkan dan Mencatat Retur Pembelian dari Pemasok</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-4 mb-5">
                    <a class="link" href="{{ route('pembelian.daftar-pembayaran-utang.index') }}">
                        <div class="card bg-gradient-primary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Daftar Utang</h4>
                                    <i class="text-white fas fa-address-book fa-5x my-3"></i>
                                    <p class="text-white">Menampilkan Daftar Utang Usaha dan Mencatat Utang Usaha
                                        kepada Pemasok</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
</x-template-layout>
