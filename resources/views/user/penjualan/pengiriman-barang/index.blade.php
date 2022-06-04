@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/spinner.css') }}">
@endpush

@push('scripts')
    <script>
        let table;
        $(document).ready(function() {
            table = $('#pengiriman-barang-table').DataTable({
                fixedHeader: true,
                pageLength: 25,
                responsive: true,
                 language: {
                   paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                ajax: "{{ route('penjualan.pengiriman-barang.list') }}",
                columns: [
                    {
                        data: 'tanggal_pengiriman',
                        name: 'tanggal',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'invoice',
                        name: 'Nomer Penjualan',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'nama_pelanggan',
                        name: 'Nama Pelanggan',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'no_pengiriman',
                        name: 'RESI',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'kurir',
                        name: 'Kurir',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'align-middle text-center'
                    },

                ]
            });
        });

        //Edit modal window
        $('body').on('click', '#editPengiriman', function (event) {
            event.preventDefault();
            var id = $(this).data('id');
            $('#modal-id').modal('show');
            $('#loader').removeClass('hidden')
            $('#edit-data-pengiriman').addClass('hidden')
            
            setTimeout(function() {
                $.ajax({
                    type: "GET",
                    url: `${window.url}/penjualan/pengiriman-barang/get-data/${id}`,
                    dataType: 'json',
                    beforeSend: function() {
                    },
                    success: function(data){
                        // console.log(data);
                        $('#no_penjaulan').val(data.penjualan.no_penjualan);
                        $('#tanggal_pengiriman').val(data.tanggal_pengiriman);
                        $('#no_pengiriman').val(data.no_pengiriman);
                        $('#deskripsi').val(data.deskripsi);
                        $('#pengiriman_id').val(id);
                        $('#kurir').val(data.kurir);
                        $('#status').val(data.status);
                        $('#penjualan_id').val(data.penjualan_id);
                    },
                    complete: function(){
                        $('#loader').addClass('hidden')
                        $('#edit-data-pengiriman').removeClass('hidden')
                    },
                });
            }, 1500);

        });

        //Save data into database
        $('body').on('click', '#submit', function (event) {
            event.preventDefault()
            var id = $("#pengiriman_id").val();
            var kurir = $("#kurir").val();
            var status = $("#status").val();
            var tanggal = $("#tanggal_pengiriman").val();
            var deskripsi = $("#deskripsi").val();
            var penjualan = $("#penjualan_id").val();
            var token = $('meta[name="csrf-token"]').attr('content');
            
            $.ajax({
                type: "POST",
                url: `${window.url}/penjualan/pengiriman-barang/update/${id}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    kurir: kurir,
                    tanggal_pengiriman: tanggal,
                    deskripsi: deskripsi,
                    status: status,
                    penjualan_id: penjualan,
                },
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    // $('#companydata').trigger("reset");
                    // $('#modal-id').modal('hide');
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Sukses',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#modal-id').modal('hide');
                    table.ajax.reload();
                },
                error: function (data) {
                    console.log($data);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Gagal',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        });
    </script>
@endpush

@push('modals')
    @include('user.penjualan.modal.modal')
@endpush

<x-template-layout>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h3>Pengiriman Barang</h3>
                            <a href="{{ route('penjualan.pengiriman-barang.create') }}" class="btn bg-gradient-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0" id="pengiriman-barang-table">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">
                                                Nomor Penjualan</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Pelanggan</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                RESI</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Deskripsi</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kurir</th>    
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-layout>
