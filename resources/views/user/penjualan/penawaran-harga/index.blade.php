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
            let table = $('#penawaran-harga-table').DataTable({
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
                ajax: "{{ route('penjualan.penawaran-harga.list') }}",
                columns: [
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'no_penawaran',
                        name: 'no_penawaran',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'nama_pelanggan',
                        name: 'nama_pelanggan',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai',
                        className: 'align-middle text-center '
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'align-middle text-center '
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
                                <a href="{{ route('penjualan.index') }}" class="btn bg-gradient-primary btn-small">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <h4>Penawaran Harga</h4>
                            </div>
                            <a href="{{ route('penjualan.penawaran-harga.create') }}" class="btn bg-gradient-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0" id="penawaran-harga-table">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">
                                                Nomor</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Pelanggan</th>
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
    </section>
</x-template-layout>
