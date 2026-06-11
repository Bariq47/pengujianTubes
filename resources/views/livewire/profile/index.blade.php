@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-0">

            <div class="card-body">
                <h5 class="text-center mb-5">Profile</h5>
                <form wire:submit="update" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            wire:model="nama" name="nama" placeholder="">
                        <label for="nama">Nama</label>
                        @error('nama')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('noKtp') is-invalid @enderror" id="noKtp"
                            wire:model="noKtp" name="noKtp" placeholder="">
                        <label for="noKtp">No. KTP</label>
                        @error('noKtp')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select @error('jenisKelamin') is-invalid @enderror" id="jenisKelamin"
                            name="jenisKelamin" wire:model="jenisKelamin">
                            <option selected value="">--- Jenis Kelamin ---</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="jenisKelamin">Jenis Kelamin</label>
                        @error('jenisKelamin')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('noTelp') is-invalid @enderror" id="noTelp"
                            wire:model="noTelp" name="noTelp" placeholder="">
                        <label for="noTelp">No. Handphone</label>
                        @error('noTelp')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-4">
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
                                    <img src="{{ $foto->temporaryUrl() }}" alt="..."
                                        class="image-fluid w-100 h-100">
                                @else
                                    <img src="{{ asset('images/profile/' . $oldFoto) }}" alt="..."
                                        class="image-fluid w-100 h-100">
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fs-4 mb-4 rounded-2">
                        UPDATE PROFILE
                        <div wire:loading wire:target="update" class="ms-3">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </div>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
