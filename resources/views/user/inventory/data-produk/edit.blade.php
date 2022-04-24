@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script scr="{{ asset('assets/js/dropzone-items.js') }}"></script> --}}
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        var nameString = document.getElementById('nameItem');
        nameString.addEventListener('change', function(e) {
            var target = document.getElementById('codeItem');
            var result = getInitials(nameString.value) + '-';
            target.value = result;
        });

        function getInitials(name) {
            var names = name.split(' '),
                initials = names[0].substring(0, 1).toUpperCase();
            if (names.length > 1) {
                initials += names[names.length - 1].substring(0, 1).toUpperCase();
            }
            return initials;
        }

        // /* Dengan Rupiah */
        // var dengan_rupiah = document.getElementById('priceItem2');
        // dengan_rupiah.addEventListener('keyup', function(e)
        // {
        //     dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        // });
        // var dengan_rupiah2 = document.getElementById('costItem2');
        // dengan_rupiah2.addEventListener('keyup', function(e)
        // {
        //     dengan_rupiah2.value = formatRupiah(this.value, 'Rp. ');
        // });

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

    <script>
        Dropzone.options.dropzone = {
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            maxFilesize: 2,
            addRemoveLinks: true,
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
                });
            }
        };
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('inventory.data-produk.index') }}"
                                class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Edit Data Produk</h4>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('inventory.data-produk.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control @error('nameItem') is-invalid @enderror"
                                            id="nameItem" name="nameItem" value="{{ old('nameItem')?? $dataProduk->nameItem }}"
                                            placeholder="Masukan Nama Produk" required>
                                        @error('nameItem')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Kode Produk</label>
                                        <input type="text"
                                            class="form-control read-only @error('codeItem') is-invalid @enderror"
                                            id="codeItem" name="codeItem" value="{{ old('codeItem') }}"
                                            placeholder="Kode Produk" required>
                                        @error('codeItem')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Unit Produk</label>
                                        <select name="unitItem" id="unitItem" class="form-control">
                                            <option>- Pilih Salah Satu -</option>
                                            <option value="Box">Box</option>
                                            <option value="Kg">Kg</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Cup">Cup</option>
                                            <option value="Unit">Unit</option>
                                        </select>
                                        @error('unitItem')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label mt-4">Deskripsi</label>
                                        <input type="text"
                                            class="form-control @error('descriptionItem') is-invalid @enderror"
                                            id="descriptionItem" name="descriptionItem" value="{{ old('descriptionItem') }}"
                                            placeholder="Deskripsi" required>
                                        @error('descriptionItem')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Harga Jual</label>
                                        <div class="input-group input-group-alternative mb-4" @error('priceItem') is-invalid @enderror>
                                            <input class="form-control" id="priceItem" name="priceItem" placeholder="Rp. 00.00" type="text" >
                                        </div>
                                        @error('priceItem')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Harga Beli</label>
                                        <div class="input-group input-group-alternative mb-4" @error('costItem') is-invalid @enderror>
                                            <input class="form-control" id="costItem" name="costItem" placeholder="Rp. 00.00" type="text" >
                                        </div>
                                        @error('costItem')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="mt-4">
                                    <input type="submit" id="bt" value="Submit Data" class="btn bg-gradient-primary" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</x-template-layout>
