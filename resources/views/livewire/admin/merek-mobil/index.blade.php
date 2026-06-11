<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">

                {{-- session flash --}}
                @if (session()->has('success'))
                    <x-toast alert="success" message="{{ session()->get('success') }}" />
                @endif
                {{-- end session flash --}}

                {{-- title and button modal add --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title fw-semibold">DATA MEREK MOBIL</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">
                        <i class="ti ti-plus"></i>
                    </button>
                </div>
                {{-- end title and button modal add --}}

                {{-- input search --}}
                <div class="row mb-3 justify-content-between">
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
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="cari data" name="keyword"
                                id="keyword" wire:model.live="keyword">
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
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Merek Mobil</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr wire:key="{{ $value->id }}">
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-0">{{ $data->firstItem() + $key }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-0">{{ $value->merek_mobil }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex justif-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                                data-bs-target="#modal-update" wire:click="edit({{ $value->id }})">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete"
                                                wire:click="setDelete({{ $value->id }})">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if (count($data) == 0)
                                <tr>
                                    <td class="border-bottom-0 text-center" colspan="5">
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

                <x-merek-mobil.modal-create />
                <x-merek-mobil.modal-update />
                <x-merek-mobil.modal-delete />

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', () => {
            $('#modal-create').modal('hide')
            $('#modal-update').modal('hide')
            $('#modal-delete').modal('hide')
            $('.modal-backdrop').addClass('d-none')
        })
        window.addEventListener('close-toast', () => {
            setTimeout(() => {
                $('#toast').addClass('d-none')
            }, 2000);
        })
    </script>
@endpush
