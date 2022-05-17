<x-template-layout>
    <section class="content">        
            {{-- <div class="row"> 
                <div class="col-md-4 mb-5">
                    <a href="{{ route('penjualan.penawaran-harga.index') }}">
                        <div class="card bg-gradient-success">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Penawaran Harga</h4>
                                    <svg width="120px" height="120px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
                                    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path data-name="layer2"
                                    d="M58 4h-1.6l-.5.3h-.2l-.5.4h-.1A4 4 0 0 0 54 8v2h8V8a4 4 0 0 0-4-4zM30 50H2v2a8 8 0 0 0 8 8h23.1a12 12 0 0 1-3.1-8z"
                                    fill="#ffffff"></path>
                                    <path data-name="layer1" d="M16 8v38h18v6a8 8 0 0 0 8 8 8 8 0 0 0 8-8V5.7l.2-.5.2-.6.3-.5H20A4 4 0 0 0 16 8zm9.1 2h16a2 2 0 0 1 0 4h-16a2 2 0 0 1 0-4zm0 8h12a2 2 0 0 1 0 4h-12a2 2 0 0 1 0-4zm0 8h16a2 2 0 0 1 0 4h-16a2 2 0 0 1 0-4zm0 8h12a2 2 0 0 1 0 4h-12a2 2 0 0 1 0-4z"
                                    fill="#ffffff"></path>
                                    </svg>
                                    <p class="text-white">Membuat Penawaran Harga Untuk Pelanggan.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> --}}

            <div class="row">
                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('penjualan.pesanan-penjualan.index')}}">
                        <div class="card bg-gradient-info">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Pesanan Penjualan</h4>
                                    <svg width="120px" height="120px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
                                    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path data-name="layer2"
                                    d="M57.6 24.5H60a2 2 0 0 0 0-4h-5.1L38.5 2.2a2 2 0 1 0-3 2.7l14 15.7h-35l14-15.7a2 2 0 0 0-3-2.7L9.2 20.5H4a2 2 0 0 0 0 4h53.6zm-.8 4h-2.1l1.9 1.1zm-19.5 0h-30l4.8 24h14.8a20 20 0 0 1 10.4-24z"
                                    fill="#ffffff"></path>
                                    <path data-name="layer1" d="M46 30.5a16 16 0 1 0 16 16 16 16 0 0 0-16-16zm7.4 19.4L46 57.3l-7.4-7.4a2 2 0 0 1 2.8-2.8l2.6 2.6V38.5a2 2 0 1 1 4 0v11.2l2.6-2.6a2 2 0 0 1 2.8 2.8z"
                                    fill="#ffffff"></path>
                                    </svg>
                                    <p class="text-white">Membuat Pesanan Penjualan Untuk Pelanggan.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('penjualan.penjualan.index')}}">
                        <div class="card bg-gradient-secondary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Penjualan</h4>
                                    <svg width="145px" height="120px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
                                    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path data-name="layer1"
                                    d="M56.7 35H7.3L2.7 49h58.6zM19 47h-4v-4h4zm5-6h-4v-4h4zm5 6h-4v-4h4zm5-6h-4v-4h4zm5 6h-4v-4h4zm5-6h-4v-4h4zm5 6h-4v-4h4z"
                                    fill="#ffffff"></path>
                                    <path data-name="layer2" fill="#ffffff" d="M2 53h60v10H2z"></path>
                                    <path data-name="layer1" d="M56 23a4 4 0 0 0-4-4h-6v-6h3a5 5 0 0 0 5-5V6a5 5 0 0 0-5-5H39a5 5 0 0 0-5 5v2a5 5 0 0 0 5 5h3v6H32v6h-4V11H16v14h-4v-6a4 4 0 0 0-4 4v8h48zM39 9a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1zm9 19H36a2 2 0 0 1 0-4h12a2 2 0 0 1 0 4z"
                                    fill="#ffffff"></path>
                                    </svg>
                                    <p class="text-white">Membuat Penjualan Untuk Pelanggan.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            
            
                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('penjualan.pengiriman-barang.index')}}">
                        <div class="card bg-gradient-warning">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Pengiriman Barang</h4>
                                    <svg width="120px" height="120px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
                                    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <circle data-name="layer1"
                                    cx="14" cy="50" r="6" fill="#ffffff"></circle>
                                    <circle data-name="layer1" cx="50" cy="50" r="6" fill="#ffffff"></circle>
                                    <path data-name="layer2" d="M14 40a9.9 9.9 0 0 1 6 2h20V8H2v34h6a9.9 9.9 0 0 1 6-2z"
                                    fill="#ffffff"></path>
                                    <path data-name="layer1" d="M23.8 48h16.4a9.9 9.9 0 0 1 .6-2H23.2a10 10 0 0 1 .6 2zM60 50h2v-4h-2.8a9.9 9.9 0 0 1 .8 4zm2-8V28a10 10 0 0 0-10-10h-8v24a9.9 9.9 0 0 1 12 0h6zM2 50h2a9.9 9.9 0 0 1 .8-4H2z"
                                    fill="#ffffff"></path>
                                    </svg>
                                    <p class="text-white">Membuat pesanan penjualan untuk pelanggan.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('penjualan.faktur-penjualan.index')}}">
                        <div class="card bg-gradient-primary">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Faktur Penjualan</h4>
                                    <svg width="120px" height="120px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
                                    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path data-name="layer1"
                                    d="M62 3H2a2 2 0 0 0 0 4h6v54l6-4 6.1 4 6-4 6 4 6-4 6 4 6-4 6 4V7h6a2 2 0 0 0 0-4zM30 43H18a2 2 0 1 1 0-4h12a2 2 0 0 1 0 4zm4-8H18a2 2 0 0 1 0-4h16a2 2 0 1 1 0 4zM16 21a2 2 0 0 1 2-2h12a2 2 0 0 1 0 4H18a2 2 0 0 1-2-2zm18-6H18a2 2 0 1 1 0-4h16a2 2 0 0 1 0 4zm12 28h-4a2 2 0 0 1 0-4h4a2 2 0 0 1 0 4zm0-8h-4a2 2 0 0 1 0-4h4a2 2 0 1 1 0 4zm0-12h-4a2 2 0 0 1 0-4h4a2 2 0 0 1 0 4zm0-8h-4a2 2 0 0 1 0-4h4a2 2 0 0 1 0 4z"
                                    fill="#ffffff"></path>
                                    </svg>
                                    <p class="text-white">Mencatat faktur penjualan untuk pelanggan.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('penjualan.retur-penjualan.index')}}">
                        <div class="card bg-gradient-dark">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Retur Penjualan</h4>
                                    <svg width="145px" height="120px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
                                    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path data-name="layer1"
                                    d="M59 19.5h-5.1L37.5 1.2a2 2 0 0 0-3 2.7l14 15.7h-35l14-15.7a2 2 0 1 0-3-2.7L8.2 19.5H3a2 2 0 0 0 0 4h56a2 2 0 0 0 0-4z"
                                    fill="#ffffff"></path>
                                    <path data-name="layer2" d="M62.4 48.1a2 2 0 0 0-2.8 0l-1.5 1.5a14.1 14.1 0 0 0-4-10 13.9 13.9 0 0 0-16.4-2.4 2 2 0 1 0 1.9 3.5 9.9 9.9 0 0 1 11.7 1.7 10.1 10.1 0 0 1 2.7 6.9l-1.2-1.2a2 2 0 1 0-2.8 2.8l6.2 6.3 6.2-6.3a2 2 0 0 0 0-2.8zm-33.6 2.8l1.5-1.5a14.1 14.1 0 0 0 4 10 13.9 13.9 0 0 0 9.9 4.1 13.7 13.7 0 0 0 6.6-1.7 2 2 0 1 0-1.9-3.5 9.9 9.9 0 0 1-11.7-1.7 10.1 10.1 0 0 1-2.9-6.9l1.2 1.2a2 2 0 1 0 2.8-2.8l-6.2-6.3-6.1 6.3a2 2 0 1 0 2.8 2.8z"
                                    fill="#ffffff"></path>
                                    <path data-name="layer1" d="M38.5 40.9zm-17.1 8.6a6 6 0 0 1 1.7-4.3l6.3-6.2a4 4 0 0 1 2.8-1.2h.4v-.6a6 6 0 0 1 2.9-3.6 17.7 17.7 0 0 1 8.5-2.2 18 18 0 0 1 10.2 3.2l1.4-7.2H6.3l4.8 24h10.6a6 6 0 0 1-.3-1.9zm5.8 2zm16.9-16zm7.3 12z"
                                    fill="#ffffff"></path>
                                    </svg>
                                    <p class="text-white">Mencatat retur penjualan untuk pelanggan.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>  
            
                <div class="col-md-4 mb-5">
                    <a class="link" href="{{route('penjualan.retur-penjualan.index')}}">
                        <div class="card bg-gradient-danger">
                            <div class="card-body pt-3">
                                <div class="text-center">
                                    <h4 class="text-white text-capitalize font-weight-bold">Daftar Piutang Usaha</h4>
                                    <svg width="145px" height="120px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" aria-labelledby="title"
                                    aria-describedby="desc" role="img" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path data-name="layer1"
                                    d="M59 19.5h-5.1L37.5 1.2a2 2 0 0 0-3 2.7l14 15.7h-35l14-15.7a2 2 0 1 0-3-2.7L8.2 19.5H3a2 2 0 0 0 0 4h56a2 2 0 0 0 0-4z"
                                    fill="#ffffff"></path>
                                    <path data-name="layer2" d="M62.4 48.1a2 2 0 0 0-2.8 0l-1.5 1.5a14.1 14.1 0 0 0-4-10 13.9 13.9 0 0 0-16.4-2.4 2 2 0 1 0 1.9 3.5 9.9 9.9 0 0 1 11.7 1.7 10.1 10.1 0 0 1 2.7 6.9l-1.2-1.2a2 2 0 1 0-2.8 2.8l6.2 6.3 6.2-6.3a2 2 0 0 0 0-2.8zm-33.6 2.8l1.5-1.5a14.1 14.1 0 0 0 4 10 13.9 13.9 0 0 0 9.9 4.1 13.7 13.7 0 0 0 6.6-1.7 2 2 0 1 0-1.9-3.5 9.9 9.9 0 0 1-11.7-1.7 10.1 10.1 0 0 1-2.9-6.9l1.2 1.2a2 2 0 1 0 2.8-2.8l-6.2-6.3-6.1 6.3a2 2 0 1 0 2.8 2.8z"
                                    fill="#ffffff"></path>
                                    <path data-name="layer1" d="M38.5 40.9zm-17.1 8.6a6 6 0 0 1 1.7-4.3l6.3-6.2a4 4 0 0 1 2.8-1.2h.4v-.6a6 6 0 0 1 2.9-3.6 17.7 17.7 0 0 1 8.5-2.2 18 18 0 0 1 10.2 3.2l1.4-7.2H6.3l4.8 24h10.6a6 6 0 0 1-.3-1.9zm5.8 2zm16.9-16zm7.3 12z"
                                    fill="#ffffff"></path>
                                    </svg>
                                    <p class="text-white">Menampilkan Daftar Piutang Usaha dari pelanggan.</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </section>
</x-template-layout>
