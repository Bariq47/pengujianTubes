<div class="card mb-0">

    @if (session()->has('success'))
        <x-toast alert="primary" message="{{ session()->get('success') }}" />
    @endif

    <div class="card-body">
        <a href="{{ route('home') }}" wire:navigate class="text-nowrap logo-img text-center d-block py-3 w-100">
            <img src="{{ asset('images/logos/order_ride.svg') }}" width="180" alt="">
        </a>
        <p class="text-center">Ayo, daftarkan akun anda sekarang juga.</p>
        <form wire:submit.prevent="save">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    wire:model="email" name="email" placeholder="">
                <label for="email">Email</label>
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    wire:model="password" name="password" placeholder="">
                <label for="password">Password</label>
                @error('password')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control @error('konfirmasiPassword') is-invalid @enderror"
                    id="konfirmasiPassword" wire:model="konfirmasiPassword" name="konfirmasiPassword" placeholder="">
                <label for="konfirmasiPassword">Konfirmasi Password</label>
                @error('konfirmasiPassword')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                DAFTAR
                <div wire:loading class="ms-3">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
            </button>
            <div class="d-flex align-items-center justify-content-center">
                <p class="fs-4 mb-0 fw-bold">Sudah punya akun ?</p>
                <a class="text-primary fw-bold ms-2" href="{{ route('auth-signin') }}" wire:navigate>Masuk</a>
            </div>
        </form>
    </div>
</div>
