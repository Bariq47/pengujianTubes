<div class="card mb-0">

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @endpush

    <div class="card-body">
        <h5 class="text-center mb-3">Lengkapi data diri anda.</h5>
        <form wire:submit="save" method="POST">
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
            <div class="d-flex justify-content-between align-items-center custom-button-group-create-profile">
                <button type="button" wire:click="logout"
                    class="btn btn-outline-dark w-100 py-8 fs-4 mb-4 me-2 ms-2 rounded-2">
                    BATAL
                    <div wire:loading wire:target="logout" class="ms-3">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </div>
                </button>
                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 ms-2 me-2 rounded-2">
                    Lanjutkan Pendaftaran
                    <div wire:loading wire:target="save" class="ms-3">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>
