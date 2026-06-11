<div class="col-md-4">
    <div class="card mb-3">
        <img src="{{ asset('images/cars/' . $value->foto) }}" class="card-img-top" height="260px" alt="...">
        <div class="card-body">
            <h5 class="card-title text-center">{{ $value->nama_mobil }}</h5>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <p class="card-text">Jenis Mobil</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text text-muted text-end">
                        {{ $value->jenismobil->jenis_mobil }}
                    </p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text">Merek Mobil</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text text-muted text-end">
                        {{ $value->merekmobil->merek_mobil }}
                    </p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text">Warna Mobil</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text text-muted text-end">
                        {{ $value->warna }}
                    </p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text">Jumlah Penumpang</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text text-muted text-end">
                        {{ $value->jumlah_penumpang }}
                    </p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text">Harga Per Hari</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="card-text text-muted text-end">
                        Rp. {{ number_format($value->harga_per_hari, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            <div class="mt-3 mb-2 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary">
                    DETAIL
                </button>
                <a href="{{ route('auth-signin') }}" class="btn btn-primary" wire:navigate>
                    BOOKING
                </a>
            </div>
        </div>
    </div>
</div>
