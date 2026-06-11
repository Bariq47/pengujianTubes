<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modal-cancle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCancleable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCancleable">Batalkan Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin membatalkan pesanan ini ?</p>
                <form wire:submit="cancle" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal" wire:click="close">
                            BATAL
                        </button>
                        <button type="submit" class="btn btn-danger">
                            BATALKAN PESANAN
                            <div wire:loading wire:target="cancle" class="ms-3">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
