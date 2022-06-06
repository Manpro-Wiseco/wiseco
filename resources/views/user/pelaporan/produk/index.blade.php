@push('scripts')
    <script>
        $(".tanggal").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            theme: 'bootstrap-5',
        })

        $("#tanggal").on("select2:select", function(e) {
            var data = e.params.data;
            console.log("DATA", data)
            console.log(data.id === "custom");
            if (data.id === "custom") {
                $("#custom-tanggal").append(`
                    <div class="col-md-12 mt-4">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" id="dari_tanggal"
                            class="form-control @error('dari_tanggal') is-invalid @enderror" required>
                        <div class="dari_tanggal-error">
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label class="form-label">Hingga Tanggal</label>
                        <input type="date" name="hingga_tanggal" id="hingga_tanggal"
                            class="form-control @error('hingga_tanggal') is-invalid @enderror" required>
                        <div class="hingga_tanggal-error">
                        </div>
                    </div>
                `)
            } else {
                $("#custom-tanggal").html('')
            }
        });
        $("#tanggal-pengiriman").on("select2:select", function(e) {
            var data = e.params.data;
            console.log("DATA", data)
            console.log(data.id === "custom");
            if (data.id === "custom") {
                $("#custom-tanggal-pengiriman").append(`
                    <div class="col-md-12 mt-4">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" id="dari_tanggal"
                            class="form-control @error('dari_tanggal') is-invalid @enderror" required>
                        <div class="dari_tanggal-error">
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label class="form-label">Hingga Tanggal</label>
                        <input type="date" name="hingga_tanggal" id="hingga_tanggal"
                            class="form-control @error('hingga_tanggal') is-invalid @enderror" required>
                        <div class="hingga_tanggal-error">
                        </div>
                    </div>
                `)
            } else {
                $("#custom-tanggal-pengiriman").html('')
            }
        });
        $("#tanggal-retur").on("select2:select", function(e) {
            var data = e.params.data;
            console.log("DATA", data)
            console.log(data.id === "custom");
            if (data.id === "custom") {
                $("#custom-tanggal-retur").append(`
                    <div class="col-md-12 mt-4">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" id="dari_tanggal"
                            class="form-control @error('dari_tanggal') is-invalid @enderror" required>
                        <div class="dari_tanggal-error">
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label class="form-label">Hingga Tanggal</label>
                        <input type="date" name="hingga_tanggal" id="hingga_tanggal"
                            class="form-control @error('hingga_tanggal') is-invalid @enderror" required>
                        <div class="hingga_tanggal-error">
                        </div>
                    </div>
                `)
            } else {
                $("#custom-tanggal-retur").html('')
            }
        });
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('laporan.index') }}" class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Laporan Produk</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-letft mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase text-secondary text-l font-weight-bolder opacity-7">
                                            Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <form action="{{ route('laporan.produk.produk') }}" method="POST"
                                                    target="_blank">
                                                    @csrf
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <button type="submit"
                                                            class="btn btn-default btn-sm mb-0 text-sm">Laporan
                                                            Daftar
                                                            Produk</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <button class="btn btn-default btn-sm mb-0 text-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-produk-terjual">Laporan
                                                        Daftar Produk Terjual</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <button class="btn btn-default btn-sm mb-0 text-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-produk-dibeli">Laporan
                                                        Daftar Produk Dibeli</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table align-items-letft mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase text-secondary text-l font-weight-bolder opacity-7">
                                            Transaksi Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <button class="btn btn-default btn-sm mb-0 text-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-pesanan-penjualan">Laporan Penyesuaian
                                                        Barang</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <button class="btn btn-default btn-sm mb-0 text-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-pengiriman-penjualan">Laporan
                                                        Pindah Gudang</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <button class="btn btn-default btn-sm mb-0 text-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-retur-penjualan">Laporan
                                                        Stok Opname</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-produk-terjual" tabindex="-1" role="dialog"
        aria-labelledby="modal-produk-terjualLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-produk-terjualLabel">Daftar Produk Terjual</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('laporan.produk.produk_jual') }}" method="POST" target="_blank">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <label class="form-label">Tanggal</label>
                                <select name="tanggal" id="tanggal"
                                    class="form-control tanggal @error('tanggal') is-invalid @enderror" required>
                                    <option value="today">Hari Ini</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="year">Tahun Ini</option>
                                    <option value="custom">Custom</option>
                                </select>
                                <div class="tanggal-error">
                                </div>
                            </div>
                            <div id="custom-tanggal">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-produk-dibeli" tabindex="-1" role="dialog"
        aria-labelledby="modal-produk-dibeliLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-produk-dibeliLabel">Daftar Produk Dibeli</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('laporan.produk.produk_beli') }}" method="POST" target="_blank">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <label class="form-label">Tanggal</label>
                                <select name="tanggal" id="tanggal"
                                    class="form-control tanggal @error('tanggal') is-invalid @enderror" required>
                                    <option value="today">Hari Ini</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="year">Tahun Ini</option>
                                    <option value="custom">Custom</option>
                                </select>
                                <div class="tanggal-error">
                                </div>
                            </div>
                            <div id="custom-tanggal">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pengiriman-penjualan" tabindex="-1" role="dialog"
        aria-labelledby="modal-pengiriman-penjualanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-pengiriman-penjualanLabel">Pengiriman Penjualan</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('laporan.penjualan.pengiriman') }}" method="POST" target="_blank">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <label class="form-label">Tanggal</label>
                                <select name="tanggal" id="tanggal-pengiriman"
                                    class="form-control tanggal @error('tanggal') is-invalid @enderror" required>
                                    <option value="today">Hari Ini</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="year">Tahun Ini</option>
                                    <option value="custom">Custom</option>
                                </select>
                                <div class="tanggal-error">
                                </div>
                            </div>
                            <div id="custom-tanggal-pengiriman">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-retur-penjualan" tabindex="-1" role="dialog"
        aria-labelledby="modal-retur-penjualanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-retur-penjualanLabel">Retur Penjualan</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('laporan.penjualan.retur') }}" method="POST" target="_blank">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <label class="form-label">Tanggal</label>
                                <select name="tanggal" id="tanggal-retur"
                                    class="form-control tanggal @error('tanggal') is-invalid @enderror" required>
                                    <option value="today">Hari Ini</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="year">Tahun Ini</option>
                                    <option value="custom">Custom</option>
                                </select>
                                <div class="tanggal-error">
                                </div>
                            </div>
                            <div id="custom-tanggal-retur">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-template-layout>
