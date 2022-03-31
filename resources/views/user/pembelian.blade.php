<x-template-layout>
    <section class="content"> 
    <div class="container">
        <div class="row">
       
            <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('penawaran-pembelian')}}">
                        <div class="card bg-gradient-success">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Permintaan Penawaran Barang</h4>
                                    <i class="text-white fas fa-envelope-open-text fa-5x my-3"></i> 
                                    <p class="text-white">Membuat Penawaran Harga Untuk Pemasok</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            
                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('pesanan-pembelian')}}">
                        <div class="card bg-gradient-info">
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
                    <a class="link" href="{{route('penawaran-pembelian')}}">
                        <div class="card bg-gradient-secondary">
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
                    <a class="link" href="{{route('faktur-pembelian')}}">
                        <div class="card bg-gradient-warning">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Faktur Pembelian</h4>
                                    <i class="text-white fas fa-file-invoice fa-5x my-3"></i>
                                    <p class="text-white">Mencatat Faktur Pembelian Dari Pemasok</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            
                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('retur-pembelian')}}">
                        <div class="card bg-gradient-primary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Retur Pembelian</h4>
                                    <i class="text-white fas fa-file-invoice fa-5x my-3"></i>
                                    <p class="text-white">Mencatat Retur Pembelian</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('Daftar-Pembayaran-Utang')}}">
                        <div class="card bg-gradient-danger">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Daftar Pembayaran Utang Usaha</h4>
                                    <i class="text-white fas fa-file-invoice fa-5x my-3"></i>
                                    <p class="text-white">Menampilkan Daftar Utang Usaha dan Mencatat Utang Usaha kepada Pemasok</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('Penerimaan-lebih-bayar')}}">
                        <div class="card bg-gradient-dark">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Penerimaan Lebih Bayar (Debit)</h4>
                                    <i class="text-white fas fa-file-invoice fa-5x my-3"></i>
                                    <p class="text-white">Menerima kembali nilai Pembayaran yang berlebih </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
       
        </div>
    </div>
    </section>
</x-template-layout>
