<x-template-layout>
    <section class="content">        
            <div class="row">
                <div class="col-md-4 mb-5">
                    <a href="{{ route('inventory.data-produk.index') }}">
                        <div class="card bg-gradient-success">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Data Produk</h4>
                                    <i class="text-white fas fa-box-open fa-5x my-3"></i>
                                    <p class="text-white">Mengelola data barang atau jasa berdasarkan sifat dan metode HPP.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            
                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('inventory.penyesuaian-barang.index')}}">
                        <div class="card bg-gradient-info">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Penyesuaian Barang</h4>
                                    <i class="text-white fas fa-file-invoice fa-5x my-3"></i>
                                    <p class="text-white">Menyesuaikan jumlah dan / atau harga barang yang ada pada gudang.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="#">
                        <div class="card bg-gradient-secondary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Stok Opname</h4>
                                    <i class="text-white fas fa-boxes fa-5x my-3"></i>
                                    <p class="text-white">Menyelaraskan jumlah barang antara tersedia buku dan fisik.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="#">
                        <div class="card bg-gradient-warning">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Pindah Gudang</h4>
                                    <i class="text-white fas fa-warehouse fa-5x my-3"></i>
                                    <p class="text-white">Memindahkan dan menyimpan barang di gudang yang dikehendaki.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="#">
                        <div class="card bg-gradient-primary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Produksi</h4>
                                    <i class="text-white fas fa-hammer fa-5x my-3"></i>
                                    <p class="text-white">Mencatat bahan mentah, beban, dan barang jadi untuk perlakuan produksi.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="#">
                        <div class="card bg-gradient-dark">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Konsinyasi Barang Keluar</h4>
                                    <i class="text-white fas fa-dolly fa-5x my-3"></i>
                                    <p class="text-white">Pencatatan Barang Keluar yang sifatnya dititip kepada pihak lain yang telah di percayai.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>  
    </section>
</x-template-layout>
