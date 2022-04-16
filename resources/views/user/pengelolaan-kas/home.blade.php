<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-md-4 mb-5">
                <a href="{{ route('pengelolaan-kas.expense.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Uang Keluar</h4>
                                <i class="text-white fas fa-money-bill fa-5x my-3"></i>
                                <p class="text-white">
                                    Anda dapat melakukan pengelolaan pengeluaran atau uang keluar pada usaha.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="{{ route('pengelolaan-kas.income.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Uang Masuk</h4>
                                <i class="text-white fas fa-wallet fa-5x my-3"></i>
                                <p class="text-white">
                                    Anda dapat melakukan pengelolaan pemasukan atau uang masuk pada usaha.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="{{ route('pengelolaan-kas.fund-transfer.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Transfer Dana</h4>
                                <i class="text-white fas fa-money-check-alt fa-5x my-3"></i>
                                <p class="text-white">
                                    Anda dapat melakukan pengelolaan transfer dana dari akun bank yang Anda miliki.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="{{ route('pengelolaan-kas.data-account.index') }}">
                    <div class="card bg-gradient-primary">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Data Akun</h4>
                                <i class="text-white fas fa-briefcase fa-5x my-3"></i>
                                <p class="text-white">
                                    Anda dapat melakukan pengelolaan data akun.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-template-layout>
