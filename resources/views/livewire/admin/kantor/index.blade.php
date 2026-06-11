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
                    <h5 class="card-title fw-semibold">DATA KANTOR</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create">
                        <i class="ti ti-home-plus"></i>
                    </button>
                </div>
                {{-- end title and button modal add --}}

                {{-- table --}}
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle table-hover">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fw-semibold mb-0">Id</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Nama Kantor</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Alamat Kator</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">No. Rekening</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">No. Kantor</h6>
                                </th>
                                <th>
                                    <h6 class="fw-semibold mb-0">Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kantor)
                                <tr wire:key="{{ $kantor->id }}">
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-0">{{ $loop->iteration }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-0">{{ $kantor->nama }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-0">{{ $kantor->alamat }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-0">{{ $kantor->no_rek }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-normal mb-0">{{ $kantor->no_telp }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex justif-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal"
                                                data-bs-target="#modal-update" wire:click="edit({{ $kantor->id }})">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modal-delete"
                                                wire:click="setDelete({{ $kantor->id }})">
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
                    {{ $data->links() }}
                    {{-- end pagination --}}
                </div>
                {{-- end table --}}

                <x-kantor.modal-create />
                <x-kantor.modal-update />
                <x-kantor.modal-delete />

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
            $('.modal-backdrop').modal('hide')
        })
        window.addEventListener('close-toast', () => {
            setTimeout(() => {
                $('#toast').addClass('d-none')
            }, 2000);
        })
    </script>
@endpush
