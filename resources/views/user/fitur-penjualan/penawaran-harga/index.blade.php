@push('styles')
@endpush

@push('scripts')
    <script>
    //    $(document).ready(function() {
      //      let table = $('#data-bank-table').DataTable({
        //        fixedHeader: true,
          //      pageLength: 25,
            //    responsive: true,
              //   language: {
                //   paginate: {
                  //      previous: "<",
                    //    next: ">"
                   // }
                //},
                //ajax: "{{ route('data-bank.list') }}",
                //columns: [{
                  //      data: 'DT_RowIndex',
                  //      name: 'DT_RowIndex'
                   // },
                   // {
                   //     data: 'name',
                   //     name: 'name'
                   // },
                   // {
                   //     data: 'code',
                   //    name: 'code'
                   // },
                   // {
                   //     data: 'action',
                   //     name: 'action',
                   //     orderable: false,
                   //     searchable: false,
                   //     className: 'align-middle text-center'
                   // },
               // ]
          //  });
      //  })
   // </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h3>Penawaran Harga</h3>
                            <a href="#" class="btn bg-gradient-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0" id="data-bank-table">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">
                                                No. Penawaran</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Customer</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Deskripsi</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Value</th>
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
