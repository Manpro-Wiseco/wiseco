@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#classification-table').DataTable({
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

            function reload_table(callback, resetPage = false) {
                table.ajax.reload(callback, resetPage); //reload datatable ajax 
            }

            $('#btn-create').click(function() {
                $('#save-btn').val("Save Changes");
                $('#subclassification-form').trigger("reset");
                $('#exampleModalLabel').html("Buat Subklasifikasi");
                $('#classification_id').val($(this).data('classification'));
                $("#type").val("create");
                $('#exampleModal').modal('show');
            });

            $('body').on('click', '.btn-edit', function() {
                let id = $(this).data('id');
                $.get("{{ url('subclassification') }}/" + id, function(data) {
                    $('#exampleModalLabel').html("Edit Subklasifikasi");
                    $('#save-btn').val("Save Changes");
                    $('#exampleModal').modal('show');
                    $("#type").val("update");
                    $('#name').val(data.name);
                    $('#code').val(data.code);
                    $('#classification_id').val(data.classification_id);
                    $('#id').val(data.id);
                })
            });

            $('#save-btn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                $.ajax({
                    data: $('#subclassification-form').serialize(),
                    url: "{{ route('subclassification.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Success!',
                                `${response.message}`,
                                'success'
                            )
                            $('#subclassification-form').trigger("reset");
                            $('#exampleModal').modal('hide');
                            reload_table();
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Error saat memasukkan data',
                            showConfirmButton: true
                        })
                    }
                });
            });

            $('#classification-table').on('click', '.btn-delete', function(e) {
                let id = $(this).data('id')
                let name = $(this).data('name')
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah Anda yakin ingin menghapus subklasifikasi dengan nama ${name}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "{{ url('subclassification') }}/" + id,
                            type: 'POST',
                            data: {
                                _method: "delete",
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        `Subklasifikasi ${name} berhasil terhapus.`,
                                        'success'
                                    )
                                    reload_table(null, true)
                                }
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

@push('modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="subclassification-form">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="classification_id" id="classification_id">
                    <input type="hidden" name="type" id="type">
                    <div class="modal-body">
                        <label>Nama</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nama" aria-label="Nama" name="name"
                                id="name">
                        </div>
                        <label>Kode</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Code" aria-label="Code" name="code"
                                id="code">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" id="save-btn" value="" class="btn bg-gradient-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-2">
                                <a href="{{ route('classification.index') }}"
                                    class="btn bg-gradient-primary btn-small">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <h4>Data Sublasifikasi</h4>
                            </div>
                            <button type="button" class="btn bg-gradient-primary btn-small" id="btn-create"
                                data-classification="{{ $classification->id }}">
                                <i class="fas fa-plus-square"></i>
                            </button>
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
