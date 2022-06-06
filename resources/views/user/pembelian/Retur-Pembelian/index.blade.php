@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#retur-pembelian-table').DataTable({
                fixedHeader: true,
                pageLength: 25,
                responsive: true,
                language: {
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                ajax: "{{ route('pembelian.retur-pembelian.list') }}",
                columns: [{
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'no_pesanan',
                        name: 'no_pesanan',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'data_contact.name',
                        name: 'data_contact.name',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'total',
                        name: 'total',
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

            function reload_table(callback, resetPage = false) {
                table.ajax.reload(callback, resetPage); //reload datatable ajax 
            }

            $('#retur-pembelian-table').on('click', '.btn-delete', function(e) {
                let id = $(this).data('id')
                let no_pesanan = $(this).data('no_pesanan')
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah Anda yakin ingin menghapus data pembelian dengan no_pesanan ${no_pesanan}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "{{ url('pembelian/retur-pembelian') }}/" + id,
                            type: 'POST',
                            data: {
                                _token: CSRF_TOKEN,
                                _method: "delete",
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    `Data retur pembelian dengan no_pesanan ${no_pesanan} berhasil terhapus.`,
                                    'success'
                                )
                                reload_table(null, true)
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Swal.fire({
                                    icon: 'error',
                                    type: 'error',
                                    title: 'Error saat delete data',
                                    showConfirmButton: true
                                })
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <div class="d-flex gap-2">
                                <a href="{{ route('pembelian.index') }}" class="btn bg-gradient-primary btn-small">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <h3>Retur Pembelian</h3>
                            </div>
                            <a href="{{ route('pembelian.retur-pembelian.create') }}"
                                class="btn bg-gradient-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0" id="retur-pembelian-table">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">
                                                No Pesanan</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Pemasok</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Deskripsi</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nilai</th>
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
