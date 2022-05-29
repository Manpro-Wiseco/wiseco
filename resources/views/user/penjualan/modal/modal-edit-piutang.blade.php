<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Rincian Piutang</h5>
                <div class="spinner-border text-primary hidden spinner-load" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-body">
                        <div id="loader" class="lds-dual-ring overlay hidden"></div>
                        <form id="create-data-piutang" action="" method="POST">
                            <div class="row">
                                <input type="hidden" class="form-control" id="piutang_id">
                                <div class="col-md-4">
                                    <label class="form-label">Kode Penjualan</label>
                                    <input readonly type="text" class="form-control @error('kode_penjualan') is-invalid @enderror" name="kode_penjualan" id="kode_penjualan">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Beban Pembayaran</label>
                                    <input readonly type="text" class="form-control @error('sisa_piutang') is-invalid @enderror"
                                        id="sisa_piutang" name="sisa_piutang" value="{{ old('sisa_piutang') }}"
                                        placeholder="Beban Pembayaran" required readonly>
                                    @error('sisa_piutang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label mt-4">Kode Piutang</label>
                                    <input readonly type="text" class="form-control @error('no_piutang') is-invalid @enderror"
                                        id="no_piutang" name="no_piutang" value="{{ old('no_piutang') }}"
                                        placeholder="No. Penawaran" required readonly>
                                    @error('no_piutang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label mt-4">Tanggal Awal Kredit</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_awal_kredit') is-invalid @enderror"
                                        id="tanggal_awal_kredit" name="tanggal_awal_kredit"
                                        value="{{ old('tanggal_awal_kredit') }}"
                                        required>
                                    @error('tanggal_awal_kredit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label mt-4">Lama Kredit (Bulan)</label>
                                    <input  type="number" class="form-control @error('tenor') is-invalid @enderror"
                                        id="tenor" name="tenor" value="{{ old('tenor') }}"
                                        required value="0">
                                    @error('tenor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-3 ">
                                    <label class="form-label mt-4">Status</label>
                                    <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror"
                                    required>
                                        <option value="PENDING" selected>PENDING</option>
                                        <option value="BELUM LUNAS">BELUM LUNAS</option>
                                        <option value="LUNAS">LUNAS</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             
                            </div>
                            
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label mt-4">Jumlah Bayaran Bulanan</label>
                                    <p id="total-beban">Rp. 0.-</p>
                                    <input readonly 
                                        type="hidden"
                                        class="form-control @error('beban_pembayaran') is-invalid @enderror"
                                        id="beban_pembayaran" name="beban_pembayaran" value="{{ old('beban_pembayaran') }}" 
                                         required value="0">
                                    @error('beban_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <input type="submit" id="submit-edit" value="Submit Data" class="btn bg-gradient-primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>