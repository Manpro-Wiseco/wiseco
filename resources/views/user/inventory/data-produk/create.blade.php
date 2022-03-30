@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

@endpush

@push('scripts')
    <script src="{{ asset('assets/js/table-row.js') }}"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        /* Dengan Rupiah */
        var dengan_rupiah = document.getElementById('dengan-rupiah');
        dengan_rupiah.addEventListener('keyup', function(e)
        {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('inventory.data-produk.index') }}" class="btn bg-gradient-danger">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Input Data Produk</h3>
                        <div class="card-body pt-0">
                            <form action="#" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control @error('namaProduk') is-invalid @enderror"
                                            id="namaProduk" name="namaProduk" value="{{ old('namaProduk') }}"
                                            placeholder="Masukan Nama Produk" required>
                                        @error('namaProduk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Kode Produk</label>
                                        <input type="text"
                                            class="form-control @error('kodeProduk') is-invalid @enderror"
                                            id="kodeProduk" name="kodeProduk" value="{{ old('kodeProduk') }}"
                                            placeholder="Kode Produk" required>
                                        @error('kodeProduk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Kode Produk</label>
                                        <select name="data-satuan" id="data-satuan" class="form-control">
                                            <option>- Pilih Salah Satu -</option>
                                            <option>Box</option>
                                            <option>Kg</option>
                                            <option>Pcs</option>
                                        </select>
                                        @error('kodeProduk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Harga Jual</label>
                                        <div class="input-group input-group-alternative mb-4">
                                          <input class="form-control" id="dengan-rupiah" placeholder="Rp. 00.00" type="text">
                                        </div>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Harga Beli</label>
                                        <div class="input-group input-group-alternative mb-4">
                                            <input class="form-control" id="dengan-rupiah" placeholder="Rp. 00.00" type="text">
                                        </div>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label mt-4">Gambar Produk</label>
                                        <form action="#" method="post" class="dropzone" id="dropzone" enctype="multipart/form-data"></form>
                                        <div class="dz-default dz-message"><h4>Click here to upload images</h4></div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn bg-gradient-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-layout>
