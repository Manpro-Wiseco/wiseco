@push('scripts')
    <script>
        $(".data_contact_id").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            theme: 'bootstrap-5',
            ajax: {
                url: `{{ route('data-contact.data') }}`,
                dataType: "json",
                data: function(params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function(response) {
                    response.unshift({
                        id: 0,
                        text: "Semua"
                    })
                    return {
                        results: response,
                    };
                },
                cache: true,
            },
        });

        $("#tanggal").select2({
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

        $("#tanggal_pemasukan, #is_cash").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            theme: 'bootstrap-5',
        })

        $("#tanggal_pemasukan").on("select2:select", function(e) {
            var data = e.params.data;
            console.log("DATA", data)
            console.log(data.id === "custom");
            if (data.id === "custom") {
                $("#custom-tanggal-pemasukan").append(`
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
                $("#custom-tanggal-pemasukan").html('')
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
                            <h4>Laporan Keuangan</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-letft mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase text-secondary text-l font-weight-bolder opacity-7">
                                            Kas & Bank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <button class="btn btn-default btn-sm mb-0 text-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-pengeluaran">Jurnal Pengeluaran</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <button class="btn btn-default btn-sm mb-0 text-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modal-pemasukan">Jurnal
                                                        Penerimaan</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <button class="btn btn-default btn-sm mb-0 text-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modal-account">Daftar
                                                        Akun</button>
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

    <div class="modal fade" id="modal-pengeluaran" tabindex="-1" role="dialog"
        aria-labelledby="modal-pengeluaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-pengeluaranLabel">Modal Pengeluaran</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('laporan.keuangan.pengeluaran') }}" method="POST" target="_blank">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Penerima</label>
                                <select name="data_contact_id" id="data_contact_id"
                                    class="form-control data_contact_id @error('data_contact_id') is-invalid @enderror"
                                    required>
                                    <option></option>
                                </select>
                                <div class="data_contact_id-error">
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="form-label">Tanggal</label>
                                <select name="tanggal" id="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror" required>
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

    <div class="modal fade" id="modal-pemasukan" tabindex="-1" role="dialog" aria-labelledby="modal-pemasukanLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-pemasukanLabel">Modal Pemasukan</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('laporan.keuangan.pemasukan') }}" method="POST" target="_blank">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Penerima</label>
                                <select name="data_contact_id" id="data_contact_id_pemasukan"
                                    class="form-control data_contact_id @error('data_contact_id') is-invalid @enderror"
                                    required>
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="form-label">Tanggal</label>
                                <select name="tanggal" id="tanggal_pemasukan"
                                    class="form-control @error('tanggal') is-invalid @enderror" required>
                                    <option value="today">Hari Ini</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="year">Tahun Ini</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>

                            <div id="custom-tanggal-pemasukan">

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

    <div class="modal fade" id="modal-account" tabindex="-1" role="dialog" aria-labelledby="modal-accountLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-accountLabel">Modal Daftar Akun</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('laporan.keuangan.data_accounts') }}" method="POST" target="_blank">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Tipe</label>
                                <select name="is_cash" id="is_cash"
                                    class="form-control @error('is_cash') is-invalid @enderror" required>
                                    <option value="2">Semua</option>
                                    <option value="1">Kas/Bank</option>
                                    <option value="0">Non Kas/Bank</option>
                                </select>
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
