@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#classification-table').DataTable({
                fixedHeader: true,
                pageLength: 25,
                responsive: true,
                processing: true,
                serverSide: true,
                language: {
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                ajax: "{{ route('subclassification.list', $classification->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code',
                        className: 'text-center'
                    },
                    {
                        data: 'count_account',
                        name: 'count_account',
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center'
                    },
                ]
            });
        })
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h3>Data Subklasifikasi</h3>
                            <a href="{{ route('classification.create') }}" class="btn bg-gradient-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="row">
                            <p>Klasifikasi : {{ $classification->name }}</p>
                            <p>Kode Klasifikasi : {{ $classification->code }}</p>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">

                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0" id="classification-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Klasifikasi</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Code</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Akun</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
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
