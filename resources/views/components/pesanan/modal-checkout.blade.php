<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-checkout" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalCheckoutLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCheckoutLable">Checkout Pesanan Anda.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit="checkout" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="namaPemesan" id="namaPemesan" wire:model="namaPemesan"
                                    class="form-control @error('namaPemesan') is-invalid @enderror" readonly>
                                <label for="namaPemesan">Nama Pemesan</label>
                                @error('namaPemesan')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="noTelpPemesan" id="noTelpPemesan" wire:model="noTelpPemesan"
                                    class="form-control @error('noTelpPemesan') is-invalid @enderror" readonly>
                                <label for="noTelpPemesan">No. Telp Pemesan</label>
                                @error('noTelpPemesan')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="supir" id="supir" wire:model="supir"
                                    class="form-control @error('supir') is-invalid @enderror" readonly>
                                <label for="supir">Supir</label>
                                @error('supir')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="totalHarga" id="totalHarga" wire:model="totalHarga"
                                    class="form-control @error('totalHarga') is-invalid @enderror" readonly>
                                <label for="totalHarga">Total Harga</label>
                                @error('totalHarga')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="jumlahHari" id="jumlahHari" wire:model="jumlahHari"
                                    class="form-control @error('jumlahHari') is-invalid @enderror" readonly>
                                <label for="jumlahHari">Jumlah Hari</label>
                                @error('jumlahHari')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="totalBayar" id="totalBayar" wire:model="totalBayar"
                                    class="form-control @error('totalBayar') is-invalid @enderror" readonly>
                                <label for="totalBayar">Total Bayar</label>
                                @error('totalBayar')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-orange">
                            CHEKOUT PENSANAN
                            <div wire:loading wire:target="checkout" class="ms-3">
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
