<div class="modal fade" id="modal-id" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body p-0">
                <div class="card card-plain">
                    {{-- <div class="card-header pb-0 text-left">
                        <h3 class="font-weight-bolder text-info text-gradient">Create Company</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                    <div class="card-body">
                        <div id="loader" class="lds-dual-ring overlay hidden"></div>
                        <form id="edit-data-retur" class="hidden" method="POST">
                            <input type="hidden" name="retur_id" id="retur_id">
                            <input type="hidden" name="penjualan_id" id="penjualan_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Kode Penjualan</label>
                                    <input readonly type="text" class="form-control @error('no_penjualan') is-invalid @enderror" name="no_penjualan" id="no_penjualan">
                                    @error('no_penjualan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="satus" id="status"
                                    class="form-control @error('penjualan_id') is-invalid @enderror"
                                    required>
                                        <option value="PENDING">PENDING</option>
                                        <option value="DIPROSES">DIPROSES</option>
                                        <option value="DIKIRIM">DIKIRIM</option>
                                        <option value="DITERIMA">DITERIMA</option>
                                        <option value="DITOLAK">DITOLAK</option>
                                    </select>
                                    @error('kurir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label mt-4">Tanggal Retur Barang</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_retur') is-invalid @enderror"
                                        id="tanggal_retur" name="tanggal_retur"
                                        value="{{ old('tanggal_retur') }}"
                                        required>
                                    @error('tanggal_retur')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label mt-4">No. Retur</label>
                                    <input readonly type="text" class="form-control @error('no_retur') is-invalid @enderror"
                                        id="no_retur" name="no_retur" value="{{ old('no_retur') }}"
                                        placeholder="No. Penawaran" required readonly>
                                    @error('no_retur')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label mt-4">Deskripsi</label>
                                    <input type="text"
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}"
                                        placeholder="deskripsi" required>
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <input type="submit" id="submit" value="Submit Data" class="btn bg-gradient-primary" />
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>