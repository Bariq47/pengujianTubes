{{-- modal --}}
<div wire:ignore.self class="modal modal-lg fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="modalCreateLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLable">Tambah Data Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="close"></button>
            </div>
            <div class="modal-body">

                {{-- form create --}}
                <form wire:submit="save" method="POST">
                    @csrf

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" wire:model="nama" name="nama" placeholder="">
                                <label for="nama">Nama Mobil</label>
                                @error('nama')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="jenis" id="jenis"
                                    class="form-select @error('jenis') is-invalid @enderror" wire:model="jenis">
                                    <option value="" selected>--- Jenis Mobil ---</option>
                                    @foreach ($jenisMobil as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->jenis_mobil }}</option>
                                    @endforeach
                                </select>
                                <label for="jenis">Pilih Jenis Mobil</label>
                                @error('jenis')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="merek" id="merek"
                                    class="form-select @error('merek') is-invalid @enderror" wire:model="merek">
                                    <option value="" selected>--- Merek Mobil ---</option>
                                    @foreach ($merekMobil as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->merek_mobil }}</option>
                                    @endforeach
                                </select>
                                <label for="merek">Pilih Merek Mobil</label>
                                @error('merek')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('noPolisi') is-invalid @enderror"
                                    id="noPolisi" wire:model="noPolisi" name="noPolisi" placeholder="">
                                <label for="noPolisi">No. Polisi</label>
                                @error('noPolisi')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('warna') is-invalid @enderror"
                                    id="warna" wire:model="warna" name="warna" placeholder="">
                                <label for="warna">Warna Mobil</label>
                                @error('warna')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number"
                                    class="form-control @error('jumlahPenumpang') is-invalid @enderror"
                                    id="jumlahPenumpang" wire:model="jumlahPenumpang" name="jumlahPenumpang"
                                    placeholder="">
                                <label for="jumlahPenumpang">Jumlah Penumpang</label>
                                @error('jumlahPenumpang')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                    id="tahun" wire:model="tahun" name="tahun" placeholder="2000" minlength="4"
                                    maxlength="4">
                                <label for="tahun">Tahun Mobil</label>
                                @error('tahun')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                    id="harga" wire:model="harga" name="harga" placeholder="">
                                <label for="harga">Harga Mobil / Hari</label>
                                @error('harga')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number"
                                    class="form-control @error('hargaDenganSupir') is-invalid @enderror"
                                    id="hargaDenganSupir" wire:model="hargaDenganSupir" name="hargaDenganSupir"
                                    placeholder="">
                                <label for="hargaDenganSupir">Harga Dengan Supir Mobil</label>
                                @error('hargaDenganSupir')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('tenaga') is-invalid @enderror"
                                    id="tenaga" wire:model="tenaga" name="tenaga" placeholder="">
                                <label for="tenaga">Tenaga</label>
                                @error('tenaga')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('bahanBakar') is-invalid @enderror"
                                    id="bahanBakar" wire:model="bahanBakar" name="bahanBakar" placeholder="">
                                <label for="bahanBakar">Bahan Bakar</label>
                                @error('bahanBakar')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="ac" id="ac"
                                    class="form-select @error('ac') is-invalid @enderror" wire:model="ac">
                                    <option value="" selected>--- AC Mobil ---</option>
                                    <option value="YA">YA</option>
                                    <option value="TIDAK">TIDAK</option>
                                </select>
                                <label for="ac">Pilih AC</label>
                                @error('ac')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
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
                                    <img src="{{ asset('images/logos/order_ride.svg') }}" alt="..."
                                        class="image-fluid w-100 h-100">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-success">
                            SIMPAN DATA
                            <div wire:loading wire:target="save" class="ms-3">
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
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
