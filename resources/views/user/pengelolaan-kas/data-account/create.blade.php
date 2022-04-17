@push('scripts')
    <script>
        $("#subclassification_id").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            theme: 'bootstrap-5',
            ajax: {
                url: `{{ route('subclassification.data') }}`,
                dataType: "json",
                data: function(params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function(response) {
                    let results = [];
                    response.forEach(data => {
                        results.push({
                            "id": data.id,
                            "text": `${data.name} - ${data.code}`
                        })
                    })
                    return {
                        results
                    };
                },
                cache: true,
            },
        });
        $("#data_bank_id").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            theme: 'bootstrap-5',
            ajax: {
                url: `{{ route('data-bank.data') }}`,
                dataType: "json",
                data: function(params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function(response) {
                    let results = [];
                    response.forEach(data => {
                        results.push({
                            "id": data.id,
                            "text": `${data.name} - ${data.code}`
                        })
                    })
                    return {
                        results
                    };
                },
                cache: true,
            },
        });
        $(document).on('change', '#is_cash', function() {
            let isChecked = $(this).is(':checked')
            if (isChecked) {
                console.log("Checked");
                $("#data_bank_id").prop("disabled", false);
            } else {
                console.log("Not Checked")
                $('#data_bank_id').val(null).trigger('change');
                $("#data_bank_id").prop("disabled", true);
            }
        })
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pengelolaan-kas.data-account.index') }}"
                                class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Buat Data Akun</h4>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('pengelolaan-kas.data-account.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" placeholder="Name"
                                            required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Subklasifikasi</label>
                                        <select name="subclassification_id" id="subclassification_id"
                                            class="form-control @error('subclassification_id') is-invalid @enderror"
                                            required>
                                            <option>- Pilih Salah Satu -</option>
                                        </select>
                                        @error('subclassification_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Vendor</label>
                                        <select name="data_bank_id" id="data_bank_id"
                                            class="form-control @error('data_bank_id') is-invalid @enderror" required>
                                            <option>- Pilih Salah Satu -</option>
                                        </select>
                                        @error('data_bank_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="mt-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_cash"
                                                    name="is_cash" checked>
                                                <label class="form-check-label" for="">Kas/Bank</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Status</label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror" required>
                                            <option>- Pilih Salah Satu -</option>
                                            <option value="1">Bisnis</option>
                                            <option value="0">Pribadi</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-4">

                                    <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-layout>
