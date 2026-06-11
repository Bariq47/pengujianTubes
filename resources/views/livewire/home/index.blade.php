<div class="page-wrapper">

    <x-home.navbar :kantor="$kantor" />

    <x-home.hero />

    <section class="mobil-section" id="mobil-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-center">Pilihan Mobil</h3>
                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                    data-bs-target="#modal-filter">Filter</button>
            </div>
            <div class="mt-5">
                <div class="row">
                    @foreach ($data as $key => $value)
                        <div class="col-md-4">
                            <div class="card mb-3 rounded">

                                {{-- card background image --}}
                                <div class="box-card-image rounded p-2"
                                    style="background-color: #0080FF;">

                                    {{-- card-content-header --}}
                                    <div class="d-flex justify-content-between align-items-center">
                                        {{-- car name and year --}}
                                        <div class="d-flex">
                                            <h5 class="card-title text-white">{{ $value->nama_mobil }}</h5>
                                            <h6 class="fs-2 text-white ms-2">({{ $value->tahun_mobil }})</h6>
                                        </div>
                                        {{-- end car name and year --}}

                                        {{-- car merek --}}
                                        <div class="text-card-merk">
                                            <h5 class="card-title text-white">
                                                {{ $value->merekmobil->merek_mobil }}</h5>
                                        </div>
                                        {{-- end car merk --}}
                                    </div>
                                    {{-- end card content-header --}}

                                    {{-- image car --}}
                                    <img src="{{ asset('images/cars/' . $value->foto) }}" class="img-fluid" style="height: 260px; width: 400px"
                                        alt="...">
                                    {{-- end image car --}}

                                    {{-- spesifikasi --}}
                                    <div class="w-100 mt-0 mb-2 d-flex justify-content-center align-items-center">
                                        <h6 class="fs-4 fw-5 text-white">{{ $value->jenismobil->jenis_mobil }}</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <div class="text-white card-icon">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <p class="text-white">{{ $value->jumlah_penumpang }}</p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <div class="text-white card-icon">
                                                <i class="ti ti-engine"></i>
                                            </div>
                                            <p class="text-white">{{ $value->kecepatan }}</p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <div class="text-white card-icon">
                                                <i class="ti ti-gas-station"></i>
                                            </div>
                                            <p class="text-white">{{ $value->bahan_bakar }}</p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <div class="text-white card-icon">
                                                <i class="ti ti-air-conditioning"></i>
                                            </div>
                                            <p class="text-white">{{ $value->ac }}</p>
                                        </div>
                                    </div>
                                    {{-- end spesifikasi --}}

                                </div>
                                {{-- end card background image --}}
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <p class="card-text">Warna Mobil</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <p class="card-text text-muted text-end">
                                                {{ $value->warna }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <p class="card-text">Tanpa Supir</p>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <p class="card-text text-muted text-end">
                                                Rp. {{ number_format($value->harga_per_hari, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="card-text">Dengan Supir</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="card-text text-muted text-end">
                                                Rp. {{ number_format($value->harga_dengan_supir, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('auth-signin') }}" class="btn btn-block text-white w-100" style="background-color: #3FE0D0;"
                                            wire:navigate>
                                            BOOKING
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <x-home.pelayanan-section />

    <x-home.footer :kantor="$kantor" />

    <x-filter-product.modal-filter :jenisMobil="$jenisMobil" :filterJenis="$filterJenis" :merekMobil="$merekMobil" :filterMerek="$filterMerek" />


</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', () => {
            $('#modal-filter').modal('hide')
            $('.modal-backdrop').addClass('d-none')
        })
    </script>
@endpush
