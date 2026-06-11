@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">

                {{-- title and button modal add --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">DATA PENGEMBALIAN MOBIL</h5>
                </div>
                {{-- end title and button modal add --}}

                {{-- input search --}}
                <div class="row mb-3 justify-content-between align-items-center">
                    <div class="col-md-2">
                        <div class="form-group" style="width: 60%">
                            <select name="result" id="result" class="form-select" wire:model.live="result">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" class="form-control" placeholder="" name="keyword" id="keyword"
                                wire:model.live="keyword">
                            <label for="keyword">Tanggal Kembali</label>
                        </div>
                    </div>
                </div>
                {{-- end input search --}}

                {{-- table --}}
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle table-hover">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fw-semibold mb-0">Foto</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Mobil</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Nama Pemesan</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Tgl Pengembalian</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Tgl Kembali</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Telat</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Denda</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td class="border-bottom-0">
                                        <div class="box-image-table">
                                            <img src="{{ asset('images/cars/' . $value->pesanan->mobil->foto) }}"
                                                alt="..." class="img-thumbnail">
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-1">{{ $value->pesanan->mobil->nama_mobil }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">{{ $value->pesanan->profile->nama }}</h6>
                                        <span
                                            class="fw-normal mb-0">{{ $value->pesanan->profile->jenis_kelamin }}</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-1">{{ $value->tanggal_pengembalian }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-1">{{ $value->tanggal_kembali }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-1">{{ $value->telat }} Hari</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-1">
                                            Rp. {{ number_format($value->denda, 0, ',', '.') }}
                                        </h6>
                                    </td>
                                </tr>
                            @endforeach

                            @if (count($data) == 0)
                                <tr>
                                    <td class="border-bottom-0 text-center" colspan="8">
                                        <h6 class="fw-semibold mb-0">{{ __('Data tidak Ditemukan !') }}</h6>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    {{-- pagination --}}
                    <div class="d-flex justify-content-end">
                        {{ $data->links() }}
                    </div>
                    {{-- end pagination --}}
                </div>
                {{-- end table --}}

            </div>
        </div>
    </div>
</div>
