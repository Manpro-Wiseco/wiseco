<x-template-layout>
    <section class="content">
        
        <div class="container">
            {{-- <div class="row justify-content-md-center">
                <div class="col">
                    <div class="col-md-6">
                        <div class="card bg-cover text-center" style="background-image: url('https://images.unsplash.com/photo-1541451378359-acdede43fdf4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80')">
                        <div class="card-body z-index-2 py-7">
                            <h3 class="text-white">Social Analytics</h3>
                            <p class="text-white">
                            Insight to help you create, connect.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col-md-6">
                        <div class="card bg-cover text-center" style="background-image: url('https://images.unsplash.com/photo-1541451378359-acdede43fdf4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80')">
                        <div class="card-body z-index-2 py-7">
                            <h3 class="text-white">Social Analytics</h3>
                            <p class="text-white">
                            Insight to help you create, connect.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col-md-6">
                        <div class="card bg-cover text-center" style="background-image: url('https://images.unsplash.com/photo-1541451378359-acdede43fdf4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80')">
                        <div class="card-body z-index-2 py-7">
                            <h3 class="text-white">Social Analytics</h3>
                            <p class="text-white">
                            Insight to help you create, connect.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col-md-6">
                        <div class="card bg-cover text-center" style="background-image: url('https://images.unsplash.com/photo-1541451378359-acdede43fdf4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=934&amp;q=80')">
                        <div class="card-body z-index-2 py-7">
                            <h3 class="text-white">Social Analytics</h3>
                            <p class="text-white">
                            Insight to help you create, connect.
                            </p>
                        </div>
                    </div>
                </div>
            </div> --}}
            
{{-- --------------------------------------- --}}

            <div class="row">
                <a class="link  " href="{{ route('index') }}">
                    <div class="col-md-4 mt-4">
                        <div class="card text-center" style="background-color:rgb(196, 121, 219)">
                            <div class="card-body py-4">
                            <h4 class="text-Black">Penawaran Harga</h4>
                            <img class="w-100 position-relative z-index-2 pt-4"
                                                src="{{ asset('assets') }}/img/illustrations/rocket-white.png"
                                                alt="rocket">
                            <p class="text-white">Membuat Penawaran Harga Untuk Pelanggan.</p>
                            </div>
                        </div>
                </a> 
            </div>
            
            <div class="col-md-4 mt-4">
                <a class="link  " href="{{ route('index') }}"> 
                    <div class="card bg-cover text-center" style="background-color: #c7d63d">
                        <div class="card-body py-4">
                          <h4 class="text-black">Pesanan Penjualan</h4>
                          <img class="w-100 position-relative z-index-2 pt-4"
                                            src="{{ asset('assets') }}/img/illustrations/rocket-white.png"
                                            alt="rocket">
                          <p class="text-white">Membuat Pesanan Penjualan Untuk Pelanggan.</p>
                        </div>
                      </div>
                </a>                        
            </div>

            <div class="col-md-4 mt-4">
                <a class="link  " href="{{ route('index') }}"> 
                    <div class="card bg-cover text-center" style="background-color: #E6BD9F">
                        <div class="card-body py-4">
                          <h4 class="text-black">Pengiriman Barang</h4>
                          <img class="w-100 position-relative z-index-2 pt-4"
                                            src="{{ asset('assets') }}/img/illustrations/rocket-white.png"
                                            alt="rocket">
                          <p class="text-white">Membuat pesanan penjualan untuk pelanggan.</p>
                        </div>
                      </div>
                </a>                        
            </div>
            
            
            
                <div class="col-md-4 mt-4">
                    <a class="link  " href="{{ route('index') }}">
                        <div class="card bg-cover text-center" style="background-color: #d44f4f">
                            <div class="card-body py-4">
                                <h4 class="text-black">Faktur Penjualan</h4>
                                <img class="w-100 position-relative z-index-2 pt-4"
                                                    src="{{ asset('assets') }}/img/illustrations/rocket-white.png"
                                                    alt="rocket">
                                <p class="text-white">Mencatat faktur penjualan untuk pelanggan.</p>
                            </div>
                        </div>
                    </a>  
                </div>
             

            
                <div class="col-md-4 mt-4">
                    <a class="link  " href="{{ route('index') }}">
                        <div class="card bg-cover text-center" style="background-color: #ADDBC6">
                            <div class="card-body py-4">
                            <h4 class="text-black">Retur Penjualan</h4>
                            <img class="w-100 position-relative z-index-2 pt-4"
                                                src="{{ asset('assets') }}/img/illustrations/rocket-white.png"
                                                alt="rocket">
                            <p class="text-white">Mencatat retur penjualan untuk pelanggan.</p>
                            </div>
                        </div>
                    </a>  
                </div>
             
        </div>
    </section>
</x-template-layout>
