{{-- modal --}}
<div wire:ignore.self class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCreateLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLable">Tambah Data Kantor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">

                {{-- form create --}}
                <form wire:submit="save" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            wire:model="nama" name="nama" placeholder="">
                        <label for="nama">Nama Kantor</label>
                        @error('nama')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            wire:model="alamat" name="alamat" placeholder="">
                        <label for="alamat">Alamat Kantor</label>
                        @error('alamat')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('noRek') is-invalid @enderror" id="noRek"
                            wire:model="noRek" name="noRek" placeholder="">
                        <label for="noRek">Nomer Rekening Kantor</label>
                        @error('noRek')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('noTelp') is-invalid @enderror" id="noTelp"
                            wire:model="noTelp" name="noTelp" placeholder="">
                        <label for="noTelp">Nomer Telepon Kantor</label>
                        @error('noTelp')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            SIMPAN DATA
                            <div wire:loading wire:target="save" class="ms-3">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div>
                        </button>
                    </div>
                </form>
                {{-- end form create --}}

            </div>
        </div>
    </div>
</div>
{{-- end modal --}}
