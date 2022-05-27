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
                        <form id="edit-data-pengiriman" class="hidden" method="POST">
                            <input type="hidden" name="pengiriman_id" id="pengiriman_id">
                            <input type="hidden" name="penjualan_id" id="penjualan_id">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label class="form-label" for="no_penjaulan">Kode Penjualan</label>
                                    <input type="text" class="form-control" name="no_penjaulan" id="no_penjaulan" readonly>
                                    @error('penjualan_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Kurir</label>
                                    <input type="text" class="form-control @error('kurir') is-invalid @enderror"
                                        id="kurir" name="kurir" value="{{ old('kurir') }}"
                                        placeholder="Nama jasa pengiriman" required>
                                    @error('kurir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <select name="satus" id="status"
                                    class="form-control @error('penjualan_id') is-invalid @enderror"
                                    required>
                                        <option value="PENDING">PENDING</option>
                                        <option value="DIKIRIM">DIKIRIM</option>
                                        <option value="DITERIMA">DITERIMA</option>
                                        <option value="RETUR">RETUR</option>
                                        <option value="BATAL">BATAL</option>
                                        <option value="HILANG">HILANG</option>
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
                                    <label class="form-label mt-4">Tanggal Pengiriman</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_pengiriman') is-invalid @enderror"
                                        id="tanggal_pengiriman" name="tanggal_pengiriman"
                                        value="{{ old('tanggal_pengiriman') }}" placeholder="Nomor Telepon"
                                        required>
                                    @error('tanggal_pengiriman')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label mt-4">No. Pengiriman/Resi</label>
                                    <input type="text" class="form-control @error('no_pengiriman') is-invalid @enderror"
                                        id="no_pengiriman" name="no_pengiriman" value="{{ old('no_pengiriman') }}"
                                        placeholder="No. Penawaran" required readonly>
                                    @error('no_pengiriman')
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
                                        placeholder="Deskripsi" required>
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div id="cont"></div> <!-- the container to add the TABLE -->
                                    <div class="d-grid gap-3">
                                        {{-- <button class="btn btn-primary" type="button" id="addRow">
                                            <i class="fas fa-plus"></i> Add New Row
                                        </button> --}}
                                    </div>


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