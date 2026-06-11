{{-- modal --}}
<div wire:ignore.self class="modal modal-lg fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalUpdateLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateLable">Update Pesanan !.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">

                {{-- form update --}}
                <form wire:submit="update" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('profileName') is-invalid @enderror"
                                    id="profileName" wire:model="profileName" name="profileName" placeholder=""
                                    readonly>
                                <label for="profileName">Nama Pemesan</label>
                                @error('profileName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date"
                                    class="form-control @error('tanggalPemesanan') is-invalid @enderror"
                                    id="tanggalPemesanan" wire:model="tanggalPemesanan" name="tanggalPemesanan"
                                    placeholder="">
                                <label for="tanggalPemesanan">Tanggal Pemesanan</label>
                                @error('tanggalPemesanan')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date"
                                    class="form-control @error('tanggalPengembalian') is-invalid @enderror"
                                    id="tanggalPengembalian" wire:model="tanggalPengembalian" name="tanggalPengembalian"
                                    placeholder="">
                                <label for="tanggalPengembalian">Tanggal Pengembalian</label>
                                @error('tanggalPengembalian')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="supir" id="supir"
                                    class="form-control @error('supir') is-invalid @enderror" wire:model.live="supir">
                                    <option value="YA">YA</option>
                                    <option value="TIDAK" selected>TIDAK</option>
                                </select>
                                <label for="supir">Supir</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('tanpaSupir') is-invalid @enderror"
                                    id="tanpaSupir" wire:model="tanpaSupir" name="tanpaSupir" placeholder="" readonly>
                                <label for="tanpaSupir">Tanpa Supir</label>
                                @error('tanpaSupir')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('denganSupir') is-invalid @enderror"
                                    id="denganSupir" wire:model="denganSupir" name="denganSupir" placeholder=""
                                    readonly>
                                <label for="denganSupir">Dengan Supir</label>
                                @error('denganSupir')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if ($supir == 'YA')
                        <div class="row mb-3">
                            @foreach ($daftarSupir as $key => $value)
                                @if ($supirId == null && $value->status_supir == 0)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ asset('images/supir/' . $value->foto) }}" alt="..."
                                                    height="80px" class="img-fluid">
                                                <div class="row mt-2">
                                                    <div class="col-md-4">
                                                        Nama
                                                    </div>
                                                    <div class="col-md-8 text-end">
                                                        {{ $value->nama }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        Telp
                                                    </div>
                                                    <div class="col-md-8 text-end">
                                                        {{ $value->no_telp }}
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-success btn-block w-100"
                                                        wire:click="pilihSupir({{ $value->id }})">
                                                        PILIH SUPIR
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($supirId == $value->id)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ asset('images/supir/' . $value->foto) }}" alt="..."
                                                    height="80px" class="img-fluid">
                                                <div class="row mt-2">
                                                    <div class="col-md-4">
                                                        Nama
                                                    </div>
                                                    <div class="col-md-8 text-end">
                                                        {{ $value->nama }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        Telp
                                                    </div>
                                                    <div class="col-md-8 text-end">
                                                        {{ $value->no_telp }}
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-danger btn-block w-100"
                                                        wire:click="hapusSupir">
                                                        HAPUS SUPIR
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            UPDATE PESANAN
                            <div wire:loading wire:target="update" class="ms-3">
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
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
