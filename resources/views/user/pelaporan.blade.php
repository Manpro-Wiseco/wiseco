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
                <a class="link  " href="{{ route('laporan-keuangan') }}">
                    <div class="col-md-6 mt-6">
                        <div class="card text-center" style="background-color:rgb(196, 121, 219)">
                            <div class="card-body py-4">
                                <h4 class="text-Black">Laporan Keuangan</h4>
                                <img class="w-20 position-relative z-index-2 pt-1"
                                    src="{{ asset('assets') }}/img/finance-report.png">

                            </div>
                        </div>
                </a>
            </div>

            <div class="col-md-6 mt-6">
                <a class="link  " href="{{ route('laporan-penjualan') }}">
                    <div class="card bg-cover text-center" style="background-color: #4b3eff">
                        <div class="card-body py-4">
                            <h4 class="text-black">Laporan Penjualan dan Piutang</h4>
                            <img class="w-20 position-relative z-index-2 pt-2"
                                src="{{ asset('assets') }}/img/sales-report.png">

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 mt-6">
                <a class="link  " href="{{ route('laporan-pembelian') }}">
                    <div class="card bg-cover text-center" style="background-color: #E6BD9F">
                        <div class="card-body py-4">
                            <h4 class="text-black">Laporan Pembelian dan Piutang</h4>
                            <img class="w-20 position-relative z-index-2 pt-2"
                                src="{{ asset('assets') }}/img/sales-report.png">
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-md-6 mt-6">
                <a class="link  " href="#">
                    <div class="card bg-cover text-center" style="background-color: #E69D93">
                        <div class="card-body py-4">
                            <h4 class="text-black">Laporan Produk</h4>
                            <img class="w-20 position-relative z-index-2 pt-2"
                                src="{{ asset('assets') }}/img/other-report.png">
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-md-6 mt-6">
                <a class="link  " href="#">
                    <div class="card bg-cover text-center" style="background-color: #ADDBC6">
                        <div class="card-body py-4">
                            <h4 class="text-black">Laporan Lainnya</h4>
                            <img class="w-20 position-relative z-index-2 pt-2"
                                src="{{ asset('assets') }}/img/other-report.png">
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>
</x-template-layout>
