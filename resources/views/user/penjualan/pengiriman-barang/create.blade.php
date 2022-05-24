@push('scripts')
    <script src="{{ asset('assets/js/table-row-penawaran-harga.js') }}"></script>
@endpush
<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('penjualan.pengiriman-barang.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Buat Pengiriman Barang</h3>
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
                            <form action="{{ route('penjualan.pengiriman-barang.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="form-label">Kode Penjualan</label>
                                        <select name="penjualan_id" id="penjualan_id"
                                            class="form-control @error('penjualan_id') is-invalid @enderror"
                                            required>
                                            <option>- Pilih Salah Satu -</option>
                                            @foreach ($dataPenjualan as $data)
                                                <option value="{{ $data->id }}"
                                                    @if (old('penjualan_id') == $data->id) selected @endif>
                                                    {{ $data->no_penjualan }} - {{ $data->nama_pelanggan }}</option>
                                            @endforeach
                                        </select>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Kurir</label>
                                        <input type="text" class="form-control @error('kurir') is-invalid @enderror"
                                            id="kurir" name="kurir" value="{{ old('kurir') }}"
                                            placeholder="Nama jasa pengiriman" required>
                                        @error('kurir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="form-label mt-4">Tanggal Pengiriman</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_pengiriman') is-invalid @enderror"
                                            id="tanggal_pengiriman" name="tanggal_pengiriman"
                                            value="{{ old('tanggal_pengiriman') }}" placeholder="Nomor Telepon"
                                            required>
                                        @error('tanggal_pengiriman')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label mt-4">No. Pengiriman/Resi</label>
                                        <input type="text" class="form-control @error('no_pengiriman') is-invalid @enderror"
                                            id="no_pengiriman" name="no_pengiriman" value="{{ old('no_pengiriman') }}"
                                            placeholder="No. Penawaran" required>
                                        @error('no_pengiriman')
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
                                        <div id="cont"></div> <!-- the container to add the TABLE -->
                                        <div class="d-grid gap-3">
                                            {{-- <button class="btn btn-primary" type="button" id="addRow">
                                                <i class="fas fa-plus"></i> Add New Row
                                            </button> --}}
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
