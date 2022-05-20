@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#daftar-pembayaran-utang-table').DataTable({
                fixedHeader: true,
                pageLength: 25,
                responsive: true,
                 language: {
                   paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                ajax: "{{ route('pembelian.daftar-pembayaran-utang.list') }}",
                columns: [
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        className: 'align-middle text-center'
                    },
                    {
                        data: 'no_faktur',
                        name: 'no_faktur',
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
                                <h3>Daftar Utang</h3>
                            </div>
                            <a href="{{ route('pembelian.daftar-pembayaran-utang.create') }}" class="btn bg-gradient-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0" id="daftar-pembayaran-utang-table">
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
        </div>
    </section>
</x-template-layout>
