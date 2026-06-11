<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-pengembalian" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalPengembalianLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPengembalianLable">Pengembalian Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="pengembalian" method="post">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" name="namaPemesan" id="namaPemesan" wire:model="namaPemesan"
                            class="form-control @error('namaPemesan') is-invalid @enderror" readonly>
                        <label for="namaPemesan">Nama Pemesan</label>
                        @error('namaPemesan')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="namaMobil" id="namaMobil" wire:model="namaMobil"
                                    class="form-control @error('namaMobil') is-invalid @enderror" readonly>
                                <label for="namaMobil">Mobil</label>
                                @error('namaMobil')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="jenisMobil" id="jenisMobil" wire:model="jenisMobil"
                                    class="form-control @error('jenisMobil') is-invalid @enderror" readonly>
                                <label for="jenisMobil">Jenis Mobil</label>
                                @error('jenisMobil')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="merekMobil" id="merekMobil" wire:model="merekMobil"
                                    class="form-control @error('merekMobil') is-invalid @enderror" readonly>
                                <label for="merekMobil">Merek Mobil</label>
                                @error('merekMobil')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" name="tanggalPengembalian" id="tanggalPengembalian"
                            wire:model="tanggalPengembalian"
                            class="form-control @error('tanggalPengembalian') is-invalid @enderror">
                        <label for="tanggalPengembalian">Tanggal Pengembalian</label>
                        @error('tanggalPengembalian')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" name="tanggalKembali" id="tanggalKembali" wire:model="tanggalKembali"
                            class="form-control @error('tanggalKembali') is-invalid @enderror">
                        <label for="tanggalKembali">Tanggal Kembali</label>
                        @error('tanggalKembali')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-orange">
                            SIMPAN DATA
                            <div wire:loading wire:target="pengembalian" class="ms-3">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
