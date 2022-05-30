@push('styles')
<style>
    .hidden{
        display: none;
    }

    .box-informasi p{
        font-size: 0.8rem;
    }

    .box-informasi p span{
        font-weight: bold;
    }
</style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/moment-min.js') }}"></script>
    <script>
        let table;
        $(document).ready(function() {
            setTimeout(function() {
                table = $('#piutang-table').DataTable({
                    fixedHeader: true,
                    pageLength: 25,
                    responsive: true,
                        language: {
                        paginate: {
                            previous: "<",
                            next: ">"
                        }
                    },
                    ajax: "{{ route('penjualan.daftar-piutang.list') }}",
                    columns: [
                        {
                            data: 'tanggal_akhir_kredit',
                            name: 'tanggal',
                            className: 'align-middle text-center'
                        },
                        {
                            data: 'no_piutang',
                            name: 'kode piutang',
                            className: 'align-middle text-center'
                        },
                        {
                            data: 'nama_pelanggan',
                            name: 'nama_pelanggan',
                            className: 'align-middle text-center'
                        },
                        {
                            data: 'beban_pembayaran',
                            name: 'beban_pembayaran',
                            className: 'align-middle text-center'
                        },
                        {
                            data: 'sisa_piutang',
                            name: 'sisa_piutang',
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
            }, 500);
        });
    </script>
    <script src="{{ asset('assets/js/piutang-data.js') }}"></script>
@endpush

@push('modals')
    @include('user.penjualan.modal.modal-bayar-piutang')
    @include('user.penjualan.modal.modal-edit-piutang')
@endpush


<x-template-layout>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <div class="d-flex gap-2">
                                <a href="{{ route('penjualan.index') }}" class="btn bg-gradient-primary btn-small">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <h3>Daftar Piutang</h3>
                            </div>
                            <a href="{{ route('penjualan.daftar-piutang.create') }}"  class="btn bg-gradient-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0" id="piutang-table">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal Akhir Kredit</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">
                                                Kode Kredit</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Pelanggan</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Beban Bulanan</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Sisa Piutang</th>    
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
