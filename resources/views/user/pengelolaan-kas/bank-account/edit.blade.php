@push('scripts')
    <script>
        $('#subclassification_id').select2({
            placeholder: "- Pilih Salah Satu -",
            ajax: {
                url: "{{ route('subclassification.data') }}",
                dataType: 'json',
                theme: "bootstrap-5",
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(response) {
                    let results = [];
                    response.forEach(data => {
                        results.push({
                            "id": data.id,
                            "text": data.name
                        })
                    })
                    return {
                        results
                    };
                },
                cache: true
            }
        });
        $('#data_bank_id').select2({
            placeholder: "- Pilih Salah Satu -",
            ajax: {
                url: "{{ route('data-bank.data') }}",
                dataType: 'json',
                theme: "bootstrap-5",
                data: function(params) {
                    return {
                        search: params.term
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
                cache: true
            }
        });
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <a href="{{ route('pengelolaan-kas.bank-account.index') }}" class="btn bg-gradient-primary">
                            <i class="fas fa-angle-left" style="font-size: 20px"></i>
                        </a>
                        <h3>Buat Data Akun Bank</h3>
                        <div class="card-body pt-0">
                            <form action="{{ route('pengelolaan-kas.bank-account.update', $bankAccount->id) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') ?? $bankAccount->name }}"
                                            placeholder="Name" required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Klasifikasi</label>
                                        <select name="subclassification_id" id="subclassification_id"
                                            class="form-control @error('subclassification_id') is-invalid @enderror"
                                            required>
                                            <option value="{{ $bankAccount->subclassification->id }}" selected>
                                                {{ $bankAccount->subclassification->name }}</option>
                                        </select>
                                        @error('subclassification_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Vendor</label>
                                        <select name="data_bank_id" id="data_bank_id"
                                            class="form-control @error('data_bank_id') is-invalid @enderror" required>
                                            <option value="{{ $bankAccount->dataBank->id }}" selected>
                                                {{ $bankAccount->dataBank->name . '-' . $bankAccount->dataBank->code }}
                                            </option>
                                        </select>
                                        @error('data_bank_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Status</label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror" required>
                                            <option>- Pilih Salah Satu -</option>
                                            <option value="1" @if ($bankAccount->status == 1) selected @endif>Aktif
                                            </option>
                                            <option value="0" @if ($bankAccount->status == 0) selected @endif>Tidak
                                                Aktif</option>
                                        </select>
                                        @error('phone')
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
