@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

<div class="container">
    @if (session()->has('success'))
        <x-toast alert="success" message="{{ session()->get('success') }}" />
    @endif

    <div class="card">
        <div class="card-body">
            <div class="detail-title">
                <h4 class="fs-5 mb-3">Detail Pesanan</h4>
                <div class="row">
                    <div class="col-md-4">
                        {{-- box-image --}}
                        <div class="box-card-image rounded p-2" style="background-color: #0080FF;">
                            {{-- card-content-header --}}
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- car name and year --}}
                                <div class="d-flex">
                                    <h5 class="card-title text-white">{{ $data->mobil->nama_mobil }}</h5>
                                    <h6 class="fs-2 text-white ms-2">({{ $data->mobil->tahun_mobil }})</h6>
                                </div>
                                {{-- end car name and year --}}
                                {{-- car merek --}}
                                <div class="text-card-merk">
                                    <h5 class="card-title text-white">{{ $data->mobil->merekmobil->merek_mobil }}</h5>
                                </div>
                                {{-- end car merk --}}
                            </div>
                            {{-- end card content-header --}}
                            {{-- image car --}}
                            <img src="{{ asset('images/cars/' . $data->mobil->foto) }}" class="img-fluid" alt="...">
                            {{-- end image car --}}
                            {{-- spesifikasi --}}
                            <div class="w-100 mb-2 d-flex justify-content-center align-items-center">
                                <h6 class="fs-4 text-white">{{ $data->mobil->jenismobil->jenis_mobil }}</h6>
                            </div>
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div class="text-white card-icon">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <p class="text-white">{{ $data->mobil->jumlah_penumpang }}</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="text-white card-icon">
                                        <i class="ti ti-engine"></i>
                                    </div>
                                    <p class="text-white">{{ $data->mobil->kecepatan }}</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="text-white card-icon">
                                        <i class="ti ti-gas-station"></i>
                                    </div>
                                    <p class="text-white">{{ $data->mobil->bahan_bakar }}</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="text-white card-icon">
                                        <i class="ti ti-air-conditioning"></i>
                                    </div>
                                    <p class="text-white">{{ $data->mobil->ac }}</p>
                                </div>
                            </div>
                            {{-- end spesifikasi --}}
                        </div>
                        {{-- end box-image --}}
                    </div>
                    <div class="col-md-8">
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h6>No. Polisi</h6>
                            <p class="text-muted">{{ $data->mobil->no_polisi }}</p>
                        </div>
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h6>Warna Mobil</h6>
                            <p class="text-muted">{{ $data->mobil->warna }}</p>
                        </div>
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h6>Tanggal pemesanan</h6>
                            <p class="text-muted">{{ $data->tanggal_pemesanan }}</p>
                        </div>
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h6>Tanggal Pengembalian</h6>
                            <p class="text-muted">{{ $data->tanggal_pengembalian }}</p>
                        </div>
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h6>Pesan Dengan Supir</h6>
                            <p class="text-muted">{{ $data->supir }}</p>
                        </div>
                        @if ($data->driver != null)
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <h6>Nama Supir</h6>
                                <div>
                                    <h6 class="text-muted text-end">{{ $data->driver->nama }}</h6>
                                    <p class="text-muted text-end">{{ $data->driver->jenis_kelamin }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h6>Harga Pesanan</h6>
                            <p class="text-muted">Rp. {{ number_format($data->total_harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h6>Lama Pesanan</h6>
                            <p class="text-muted">{{ $data->jumlah_hari }} Hari</p>
                        </div>
                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h6>Total Harga</h6>
                            <p class="text-muted">Rp. {{ number_format($data->total_bayar, 0, ',', '.') }}</p>
                        </div>
                        @if ($data->status_bayar == 'paid')
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <h6>Status Pembayaran</h6>
                                <p class="text-white badge bg-success">{{ $data->status_bayar }}</p>
                            </div>
                        @else
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <h6>Status Pembayaran</h6>
                                <p class="text-white badge bg-danger">{{ $data->status_bayar }}</p>
                            </div>
                        @endif
                        @if ($data->status_bayar == 'unpaid' || $data->status_bayar == 'paid')
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <h6>Keterangan</h6>
                                <p class="text-muted">{{ $data->keterangan }}</p>
                            </div>
                        @endif
                        <div class="w-100 d-flex justify-content-between align-items-center mt-1">
                            <a href="{{ route('member-pesanan') }}" wire:navigate class="btn btn-dark">KEMBALI</a>
                            @if ($data->status_bayar == 'pending')
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('redirect-to-payment', ['order_id' => $data->id, 'amount' => $data->total_bayar]) }}" class="btn btn-success">
                                        BAYAR
                                    </a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('export-invoice', $data->id) }}" target="_blank" class="btn btn-success">
                                        INVOICE
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- end card body --}}
            <x-pesanan.modal-checkout />
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', () => {
            $('#modal-checkout').modal('hide')
            $('.modal-backdrop').addClass('d-none')
        })
        window.addEventListener('close-toast', () => {
            setTimeout(() => {
                $('#toast').addClass('d-none')
            }, 3000);
        })
    </script>
@endpush
