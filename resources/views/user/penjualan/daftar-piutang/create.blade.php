@push('scripts')
    {{-- <script src="{{ asset('assets/js/table-row-penawaran-harga.js') }}"></script> --}}
    <script src="{{ asset('assets/js/moment-min.js') }}"></script>
    <script src="{{ asset('assets/js/piutang-data.js') }}"></script>
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
        .hidden{
            display: none;
        }

        .spinner-load{
            margin-left: 30px;
        }
    </style>
@endpush
<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('penjualan.daftar-piutang.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <div class="d-flex">
                            <h3>Buat Rincian Piutang</h3>
                            <div class="spinner-border text-primary hidden spinner-load" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{!! implode('', $errors->all('<div>:message</div>')) !!}</strong>
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Data Berhasil disimpan</strong>
                            </div>
                        @endif
                        <div class="card-body pt-0">
                            <form action="{{ route('penjualan.daftar-piutang.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Kode Penjualan</label>
                                        {{-- <input readonly type="text" class="form-control @error('penjualan_id') is-invalid @enderror" name="penjualan_id" id="penjualan_id"> --}}
                                        <select name="penjualan_id" id="penjualan_id" class="form-control @error('penjualan_id') is-invalid @enderror"
                                        required>
                                        <option value="">- Pilih Salah Satu -</option>
                                            @foreach ($data as $d)
                                                <option value="{{ $d->id }}">{{ $d->no_penjualan }} - {{ $d->nama_pelanggan }} </option>
                                            @endforeach
                                        </select>
    
                                        @error('penjualan_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-4">
                                        <label class="form-label">Beban Pembayaran</label>
                                        <input readonly type="number" class="form-control @error('sisa_piutang') is-invalid @enderror"
                                            id="sisa_piutang" name="sisa_piutang" value="{{ old('sisa_piutang') }}"
                                            placeholder="Beban Pembayaran" required readonly>
                                        @error('sisa_piutang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label mt-4">Kode Piutang</label>
                                        <input readonly type="text" class="form-control @error('no_piutang') is-invalid @enderror"
                                            id="no_piutang" name="no_piutang" value="{{ old('no_piutang') }}"
                                            placeholder="No. Penawaran" required readonly>
                                        @error('no_piutang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-3">
                                        <label class="form-label mt-4">Tanggal Awal Kredit</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_awal_kredit') is-invalid @enderror"
                                            id="tanggal_awal_kredit" name="tanggal_awal_kredit"
                                            value="{{ old('tanggal_awal_kredit') }}"
                                            required>
                                        @error('tanggal_awal_kredit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-3">
                                        <label class="form-label mt-4">Lama Kredit (Bulan)</label>
                                        <input  type="number" class="form-control @error('tenor') is-invalid @enderror"
                                            id="tenor" name="tenor" value="{{ old('tenor') }}"
                                            required value="0">
                                        @error('tenor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-3 ">
                                        <label class="form-label mt-4">Status</label>
                                        <select name="status" id="status"
                                        class="form-control @error('status') is-invalid @enderror"
                                        required>
                                            <option value="PENDING" selected>PENDING</option>
                                            <option value="BELUM LUNAS">BELUM LUNAS</option>
                                            <option value="LUNAS">LUNAS</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                 
                                </div>
                                
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Jumlah Bayaran Bulanan</label>
                                        <p id="total-beban">Rp. 0.-</p>
                                        <input readonly 
                                            type="hidden"
                                            class="form-control @error('beban_pembayaran') is-invalid @enderror"
                                            id="beban_pembayaran" name="beban_pembayaran" value="{{ old('beban_pembayaran') }}" 
                                             required value="0">
                                        @error('beban_pembayaran')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
