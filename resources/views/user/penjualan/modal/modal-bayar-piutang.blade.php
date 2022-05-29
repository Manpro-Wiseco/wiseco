<div class="modal fade" id="modal-bayar" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bayar Piutang</h4>
                <div class="spinner-border text-primary hidden spinner-load" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
              </div>
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 box-informasi">
                                    <h5>Riwayat Pembayaran</h5>
                                        <div class="mt-3 row">
                                            <div class="col">
                                                <p >Kode Penjualan : <span id="kode_penjualan"></span> </p>
                                                <p >Nama Pelanggan : <span id="nama_pelanggan"></span> </p>

                                            </div>
                                            <div class="col">
                                                <p >Tanggal Akhir Kredit : <span id="tak"></span> </p>
                                                <p >Beban Tagihan (Bulanan): <span id="bt-tagihan"></span> </p>
                                            </div>
                                        </div>
                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center mb-0" id="history-pembayaran">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tanggal</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">
                                                        Jumlah Pembayaran</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Sisa Tagihan</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Jenis Pembayaran</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Status</th>
                                                    <th class="text-secondary opacity-7"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Tambah Pembayaran</h5>
                                    <form id="edit-data-retur" method="POST">
                                        <input type="hidden" name="piutang_id" id="piutang_id">
                                        <input type="hidden" name="sisa_piutang" id="sisa_piutang">
                                        <div class="form-group">
                                            <label class="form-label mt-4">Tanggal Pembayaran</label>
                                            <input type="date"
                                                class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                                id="tanggal_pembayaran" name="tanggal_pembayaran"
                                                value="{{ old('tanggal_pembayaran') }}"
                                                required>
                                            @error('tanggal_pembayaran')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="total_pembayaran">Total Pembayaran</label>
                                            <input type="number" class="form-control" id="total_pembayaran" placeholder="Rp." name='total_pembayaran'>
                                        </div>
                                        <div class="form-group">
                                            <label for="pembayaran">Jenis Pembayaran</label>
                                            <select class="form-control mb-2" id="data_bank_id" name="data_bank_id">
                                                <option>Pilih Jenis Pembayaran</option>
                                                @foreach ($banks as $b)
                                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                        <div class="mt-4">
                                            <input type="submit" id="submit-bayar" value="Submit Data" class="btn bg-gradient-primary" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>