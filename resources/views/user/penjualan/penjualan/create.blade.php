@push('scripts')
    {{-- <script src="{{ asset('assets/js/table-row-penawaran-harga.js') }}"></script> --}}
    <script src="{{ asset('assets/js/moment-min.js') }}"></script>
    <script src="{{ asset('assets/js/penjualan.js') }}"></script>
    @endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/spinner.css') }}">
    <style>
        input[type='number'] {
            -moz-appearance:textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
@endpush
<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('penjualan.penjualan.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Buat Penjualan</h3>
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{!! implode('', $errors->all('<div>:message</div>')) !!}</strong>
                                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button> --}}
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Data Berhasil disimpan</strong>
                                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button> --}}
                            </div>
                        @endif
                        <div class="card-body pt-0">
                            <form action="{{ route('penjualan.penjualan.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="penjualan_id" id="penjualan_id">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Pelanggan</label>
                                        <select name="pelanggan_id" id="data_contact_id"
                                            class="form-control @error('data_contact_id') is-invalid @enderror"
                                            required>
                                            <option value="">- Pilih Salah Satu -</option>
                                            @foreach ($dataContacts as $contact)
                                                <option value="{{ $contact->id }}"
                                                    @if (old('data_contact_id') == $contact->id) selected @endif>
                                                    {{ $contact->name }} - {{ $contact->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('data_contact_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">No. Pesanan</label>
                                        <select name="no_pesanan" id="no_pesanan"
                                            class="form-control @error('no_pesanan') is-invalid @enderror"
                                            required disabled>
                                            <option>-  Pilih No.Pesanan  -</option>
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
                                        <input type="date"
                                            class="form-control @error('transaction_date') is-invalid @enderror"
                                            id="transaction_date" name="tanggal"
                                            value="{{ old('transaction_date') }}" required readonly>
                                        @error('transaction_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mt-4">No. Penjualan</label>
                                        <input type="text" class="form-control @error('invoice') is-invalid @enderror"
                                            id="invoice" name="no_penjualan" value="{{ old('invoice') }}"
                                            placeholder="No. Penjualan" required readonly>
                                        @error('invoice')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Deskripsi</label>
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="deskripsi" value="{{ old('description') }}"
                                            placeholder="Deskripsi" required>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div id="cont"></div> <!-- the container to add the TABLE -->
                                        <div class="d-grid gap-3">
                                            {{-- <button class="btn bg-gradient-secondary" type="button" id="addRow">
                                                <i class="fas fa-plus"></i> Add New Row
                                            </button> --}}
                                            <div id="loader" class="lds-dual-ring overlay hidden">
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <label for="pembayaran">Pembayaran</label>
                                            <select class="form-control mb-2" id="pembayaran" name="data_bank_id">
                                                <option>Pilih Jenis Pembayaran</option>
                                                @foreach ($banks as $b)
                                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                                @endforeach
                                            </select> 
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status_pembayaran" id="lunas" value="1">
                                                <label class="custom-control-label" for="customRadio1">Lunas</label>
                                            </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status_pembayaran" id="kredit" value="2">
                                                <label class="custom-control-label" for="customRadio2">Kerdit</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="other-cost">Biaya Lain</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" id="other-cost" placeholder="Rp." name='other_cost' readonly>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="discount">Discount</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" id="discount" placeholder="%" 
                                                    name="discount" readonly>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="pajak">Pajak</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" id="pajak" placeholder="Rp." 
                                                    name="pajak" readonly>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="potongan">Potongan Harga</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" id="potongan" placeholder="Rp." readonly
                                                    name="potongan">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="jml-total">Total</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input readonly type="number" class="form-control" id="jml-total" placeholder="Rp."
                                                    name="nilai">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="bayar">Jumlah Bayar</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" id="bayar" placeholder="Rp." name="total_pembayaran" requried>
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="sisa">Sisa</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input readonly type="text" class="form-control" id="sisa" placeholder="Rp." name="sisa_pembayaran">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 text-end">
                                    <input type="submit" id="bt" value="Save" class="btn bg-gradient-success text-end" />
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
