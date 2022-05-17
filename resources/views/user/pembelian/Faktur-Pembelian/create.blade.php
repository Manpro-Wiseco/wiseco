@push('scripts')
    <script src="{{ asset('assets/js/table-row-penawaran-harga.js') }}"></script>
@endpush
<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('pembelian.faktur-pembelian.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Buat Faktur Pembelian</h3>
                        <div class="card-body pt-0">
                            <form action="{{ route('pembelian.faktur-pembelian.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="form-label">Nama Pemasok</label>
                                        <select name="data_contact_id" id="data_contact_id"
                                            class="form-control @error('data_contact_id') is-invalid @enderror"
                                            required>
                                            <option>- Pilih Salah Satu -</option>
                                            @foreach ($dataContacts as $contact)
                                                <option value="{{ $contact->id }}"
                                                    @if (old('data_contact_id') == $contact->id) selected @endif>
                                                    {{ $contact->name }} - {{ $contact->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">No. Pesanan</label>
                                        <select name="data_contact_id" id="data_contact_id"
                                            class="form-control @error('data_contact_id') is-invalid @enderror"
                                            required>
                                            <option>-  Pilih No.Pesanan  -</option>
                                            @foreach ($dataContacts as $contact)
                                                <option value="{{ $contact->id }}"
                                                    @if (old('data_contact_id') == $contact->id) selected @endif>
                                                    {{ $contact->name }} - {{ $contact->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('phone')
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
                                            class="form-control @error('transaction_date') is-invalid @enderror"
                                            id="transaction_date" name="transaction_date"
                                            value="{{ old('transaction_date') }}" placeholder="Nomor Telepon"
                                            required>
                                        @error('transaction_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label mt-4">No. Faktur</label>
                                        <input type="text" class="form-control @error('invoice') is-invalid @enderror"
                                            id="invoice" name="invoice" value="{{ old('invoice') }}"
                                            placeholder="No. Faktur" required>
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
                                            id="description" name="description" value="{{ old('description') }}"
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
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="other-cost">Biaya Lain</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" id="other-cost" placeholder="Rp.">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="discount">Discount</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" id="discount" placeholder="%">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="pajak">Pajak</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" id="pajak" placeholder="Rp.">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="pajak">Total</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" id="pajak" placeholder="Rp.">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="pajak">Uang Muka</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" id="pajak" placeholder="Rp.">
                                                </div>
                                            </div>
                                            <div class="form-grup row mb-2">
                                                <label class="col-form-label col-6 col-md-4" for="jml-total">Sisa</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input  type="text" class="form-control" id="jml-total" placeholder="Rp.">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="button" id="bt" value="Submit Data" class="btn bg-gradient-primary" />
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
