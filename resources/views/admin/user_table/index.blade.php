@component('admin.template')
@push('styles')
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        let flashdatasukses = $('.success-session').data('flashdata');
        if (flashdatasukses) {
            Swal.fire({
                icon: 'success'
                , title: 'Success!'
                , text: flashdatasukses
                , type: 'success'
            })
        }
        let flashdatadanger = $('.danger-session').data('flashdata');
        if (flashdatadanger) {
            Swal.fire({
                icon: 'error'
                , title: 'Error!'
                , text: flashdatadanger
                , type: 'error'
            })
        }
        let table = $('#user-table').DataTable({
            fixedHeader: true
            , pageLength: 25
            , processing: true
            , serverSide: true
            , responsive: true
            , ordering: true
            , dom: '<"d-flex justify-content-between"<<"d-none d-sm-block"B>l>f>rtip'
            , buttons: ["copy", "csv", "excel", "pdf", "print"]
            , language: {
                paginate: {
                    previous: "<"
                    , next: ">"
                }
            }
            , ajax: "{{ route('admin.table.list') }}"
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , className: 'align-middle text-center'
                }
                , {
                    data: 'name'
                    , name: 'name'
                    , className: 'align-middle text-center'
                }
                , {
                    data: 'email'
                    , name: 'email'
                    , className: 'align-middle text-center'
                }
                , {
                    data: 'jumlah'
                    , name: 'jumlah'
                    , className: 'align-middle text-center'
                },

            ]
        });

        function reload_table(callback, resetPage = false) {
            table.ajax.reload(callback, resetPage);
        }
    })

</script>

@endpush
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            @if (session('success'))
            <div class="success-session" data-flashdata="{{ session('success') }}"></div>
            @elseif(session('danger'))
            <div class="danger-session" data-flashdata="{{ session('danger') }}"></div>
            @endif
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Daftar Pengguna</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0 border" id="user-table" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nomor</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Jumlah UMKM</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:13px;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endcomponent
