{{-- modal --}}
<div wire:ignore.self class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCreateLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLable">Tambah Data Jenis Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">

                {{-- form create --}}
                <form wire:submit="save" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis"
                            wire:model="jenis" name="jenis" placeholder="">
                        <label for="jenis">Jenis Mobil</label>
                        @error('jenis')
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
