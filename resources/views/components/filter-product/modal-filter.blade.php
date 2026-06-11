{{-- modal --}}
<div wire:ignore.self class="modal fade" id="modal-filter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalFilterLable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFilterLable">Filter Data Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- form Filter --}}
                <form wire:submit="filter" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <select name="filterJenis" id="filterJenis"
                            class="form-control @error('filterJenis') is-invalid @enderror" wire:model="filterJenis">
                            <option value="" selected>--- Semua Jenis Mobil ---</option>
                            @foreach ($jenisMobil as $key => $value)
                                @if ($value->id == $filterJenis)
                                    <option value="{{ $value->id }}" selected>{{ $value->jenis_mobil }}</option>
                                @else
                                    <option value="{{ $value->id }}">{{ $value->jenis_mobil }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="filterJenis">Jenis Mobil</label>
                        @error('filterJenis')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <select name="filterMerek" id="filterMerek"
                            class="form-control @error('filterMerek') is-invalid @enderror" wire:model="filterMerek">
                            <option value="" selected>--- Semua Merek Mobil ---</option>
                            @foreach ($merekMobil as $key => $value)
                                @if ($value->id == $filterMerek)
                                    <option value="{{ $value->id }}" selected>{{ $value->merek_mobil }}</option>
                                @else
                                    <option value="{{ $value->id }}">{{ $value->merek_mobil }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="filterMerek">Jenis Mobil</label>
                        @error('filterMerek')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            FILTER DATA
                            <div wire:loading wire:target="filter" class="ms-3">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div>
                        </button>
                    </div>
                </form>
                {{-- end form Filter --}}

            </div>
        </div>
    </div>
</div>
{{-- end modal --}}
