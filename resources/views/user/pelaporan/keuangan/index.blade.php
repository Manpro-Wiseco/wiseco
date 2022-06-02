<x-template-layout>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('laporan.index') }}" class="btn bg-gradient-primary btn-small">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <h4>Laporan Keuangan</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-items-letft mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase text-secondary text-l font-weight-bolder opacity-7">
                                            Kas & Bank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a class="mb-0 text-sm">Jurnal Pengeluaran</a>
                                                </div>
                                            </div>

                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a class="mb-0 text-sm">Jurnal Penerimaan</a>
                                                </div>
                                            </div>

                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a class="mb-0 text-sm">Rekonsiliasi Bank Per Rekening
                                                        Koran</a>
                                                </div>
                                            </div>

                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a class="mb-0 text-sm">Rekonsiliasi Bank Per Buku
                                                        Besar</a>
                                                </div>
                                            </div>

                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a class="mb-0 text-sm">Giro Masuk</a>
                                                </div>
                                            </div>

                                    </tr>
                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a class="mb-0 text-sm">Giro Masuk - Hari Jatuh Tempo</a>
                                                </div>
                                            </div>

                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a class="mb-0 text-sm">Giro Keluar</a>
                                                </div>
                                            </div>

                                    <tr>
                                        <td class="align-middle text-left text-sm">
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a class="mb-0 text-sm">Giro Masuk - Hari Jatuh Tempo</a>
                                                </div>
                                            </div>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
    </section>
</x-template-layout>
