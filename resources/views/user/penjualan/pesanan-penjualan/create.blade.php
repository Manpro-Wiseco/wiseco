@push('scripts')
    <script src="{{ asset('assets/js/moment-min.js') }}"></script>
    <script src="{{ asset('assets/js/table-row-penawaran-harga.js') }}"></script>
@endpush
@push('styles')
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
                        <a href="{{ route('penjualan.pesanan-penjualan.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Buat Pesanan Penjualan</h3>
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
                            <form action="{{ route('penjualan.pesanan-penjualan.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="form-label">Nama Pelanggan</label>
                                        <select name="pelanggan_id" id="data_contact_id"
                                            class="form-control @error('pelanggan_id') is-invalid @enderror"
                                            required>
                                            <option value=''>- Pilih Salah Satu -</option>
                                            @foreach ($dataContacts as $contact)
                                                <option value="{{ $contact->id }}"
                                                    @if (old('pelanggan_id') == $contact->id) selected @endif>
                                                    {{ $contact->name }} - {{ $contact->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('pelanggan_id')
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
                                            class="form-control @error('tanggal') is-invalid @enderror"
                                            id="transaction_date" name="tanggal"
                                            value="{{ old('tanggal') }}" placeholder="Nomor Telepon"
                                            required onchange="invcreate(this.value)">
                                        @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label mt-4">No. Pesanan</label>
                                        <input type="text" class="form-control @error('no_pesanan') is-invalid @enderror"
                                            id="invoice" name="no_pesanan" value="{{ old('no_pesanan') }}"
                                            placeholder="No. Pesanan" required readonly>
                                        @error('no_pesanan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Deskripsi</label>
                                        <input type="text"
                                            class="form-control @error('deskripsi') is-invalid @enderror"
                                            id="description" name="deskripsi" value="{{ old('deskripsi') }}"
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
                                            <button class="btn bg-gradient-secondary" type="button" id="addRow">
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
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="other-cost">Biaya Lain (Rp)</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" id="other-cost" placeholder="Rp." value="0" min="-1" name="other_cost">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="discount">Discount (%)</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" id="discount" placeholder="%" value="0" min="-1" name="discount">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="pajak">Pajak (Rp)</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="number" class="form-control" id="pajak" placeholder="Rp." value="0" min="-1" name="pajak">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="potongan">Potongan Harga</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input readonly type="text" class="form-control" id="potongan" placeholder="Rp." name="potongan">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="jml-total">Total</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input readonly type="text" class="form-control" id="jml-total" placeholder="Rp." name="nilai">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="submit" id="bt" value="Save" class="btn bg-gradient-success" />
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
