{{-- modal --}}
<div wire:ignore.self class="modal modal-lg fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalCreateLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLable">Tambah Data Supir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">

                {{-- form create --}}
                <form wire:submit="save" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" wire:model="nama" name="nama" placeholder="">
                                <label for="nama">Nama Supir</label>
                                @error('nama')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('noKtp') is-invalid @enderror"
                                    id="noKtp" wire:model="noKtp" name="noKtp" placeholder="">
                                <label for="noKtp">No KTP</label>
                                @error('noKtp')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="jenisKelamin" id="jenisKelamin"
                                    class="form-control @error('jenisKelamin') is-invalid @enderror"
                                    wire:model="jenisKelamin">
                                    <option value="">--- Jenis Kelamin---</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <label for="JenisKelamin">Jenis Kelamin</label>
                                @error('jenisKelmain')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('noTelp') is-invalid @enderror"
                                    id="noTelp" wire:model="noTelp" name="noTelp" placeholder="">
                                <label for="noTelp">No Telp</label>
                                @error('noTelp')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            wire:model="alamat" name="alamat" placeholder="">
                        <label for="alamat">Alamat</label>
                        @error('alamat')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row mb-2 justify-content-between align-items-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" wire:model="foto" name="foto" placeholder="">
                                @error('foto')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-preview p-2">
                                @if ($foto)
                                    <img src="{{ $foto->temporaryUrl() }}" alt="..." class="img-preview rounded">
                                @else
                                    <img src="{{ asset('images/logos/order_ride.svg') }}" alt="..."
                                        class="img-preview rounded">
                                @endif
                            </div>
                        </div>
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
