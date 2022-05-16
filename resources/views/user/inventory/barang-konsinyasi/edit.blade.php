@push('styles')
    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
@endpush

@push('scripts')
    {{-- Script multi table --}}
    <script src="{{ asset('assets/js/konsinyasi-table-edit.js') }}"></script>
    {{-- Script for select 2 for Customer --}}
    <script>
        $("#warehouse_id").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            theme: 'bootstrap-5',
            ajax: {
                url: `{{ route('warehouse.data') }}`,
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
            allowClear: true,
            // dropdownParent: $(`#container-select-${cell}`),
            theme: "bootstrap-5",
            ajax: {
                url: `${window.url}/inventory/data-produk/data`,
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
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('inventory.barang-konsinyasi.index') }}"
                                class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Edit Data Barang Konsinyasi</h4>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('inventory.barang-konsinyasi.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Penerima</label>
                                        <select name="data_contact_id" id="data_contact_id"
                                            class="form-control @error('data_contact_id') is-invalid @enderror"
                                            required>
                                            <option>- Pilih Salah Satu -</option>
                                            @foreach ($dataContacts as $contact)
                                                <option value="{{ $contact->id }}"
                                                    @if ($konsinyasi->data_contact_id == $contact->id) selected @endif>
                                                    {{ $contact->name }} - {{ $contact->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('data_contact_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Dari Gudang</label>
                                        <select name="warehouse_id" id="warehouse_id"
                                            class="form-control @error('warehouse_id') is-invalid @enderror" required>
                                            <option>- Pilih Salah Satu -</option>
                                            <option value="{{ $konsinyasi->warehouse_id }}" selected>
                                                {{ $konsinyasi->warehouse->name }}</option>
                                        </select>
                                        @error('warehouse_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Invoice</label>
                                        <input type="text"
                                            class="form-control @error('invoiceKonsinyasi') is-invalid @enderror"
                                            id="invoiceKonsinyasi" name="invoiceKonsinyasi"
                                            value="{{ old('invoiceKonsinyasi') ?? $konsinyasi->invoiceKonsinyasi }}"
                                            placeholder="Invoice" required>
                                        @error('invoiceKonsinyasi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Tanggal Konsinyasi</label>
                                        <input type="date"
                                            class="form-control @error('dateKonsinyasi') is-invalid @enderror"
                                            id="dateKonsinyasi" name="dateKonsinyasi"
                                            value="{{ old('dateKonsinyasi') ?? $konsinyasi->dateKonsinyasi }}"
                                            required>
                                        @error('dateKonsinyasi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label mt-4">Deskripsi</label>
                                        <input type="text"
                                            class="form-control @error('keterangan') is-invalid @enderror"
                                            id="keterangan" name="keterangan"
                                            value="{{ old('keterangan') ?? $konsinyasi->keterangan }}"
                                            placeholder="Deskripsi" required>
                                        @error('keterangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-5">
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
                                                    @foreach ($konsinyasi->items as $key => $items)
                                                        <tr>
                                                            <td>
                                                                <div class="data_produk_container">
                                                                    <select name="data_produk_id[][]"
                                                                        id="data_produk_id_{{ $key }}"
                                                                        data="data_produk"
                                                                        class="form-control data_produk @error('data_produk_id[]') is-invalid @enderror"
                                                                        required>
                                                                        <option value="{{ $items->id }}">
                                                                            {{ $items->nameItem }}</option>
                                                                    </select>
                                                                    @error('data_produk_id[]')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </td>
                                                            <td><input type="text" name="jumlah_barang[]"
                                                                    data="jumlah_barang" required="required"
                                                                    placeholder="0"
                                                                    value="{{ $items->pivot->jumlah_barang }}"
                                                                    class="form-control text-right jumlah_barang"></td>
                                                            <td>
                                                                <p type="text" name="unitItem[]" data="unitItem"
                                                                    required="required" class="text-center unitItem">
                                                                    {{ $items->unitItem }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="text-center priceItem-text">Rp
                                                                    {{ $items->pivot->harga_barang }}</p><input
                                                                    name="priceItem[]" data="priceItem"
                                                                    required="required"
                                                                    value="{{ $items->pivot->harga_barang }}"
                                                                    class="priceItem-input" type="hidden">
                                                            </td>
                                                            <td>
                                                                <p class="text-center amount-text">Rp
                                                                    {{ $items->pivot->subtotal }}</p><input
                                                                    type="hidden" name="amount[]" data="amount"
                                                                    placeholder="Rp"
                                                                    value="{{ $items->pivot->subtotal }}"
                                                                    required="required"
                                                                    class="text-center amount-input">
                                                            </td>
                                                            <td class="align-middle text-center"><input type="button"
                                                                    value="Delete"
                                                                    class="btn bg-gradient-danger btn-small"
                                                                    onclick="removeRow(this)"></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- the container to add the TABLE -->
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" type="button" id="addRow">
                                                <i class="fas fa-plus"></i> Add New Row
                                            </button>
                                        </div>


                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="button" id="bt" value="Submit Data" data-id="{{ $konsinyasi->id }}"
                                        class="btn bg-gradient-primary" />
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
