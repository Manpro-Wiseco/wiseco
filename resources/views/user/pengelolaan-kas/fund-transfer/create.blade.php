@push('styles')
    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
@endpush
@push('scripts')
    <script>
        $('#fromBank').select2({
            placeholder: "- Pilih Salah Satu -",
            ajax: {
                url: "{{ route('pengelolaan-kas.fund-transfer.fromBank') }}",
                dataType: 'json',
                allowClear: true,
                theme: 'bootstrap-5',
                placeholder: "- Pilih Salah Satu -",
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
                            "text": data.text
                        })
                    })
                    return {
                        results
                    };
                }
            }
        });
        $("#fromBank").change(function(e) {
            e.preventDefault();
            $('#toBank').select2({
                placeholder: "- Pilih Salah Satu -",
                ajax: {
                    url: "{{ route('pengelolaan-kas.fund-transfer.toBank') }}",
                    dataType: 'json',
                    allowClear: true,
                    theme: 'bootstrap-5',
                    placeholder: "- Pilih Salah Satu -",
                    data: function(params) {
                        return {
                            search: params.term,
                            fromBank: $('#fromBank').select2('data')[0].id
                        };
                    },
                    processResults: function(response) {
                        let results = [];
                        response.forEach(data => {
                            results.push({
                                "id": data.id,
                                "text": data.text
                            })
                        })
                        return {
                            results
                        };
                    }
                }
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
                        <div class="d-flex gap-2">
                            <a href="{{ route('pengelolaan-kas.fund-transfer.index') }}"
                                class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Buat Data Transfer Dana</h4>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('pengelolaan-kas.fund-transfer.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Invoice</label>
                                        <input type="text" class="form-control @error('invoice') is-invalid @enderror"
                                            id="invoice" name="invoice" value="{{ old('invoice') }}"
                                            placeholder="Invoice" required autofocus>
                                        @error('invoice')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Deskripsi</label>
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description" value="{{ old('description') }}"
                                            placeholder="Deskripsi" required autofocus>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Dari Bank</label>
                                        <select name="fromBank" id="fromBank"
                                            class="form-control @error('fromBank') is-invalid @enderror" required>
                                            <option>- Pilih Salah Satu -</option>
                                        </select>
                                        @error('fromBank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Ke Bank</label>
                                        <select name="toBank" id="toBank"
                                            class="form-control @error('toBank') is-invalid @enderror" required>
                                            <option>- Pilih Salah Satu -</option>
                                        </select>
                                        @error('toBank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Total</label>
                                        <input type="number" class="form-control @error('total') is-invalid @enderror"
                                            id="total" name="total" value="{{ old('total') }}" placeholder="Total"
                                            required autofocus>
                                        @error('total')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Tanggal Transaksi</label>
                                        <input type="date"
                                            class="form-control @error('transaction_date') is-invalid @enderror"
                                            id="transaction_date" name="transaction_date"
                                            value="{{ old('transaction_date') }}" placeholder="Nomor Telepon"
                                            required>
                                        @error('transaction_date')
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
