@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

@endpush

@push('scripts')
    <script src="{{ asset('assets/js/table-row.js') }}"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        /* Dengan Rupiah 
        var dengan_rupiah = document.getElementById('dengan-rupiah');
        dengan_rupiah.addEventListener('keyup', function(e)
        {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi
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
                        <a href="{{ route('inventory.stok-opname.index') }}" class="btn bg-gradient-danger">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Tambah Stok Opname</h3>
                        <div class="card-body pt-0">
                            <form action="#" method="post">
                                @csrf
                                <div class="card">
                                    <div class="table-responsive">
                                      <table class="table align-items-center mb-0">
                                        <thead>
                                          <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Pokok Penjualan</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tersedia (Buku)</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tersedia (Fisik)</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selisih</th>
                                          </tr>
                                        </thead>
                                        <tbody>                           
                                          <tr>
                                            <td>
                                              <div class="d-flex px-2 py-1">                                                
                                                <div class="d-flex flex-column justify-content-center">                                                  
                                                  <p class="text-xs text-secondary mb-0">kode</p>
                                                </div>
                                              </div>
                                            </td>
                                            <td>
                                              <p class="text-xs font-weight-bold mb-0">Nama</p>                                              
                                            </td> 
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Rp.30.000</span>
                                              </td>                                       
                                            <td class="align-middle text-center">
                                              <span class="text-secondary text-xs font-weight-bold">121</span>
                                            </td>

                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">111</span>
                                              </td>

                                              <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">10</span>
                                              </td>
                                            
                                          </tr>                                 
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn bg-gradient-success">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-layout>
