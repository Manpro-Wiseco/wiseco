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
        let table = $('#ticket-table').DataTable({
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
            , ajax: "{{ route('admin.ticket.list') }}"
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , className: 'align-middle text-center'
                }
                , {
                    data: 'time'
                    , name: 'time'
                    , className: 'align-middle text-center'
                    , type: 'datetime'
                    , displayFormat: 'M/D/YYYY'
                    , keyInput: false
                }
                , {
                    data: 'category'
                    , name: 'category'
                    , className: 'align-middle text-center'
                }
                , {
                    data: 'status'
                    , name: 'status'
                    , className: 'align-middle text-center'
                }
                , {
                    data: 'name'
                    , name: 'name'
                    , className: 'align-middle text-center'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                    , className: 'align-middle text-center'
                },

            ]
        });

        function reload_table(callback, resetPage = false) {
            table.ajax.reload(callback, resetPage);
        }

        $('#ticket-table').on('click', '.btn-delete', function(e) {
            let id = $(this).data('id')
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Yakin?'
                , text: `Apakah Anda yakin ingin menghapus data tiket`
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ url('admin/ticket') }}/" + id
                        , type: 'POST'
                        , data: {
                            _token: CSRF_TOKEN
                            , _method: "DELETE"
                        , }
                        , dataType: 'JSON'
                        , success: function(response) {
                            Swal.fire(
                                'Deleted!'
                                , `Data berhasil dihapus.`
                                , 'success'
                            )
                            reload_table(null, true)
                        }
                        , error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error'
                                , type: 'error'
                                , title: 'Error saat delete data'
                                , showConfirmButton: true
                            })
                        }
                    })
                }
            })
        })
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
                <h4>Daftar Tiket</h4>
                <a href="{{ route('admin.ticket.create') }}" class="btn bg-gradient-primary">
                    <i class="fas fa-plus-square"></i>
                </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0 border" id="ticket-table" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nomor</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tanggal Pembaruan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Kategori</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Pelapor</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                                <th class="text-secondary opacity-7"></th>
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
