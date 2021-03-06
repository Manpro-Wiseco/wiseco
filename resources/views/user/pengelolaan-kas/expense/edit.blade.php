@push('styles')
    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/expense-table-edit.js') }}"></script>
    <script>
        $("#from_account_id").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            theme: 'bootstrap-5',
            ajax: {
                url: `{{ route('pengelolaan-kas.data-account.data-only-cash') }}`,
                dataType: "json",
                data: function(params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function(response) {
                    return {
                        results: response,
                    };
                },
                cache: true,
            },
        });

        $(".data_account").select2({
            placeholder: "- Pilih Salah Satu -",
            allowClear: true,
            // dropdownParent: $(`#container-select-${cell}`),
            theme: "bootstrap-5",
            ajax: {
                url: `${window.url}/pengelolaan-kas/data-account/data`,
                dataType: "json",
                data: function(params) {
                    return {
                        search: params.term,
                    };
                },
                processResults: function(response) {
                    return {
                        results: response,
                    };
                },
                cache: true,
            },
        });
    </script>
@endpush

<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pengelolaan-kas.expense.index') }}"
                                class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Ubah Data Uang Keluar</h4>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('pengelolaan-kas.expense.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Penerima</label>
                                        <select name="data_contact_id" id="data_contact_id"
                                            class="form-control @error('data_contact_id') is-invalid @enderror"
                                            required>
                                            <option>- Pilih Salah Satu -</option>
                                            @foreach ($dataContacts as $contact)
                                                <option value="{{ $contact->id }}"
                                                    @if ($expense->data_contact_id == $contact->id) selected @endif>
                                                    {{ $contact->name }} - {{ $contact->status }}</option>
                                            @endforeach
                                        </select>
                                        <div class="data_contact_id-error">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Dari Akun Kas</label>
                                        <select name="from_account_id" id="from_account_id"
                                            class="form-control @error('from_account_id') is-invalid @enderror"
                                            required>
                                            <option value="{{ $expense->from_account_id }}">
                                                {{ $expense->fromAccount->name }}</option>
                                        </select>
                                        <div class="from_account_id-error">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Invoice</label>
                                        <input type="text" class="form-control @error('invoice') is-invalid @enderror"
                                            id="invoice" name="invoice" value="{{ $expense->invoice }}"
                                            placeholder="Invoice" required>
                                        <div class="invoice-error">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label mt-4">Tanggal Transaksi</label>
                                        <input type="date"
                                            class="form-control @error('transaction_date') is-invalid @enderror"
                                            id="transaction_date" name="transaction_date"
                                            value="{{ $expense->transaction_date }}" required>
                                        <div class="transaction_date-error">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label mt-4">Deskripsi</label>
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description" value="{{ $expense->description }}"
                                            placeholder="Deskripsi" required>
                                        <div class="description-error">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <div id="cont">
                                            <table id="empTable" class="table align-items-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            Dari Akun Bank</td>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            Jumlah</td>
                                                        <td
                                                            class="text-uppercase text-secondary text-xs text-center font-weight-bolder opacity-7">
                                                            #</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($expense->dataAccounts as $key => $dataAccount)
                                                        <tr>
                                                            <td>
                                                                <div class="data_account_container">
                                                                    <select name="data_account_id[][]"
                                                                        id="data_account_id_{{ $key }}"
                                                                        class="form-control data_account @error('data_account_id[]') is-invalid @enderror"
                                                                        required>
                                                                        <option value="{{ $dataAccount->id }}">
                                                                            {{ $dataAccount->name }}</option>
                                                                    </select>
                                                                    @error('data_account_id[]')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="number"
                                                                    class="form-control @error('amount') is-invalid @enderror"
                                                                    id="amount_{{ $key }}" data="amount"
                                                                    name="amount[]"
                                                                    value="{{ $dataAccount->pivot->amount }}"
                                                                    placeholder="Jumlah" required>
                                                                @error('amount')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <input type="button" value="Delete"
                                                                    class="btn bg-gradient-danger btn-small"
                                                                    onclick="removeRow(this)">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- the container to add the TABLE -->
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" type="button" id="addRow">
                                                <i class="fas fa-plus"></i> Add New Row
                                            </button>
                                        </div>


                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="button" id="bt" data-id="{{ $expense->id }}" value="Submit Data"
                                        class="btn bg-gradient-primary" />
                                    {{-- <button type="submit" class="btn bg-gradient-primary">Submit</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-layout>
