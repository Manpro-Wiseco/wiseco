<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}" />
@push('scripts')
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
@endpush

{{-- Content Body --}}
<x-template-layout>
    <section class="content w3-container w3-center w3-animate-bottom">

        {{-- Loss,Revenue,Expense,Filter  --}}
        <div class="row">
            {{-- Filter --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="Filter">
                    <div class="carde">
                        <div class="card-body p-3 mb-2">
                            <div class="row">
                                <div class="text-center">
                                    <div class="numbers">
                                        <div class="dropdown">
                                            <button class="btn bg-gradient-primary dropdown-toggle m-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Tampilkan
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="javascript:;">Hari Ini</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">Bulan Ini</a></li>
                                                <li><a class="dropdown-item" href="javascript:;">Tahun Ini</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Loss --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Kerugian</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        Rp0,00
                                        {{-- <span class="text-success text-sm font-weight-bolder">+0%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-solid fa-sack-dollar fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Revenue --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pendapatan</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        Rp0,00
                                        {{-- <span class="text-success text-sm font-weight-bolder">+0%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-solid fa-arrow-trend-up text-lg opacity-10 mt-1" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Expense --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pengeluaran</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        Rp0,00
                                        {{-- <span class="text-danger text-sm font-weight-bolder">-0%</span> --}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="fa-solid fa-arrow-trend-down text-lg opacity-10 mt-1" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Daily Sales & Balance Sheet --}}
        <div class="row mt-4">
            {{-- Daily Sales --}}
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Penjualan Harian</h6>
                        <p class="text-sm">
                            {{-- <i class="fa fa-arrow-up text-success"></i> --}}
                            {{-- <span class="font-weight-bold">0% more</span> in 2021 --}}
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <livewire:chart-penjualan>
                        </livewire:chart-penjualan>
                        @section('chart-penjualan-script')
                        <livewire:chart-penjualan-script></livewire:chart-penjualan-script>
                        @endsection
                    </div>
                </div>
            </div>

            {{-- Balance Sheet --}}
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card z-index-2 bg-gradient-primary">
                    <div class="card-header pb-0 ">
                        <h6>Neraca</h6>
                    </div>
                    <div class="card-body p-3">

                        {{-- Asset --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                            <div class="card border border-primary" style="overflow: hidden">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Aset</p>
                                                <h5 class="font-weight-bolder mb-0 text-primary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end ">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-box-open fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Liabilities --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-primary" style="overflow: hidden">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Kewajiban</p>
                                                <h5 class="font-weight-bolder mb-0 text-primary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-clipboard fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Equity --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-primary mb-3" style="overflow: hidden">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Modal</p>
                                                <h5 class="font-weight-bolder mb-0 text-primary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-chart-simple fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Sales & Purchase Invoice --}}
        <div class="row mt-4">

            {{--Sales --}}
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Laporan Penjualan</h6>
                    </div>
                    <div class="card-body p-3">
                        <a href="{{route('laporan-penjualan')}}"><img src="https://go.zahironline.com/assets/img/png/animated/zo-empty-state-dashboard-sales.png" alt=""></a>
                    </div>
                </div>
            </div>

            {{-- Purchase --}}
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Laporan Pembelian</h6>
                    </div>
                    <div class="card-body p-3">
                        <a href="{{route('laporan-pembelian')}}"><img src="https://go.zahironline.com/assets/img/png/animated/zo-empty-state-dashboard-purchases.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Overall Balance & Daily Purchase --}}
        <div class="row mt-4">

            {{-- Balance Sheet --}}
            <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card z-index-2 bg-gradient-primary">
                    <div class="card-body p-3">

                        {{-- Overal Ballance --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-primary" style="overflow: hidden">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Saldo Keseluruhan</p>
                                                <h5 class="font-weight-bolder mb-0 text-primary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-money-bill-wave fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Income --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-primary" style="overflow: hidden">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pendapatan</p>
                                                <h5 class="font-weight-bolder mb-0 text-primary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-money-bill-trend-up fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Expense --}}
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 mt-4">
                            <div class="card border border-primary mb-4" style="overflow: hidden">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengeluaran</p>
                                                <h5 class="font-weight-bolder mb-0 text-primary">
                                                    Rp0,00
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                <i class="fa-solid fa-clipboard-list fa-lg opacity-10 mt-1" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- Daily Purchase --}}
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Pembelian Harian</h6>
                    </div>
                    <div class="card-body p-3">
                        <livewire:chart-pembelian></livewire:chart-pembelian>
                        @section('chart-pembelian-script')
                        <livewire:chart-pembelian-script></livewire:chart-pembelian-script>
                        @endsection
                    </div>
                </div>
            </div>
        </div>

        {{-- Sales Amount & Purchase Amount --}}
        <div class="row mt-4">

            {{--Sales --}}
            <div class="col-lg-6 mb-lg-0 mb-4 text-center">
                <div class="cardi z-index-2">
                    <div class="cardi">
                        <div class="card p-2 m-2 border rounded-3 bg-gradient-primary">
                            <div class="card">
                                <h6>Nilai Penjualan</h6>
                                <h5 class="text">Rp.0</h5>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-lg-6 mb-lg-0 mb-2">
                                <div class="card border p-1 bg-gradient-primary">
                                    <div class="card mt-1">
                                        <h6>Total Transaksi</h6>
                                        <h6>0</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-lg-0 mb-0">
                                <div class="card border p-1 bg-gradient-primary">
                                    <div class="card mt-1">
                                        <h6>Total Pelanggan</h6>
                                        <h6>0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card p-2 m-2 border rounded-3 bg-gradient-primary">
                            <div class="card">
                                <h6>Produk Terjual</h6>
                                <h4 class="text">0</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Purchase --}}
            <div class="col-lg-6 mb-lg-0 mb-4 text-center">
                <div class="cardi z-index-2">
                    <div class="card p-2 m-2 border rounded-3 bg-gradient-primary">
                        <div class="card">
                            <h6>Nilai Pembelian</h6>
                            <h5 class="text">Rp.0</h5>
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col-lg-6 mb-lg-0 mb-2">
                            <div class="card border p-1 bg-gradient-primary">
                                <div class="card mt-1">
                                    <h6>Total Transaksi</h6>
                                    <h6>0</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-lg-0 mb-0">
                            <div class="card border p-1 bg-gradient-primary">
                                <div class="card mt-1">
                                    <h6>Total Pemasok</h6>
                                    <h6>0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-2 m-2 border rounded-3 bg-gradient-primary">
                        <div class="card">
                            <h6>Produk Dibeli</h6>
                            <h4 class="text">0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-3" href={{ route('inbox', session()->get('company')->id) }}>
                <img style="max-height: 30px" src="https://cdn-icons-png.flaticon.com/512/725/725683.png" alt="">
            </a>
        </div>
    </section>
</x-template-layout>
