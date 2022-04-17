<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pengelolaan-kas.income.index') }}"
                                class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Detail Data Uang Masuk</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="col-lg-10 col-md-12 mx-auto">
                                <form class="" action="index.html" method="post">
                                    <div class="card my-sm-5">
                                        <div class="card-header text-center">
                                            <div class="row justify-content-between">
                                                <div class="col-md-4 text-start">
                                                    <h3>
                                                        {{ $company->name }}
                                                    </h3>
                                                    <h6>{{ $company->address . ', ' . $company->province . ', ' . $company->city }}
                                                    </h6>
                                                    <p class="d-block text-secondary">Telepon: {{ $company->phone }}
                                                    </p>
                                                </div>
                                                <div class="col-lg-3 col-md-7 text-md-end text-start">
                                                    <h6 class="d-block mb-0">Kepada : <br>
                                                        {{ $income->dataContact->name }}</h6>
                                                    <p class="">{{ $income->dataContact->address }}
                                                    </p>
                                                    <p class="d-block text-secondary">Telepon:
                                                        {{ $income->dataContact->phone }}
                                                    </p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row justify-content-md-between">
                                                <div class="col-md-4 mt-auto">
                                                    <h6 class="mb-0 text-start text-secondary">
                                                        Invoice no
                                                    </h6>
                                                    <h5 class="text-start mb-0">
                                                        {{ $income->invoice }}
                                                    </h5>
                                                </div>
                                                <div class="col-lg-5 col-md-7 mt-auto">
                                                    <div class="row mt-md-5 mt-4 text-md-end text-start">
                                                        <div class="col-md-6">
                                                            <h6 class="text-secondary mb-0">Transaksi:</h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="text-dark mb-0">
                                                                {{ \Carbon\Carbon::parse($income->transaction_date)->format('d F Y') }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="row text-md-end text-start">
                                                        <div class="col-md-6">
                                                            <h6 class="text-secondary mb-0">Dibuat:</h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="text-dark mb-0">
                                                                {{ \Carbon\Carbon::parse($income->created_at)->format('d F Y h:i:s') }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table text-right">
                                                            <thead class="bg-default">
                                                                <tr>
                                                                    <th scope="col" class="pe-2 text-start ps-2">Ke
                                                                        Akun
                                                                    </th>
                                                                    <th scope="col" class="pe-2">Jumlah</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($income->dataAccounts as $account)
                                                                    <tr>
                                                                        <td class="text-start">
                                                                            {{ $account->name }}</td>
                                                                        <td class="ps-4">
                                                                            {{ 'Rp ' . number_format($account->pivot->amount, 2, ',', '.') }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th class="h5 ps-4">Total</th>
                                                                    <th colspan="1" class="text-right h5 ps-4">
                                                                        {{ 'Rp ' . number_format($income->total, 2, ',', '.') }}
                                                                    </th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer mt-2">
                                            <div class="row">
                                                <button class="btn bg-gradient-info mb-0" onclick="window.print()"
                                                    type="button" name="button">Print</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-template-layout>
