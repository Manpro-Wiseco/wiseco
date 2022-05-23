@push('styles')
    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/pembelian-table-create.js') }}"></script>
    <script>
        $("#data_contact_id").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            // dropdownParent: $(`#container-select-${cell}`),
            theme: "bootstrap-5",
            ajax: {
                url: `${window.url}/data-contact/data`,
                dataType: "json",
                data: function(params) {
                    return {
                        search: params.term,
                        filter: 'Supplier'
                    };
                },
                processResults: function(response) {
                    return {
                        results: response,
                    };
                },
                cache: true,
            },
        });
    </script>
@endpush
<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('pembelian.pesanan-pembelian.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Buat Pesanan Pembelian</h3>
                        <div class="card-body pt-0">
                            <form action="{{ route('pembelian.pesanan-pembelian.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="form-label">Nama Pemasok</label>
                                        <select name="data_contact_id" id="data_contact_id"
                                            class="form-control @error('data_contact_id') is-invalid @enderror"
                                            required>
                                            <option></option>
                                        </select>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mt-4">Tanggal Transaksi</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mt-4">No. Pesanan</label>
                                        <input type="text"
                                            class="form-control @error('no_pesanan') is-invalid @enderror"
                                            id="no_pesanan" name="no_pesanan" value="{{ old('no_pesanan') }}"
                                            placeholder="No. Pesanan" required>
                                        @error('no_pesanan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Deskripsi</label>
                                        <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                            id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}"
                                            placeholder="Deskripsi" required>
                                        @error('deskripsi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div id="cont"></div> <!-- the container to add the TABLE -->
                                        <div class="d-grid gap-3">
                                            <button class="btn bg-gradient-primary" type="button" id="addRow">
                                                <i class="fas fa-plus"></i> Add New Row
                                            </button>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <hr>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4"
                                                    for="jml-total">Total</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input disabled type="text" class="form-control" id="jml-total"
                                                        placeholder="Rp.">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="button" id="bt" value="Submit" class="btn bg-gradient-primary" />
                                    {{-- <button type="submit" class="btn bg-gradient-primary">Submit</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-layout>
