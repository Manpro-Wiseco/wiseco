@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            let flashdatasukses = $('.success-session').data('flashdata');
            if (flashdatasukses) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: flashdatasukses,
                    type: 'success'
                })
            }
            let flashdatadanger = $('.danger-session').data('flashdata');
            if (flashdatadanger) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: flashdatadanger,
                    type: 'error'
                })
            }

            /**
             * * Fungsi untuk Exporting Data tabel ke Excel
             * TODO: Refactor untuk menyesuaikan dengan tabel yang akan ditampilkan
             */
            let table = $('#adjustment-table').DataTable({
                fixedHeader: true,
                pageLength: 25,
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: true,
                dom: '<"d-flex justify-content-between"<<"d-none d-sm-block"B>l>f>rtip',
                buttons: ["copy", "csv", "excel", "pdf", "print"],
                language: {
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                ajax: "{{ route('inventory.penyesuaian-barang.list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'total_barang',
                        name: 'total_barang',
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

            $('#adjustment-table').on('click', '.btn-delete', function(e) {
                let id = $(this).data('id')
                let nama = $(this).data('name')
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah Anda yakin ingin menghapus data penyesuaian barang ?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "{{ url('inventory/penyesuaian-barang') }}/" + id,
                            type: 'POST',
                            data: {
                                _token: CSRF_TOKEN,
                                _method: "delete",
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    `Data penyesuaian barang berhasil terhapus.`,
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
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    @if (session('success'))
                        <div class="success-session" data-flashdata="{{ session('success') }}"></div>
                    @elseif(session('danger'))
                        <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
                    @endif
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('inventory.index') }}" class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Penyesuaian Barang</h4>
                        </div>
                        <a href="{{ route('inventory.penyesuaian-barang.create') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0" id="adjustment-table">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nomor</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Keterangan</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Barang</th>
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
    </section>
</x-template-layout>
