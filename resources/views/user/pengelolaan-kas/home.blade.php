<x-template-layout>
    <section class="content">
        <div class="row">
            <div class="col-md-4 mb-5">
                <a href="{{ route('pengelolaan-kas.expense.index') }}">
                    <div class="card bg-gradient-success">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Pengelolaan Pengeluaran</h4>
                                <i class="text-white fas fa-money-bill fa-5x my-3"></i>
                                <p class="text-white">
                                    Anda dapat melakukan pengelolaan pengeluaran pada usaha.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="#">
                    <div class="card bg-gradient-info">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Pengelolaan Pemasukan</h4>
                                <i class="text-white fas fa-wallet fa-5x my-3"></i>
                                <p class="text-white">
                                    Anda dapat melakukan pengelolaan pemasukan pada usaha.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-5">
                <a href="#">
                    <div class="card bg-gradient-secondary">
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
                <a href="#">
                    <div class="card bg-gradient-warning">
                        <div class="card-body p-3">
                            <div class="text-center">
                                <h4 class="text-white text-capitalize font-weight-bold">
                                    Pengelolaan Uang Bisnis & Pribadi</h4>
                                <i class="text-white fas fa-briefcase fa-5x my-3"></i>
                                <p class="text-white">
                                    Anda dapat melakukan pengelolaan pengeluaran uang bisnis dan pribadi.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-template-layout>
