<div class="card">

    <div class="card-body">

        <div class="row mb-3 justify-content-between align-items-center">
            <div class="col-md-2">
                <h3 class="text-center">Dashboard</h3>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3" style="width: 50%">
                        <div class="form-floating mb-3">
                            <select name="month" id="month" class="form-control" wire:model.live="month">
                                @foreach ($bulan as $key => $value)
                                    @if ($key == $month)
                                        <option value="{{ $key + 1 }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $key + 1 }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="month">Bulan</label>
                        </div>
                    </div>
                    <div class="col-md-3" style="width: 50%">
                        <div class="form-floating mb-3">
                            <select name="year" id="year" class="form-control" wire:model.live="year">
                                @foreach ($tahun as $key => $value)
                                    @if ($value == $tahun)
                                        <option value="{{ $value }}" selected>{{ $value }}</option>
                                    @else
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="year">Tahun</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body rounded" style="background-color: #0080FF;">
                        <h5 class="card-title text-white mb-9 fw-semibold">
                            Pesanan Mobil
                        </h5>
                        <h4 class="fw-semibold mb-3 text-white">
                            {{ $totalPinjamanMobil }} Mobil
                        </h4>
                        <div class="d-flex align-items-center pb-1">
                            <span
                                class="me-2 rounded-circle bg-dark round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-car text-white"></i>
                            </span>
                            <p class="text-white me-1 fs-3 mb-0">Total Pesanan Mobil</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body rounded" style="background-color: #0080FF;">
                        <h5 class="card-title text-white mb-9 fw-semibold">
                            Transaksi Pesanan
                        </h5>
                        <h4 class="fw-semibold mb-3 text-white">
                            {{ $sedangDipinjam }} Mobil
                        </h4>
                        <div class="d-flex align-items-center pb-1">
                            <span
                                class="me-2 rounded-circle bg-dark round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-car text-white"></i>
                            </span>
                            <p class="text-white me-1 fs-3 mb-0">Total Transaksi</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-body rounded" style="background-color: #0080FF;">
                        <h5 class="card-title text-white mb-9 fw-semibold">
                            Total Pengembalian Mobil
                        </h5>
                        <h4 class="fw-semibold mb-3 text-white">
                            {{ $totalPengembalianMobil }} Mobil
                        </h4>
                        <div class="d-flex align-items-center pb-1">
                            <span
                                class="me-2 rounded-circle bg-dark round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-car text-white"></i>
                            </span>
                            <p class="text-white me-1 fs-3 mb-0">Pemgembalian Mobil</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body rounded" style="background-color: #0080FF;">
                        <h5 class="card-title text-white mb-9 fw-semibold">
                            Pembayaran Pending
                        </h5>
                        <h4 class="fw-semibold mb-3 text-white">
                            Rp. {{ number_format($pembayaranPending, 0, ',', '.') }}
                        </h4>
                        <div class="d-flex align-items-center pb-1">
                            <span
                                class="me-2 rounded-circle bg-dark round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-coin text-white"></i>
                            </span>
                            <p class="text-white me-1 fs-3 mb-0">Total Pending.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body rounded" style="background-color: #0080FF;">
                        <h5 class="card-title text-white mb-9 fw-semibold">
                            Pembayaran Paid
                        </h5>
                        <h4 class="fw-semibold mb-3 text-white">
                            Rp. {{ number_format($pembayaranPaid, 0, ',', '.') }}
                        </h4>
                        <div class="d-flex align-items-center pb-1">
                            <span
                                class="me-2 rounded-circle bg-dark round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-coin text-white"></i>
                            </span>
                            <p class="text-white me-1 fs-3 mb-0">Total Paid.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body rounded" style="background-color: #0080FF;">
                        <h5 class="card-title text-white mb-9 fw-semibold">
                            Total Denda
                        </h5>
                        <h4 class="fw-semibold mb-3 text-white">
                            Rp. {{ number_format($totalDenda, 0, ',', '.') }}
                        </h4>
                        <div class="d-flex align-items-center pb-1">
                            <span
                                class="me-2 rounded-circle bg-dark round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-coin text-white"></i>
                            </span>
                            <p class="text-white me-1 fs-3 mb-0">Total Denda.</p>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
