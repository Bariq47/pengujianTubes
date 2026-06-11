{{-- modal --}}
<div wire:ignore.self class="modal fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalUpdateLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateLable">Update Data Jenis Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">

                {{-- form update --}}
                <form wire:submit="update" method="POST">
                    @method('PUT')
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
                            UPDATE DATA
                            <div wire:loading wire:target="update" class="ms-3">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div>
                        </button>
                    </div>
                </form>
                {{-- end form update --}}

            </div>
        </div>
    </div>
</div>
{{-- end modal --}}
