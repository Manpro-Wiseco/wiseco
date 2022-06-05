@push('styles')
    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
@endpush

@push('scripts')
    {{-- <script src="{{ asset('assets/js/table-row-penawaran-harga.js') }}"></script> --}}
    <script>
        let tableElement = document.getElementById("empTable");
        let tbody = tableElement.getElementsByTagName("tbody")[0];
        $("#pesanan_id").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            // dropdownParent: $(`#container-select-${cell}`),
            theme: "bootstrap-5",
            ajax: {
                url: `${window.url}/pembelian/pesanan-pembelian/data`,
                dataType: "json",
                data: function(params) {
                    return {
                        search: params.term,
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
        $(".data_produk").select2({
            placeholder: "- Pilih Salah Satu -",
            theme: "bootstrap-5",
        });
        $("#pesanan_id").on("select2:select", function(e) {
            var response = e.params.data;
            console.log(response);
            $("#data_contact_id").html(``);
            $("#data_contact_id").append(`
                <option value="${response.data.data_contact.id}" selected>${response.data.data_contact.name + " - " + response.data.data_contact.status}</option>
            `);
            let arrHead = new Array(); // array for header.
            arrHead = ["Item", "Qty", "Unit", "Unit Price", "Total Price", "#"];
            let tableElement = document.getElementById("empTable");
            let tbody = tableElement.getElementsByTagName("tbody")[0];
            $("#empTable tbody").html("");
            for (let index = 0; index < response.item_count; index++) {
                $("#empTable tbody").append(`
                <tr>
                    <td>
                        <div class="data_produk_container">
                            <select name="data_produk_id[]"
                                id="data_produk_id_${index}"
                                data="data_produk"
                                class="form-control data_produk"
                                required readonly>
                                <option value="${response.data.items[index].id}" selected>
                                    ${response.data.items[index].nameItem}</option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="jumlah_barang[]"
                            data="jumlah_barang" required="required"
                            placeholder="0"
                            value="${response.data.items[index].pivot.jumlah_barang}" readonly
                            class="form-control text-right jumlah_barang">
                        @error('jumlah_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td>
                        <p type="text" name="unitItem[]" data="unitItem"
                            required="required" readonly class="text-center unitItem">
                            ${response.data.items[index].unitItem}</p>
                        @error('unitItem')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td>
                        <p class="text-center harga_barang-text">Rp
                            ${response.data.items[index].pivot.harga_barang}</p><input
                            name="harga_barang[]" data="harga_barang"
                            required="required"
                            value="${response.data.items[index].pivot.harga_barang}"
                            class="harga_barang-input" type="hidden" readonly>
                        @error('harga_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td>
                        <p class="text-center subtotal-text">Rp
                            ${response.data.items[index].pivot.subtotal}</p><input
                            type="hidden" name="subtotal[]" data="subtotal"
                            placeholder="Rp"
                            value="${response.data.items[index].pivot.subtotal}"
                            required="required" readonly
                            class="text-center subtotal-input">
                        @error('subtotal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    <td class="align-middle text-center"><input type="button"
                            value="Delete"
                            class="btn bg-gradient-danger btn-small"
                            onclick="removeRow(this)"></td>
                </tr>
                `)
            }

        });
    </script>
@endpush
<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('pembelian.penerimaan-barang.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Buat Penerimaan Barang</h3>
                        <div class="card-body pt-0">
                            <form action="{{ route('pembelian.penerimaan-barang.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">No. Pesanan</label>
                                        <select name="pesanan_id" id="pesanan_id"
                                            class="form-control @error('pesanan_id') is-invalid @enderror" required>
                                            <option></option>
                                        </select>
                                        @error('pesanan_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Pemasok</label>
                                        <select name="data_contact_id" id="data_contact_id"
                                            class="form-control @error('data_contact_id') is-invalid @enderror" required
                                            readonly>
                                        </select>
                                        @error('data_contact_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="form-label mt-4">Tanggal Transaksi</label>
                                        <input type="date"
                                            class="form-control @error('tanggal') is-invalid @enderror"
                                            id="tanggal" name="tanggal"
                                            value="{{ old('tanggal') }}" placeholder="Nomor Telepon"
                                            required>
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label mt-4">No. Penerimaan Barang</label>
                                        <input type="text" class="form-control @error('no_penerimaan') is-invalid @enderror"
                                            id="no_penerimaan" name="no_penerimaan" value="{{ old('no_penerimaan') }}"
                                            placeholder="No. Penerimaan Barang" required>
                                        @error('no_penerimaan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Deskripsi</label>
                                        <input type="text"
                                            class="form-control @error('deskripsi') is-invalid @enderror"
                                            id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}"
                                            placeholder="Deskripsi" required>
                                        @error('deskripsi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div id="cont">
                                            <table id="empTable" class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            Item</td>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            Qty</td>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            Unit</td>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            Unit Price</td>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            Total Price</td>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            #</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div> <!-- the container to add the TABLE -->
                                        <div class="d-grid gap-3">
                                            <button class="btn btn-primary" type="button" id="addRow">
                                                <i class="fas fa-plus"></i> Add New Row
                                            </button>
                                        </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            
                                           <!-- <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="biaya-lain">Biaya
                                                    Lain</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" id="biaya-lain"
                                                        placeholder="Rp.">
                                                </div>
                                            </div>
                                        -->

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
                                    <input type="submit" id="bt" value="Submit Data" class="btn bg-gradient-primary" />
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
