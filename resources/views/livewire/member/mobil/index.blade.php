    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @endpush

    <section class="mobil-section pt-0" id="mobil-section">

        @if (session()->has('success'))
            <x-toast alert="success" message="{{ session()->get('success') }}" />
        @elseif (session()->has('error'))
            <x-toast alert="danger" message="{{ session()->get('error') }}" />
        @endif

        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-center">Pilihan Mobil</h3>
                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                    data-bs-target="#modal-filter">Filter</button>
            </div>
            <div class="mt-5">
                <div class="row">
                    @foreach ($data as $key => $value)
                        @if ($value->status_mobil == 0 || $value->pesanan == null)
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
                                        <img src="{{ asset('images/cars/' . $value->foto) }}" class="img-fluid"
                                            style="height: 260px; width: 345px" alt="...">
                                        {{-- end image car --}}

                                        {{-- spesifikasi --}}
                                        <div class="w-100 mt-0 mb-2 d-flex justify-content-center align-items-center">
                                            <h6 class="fs-4 fw-5 text-white">{{ $value->jenismobil->jenis_mobil }}
                                            </h6>
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

                                    {{-- card body --}}
                                    <div class="card-body p-2">

                                        {{-- row --}}
                                        <div class="row">

                                            {{-- no polisi --}}
                                            <div class="col-md-6 mb-2">
                                                <p class="card-text">No Polisi</p>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <p class="card-text text-muted text-end">
                                                    {{ $value->no_polisi }}
                                                </p>
                                            </div>
                                            {{-- end no pplisi --}}

                                            {{-- warna --}}
                                            <div class="col-md-6 mb-2">
                                                <p class="card-text">Warna Mobil</p>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <p class="card-text text-muted text-end">
                                                    {{ $value->warna }}
                                                </p>
                                            </div>
                                            {{-- end warna --}}

                                            {{-- harga tanpa supir --}}
                                            <div class="col-md-6 mb-2">
                                                <p class="card-text">Tanpa Supir</p>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <p class="card-text text-muted text-end">
                                                    Rp. {{ number_format($value->harga_per_hari, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            {{-- end harga tanpa supir --}}

                                            {{-- harga dengan supir --}}
                                            <div class="col-md-6">
                                                <p class="card-text">Dengan Supir</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="card-text text-muted text-end">
                                                    Rp. {{ number_format($value->harga_dengan_supir, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            {{-- end harga dengan supir --}}

                                        </div>
                                        {{-- end row --}}

                                        {{-- button booking --}}
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success btn-block w-100" 
                                                data-bs-toggle="modal" data-bs-target="#modal-booking"
                                                wire:click="booking({{ $value->id }})">
                                                BOOKING
                                            </button>
                                        </div>
                                        {{-- end button booking --}}

                                    </div>
                                    {{-- end card body --}}

                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <x-pesanan.modal-booking :daftarSupir="$daftarSupir" :supir="$supir" :supirId="$supirId" />
            <x-filter-product.modal-filter :jenisMobil="$jenisMobil" :filterJenis="$filterJenis" :merekMobil="$merekMobil" :filterMerek="$filterMerek" />

        </div>
    </section>

    @push('scripts')
        <script>
            window.addEventListener('close-modal', () => {
                $('#modal-booking').modal('hide')
                $('#modal-filter').modal('hide')
                $('.modal-backdrop').addClass('d-none')
            })
            window.addEventListener('close-toast', () => {
                setTimeout(() => {
                    $('#toast').addClass('d-none')
                }, 3000);
            })
        </script>
    @endpush
