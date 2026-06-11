<div class="card mb-0">

    @if (session()->has('error'))
        <x-toast alert="danger" message="{{ session()->get('error') }}" />
    @elseif(session()->has('success'))
        <x-toast alert="primary" message="{{ session()->get('success') }}" />
    @endif

    <div class="card-body">
        <a href="{{ route('home') }}" wire:navigate class="text-nowrap logo-img text-center d-block py-3 w-100">
            <img src="{{ asset('images/logos/order_ride.svg') }}" width="180" alt="">
        </a>
        <p class="text-center">Halo, selamat datang di Website Rental Mobil ISA.</p>
        <form wire:submit="login" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    wire:model="email" name="email" placeholder="">
                <label for="email">Email</label>
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    wire:model="password" name="password" placeholder="">
                <label for="password">Password</label>
                @error('password')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                MASUK
                <div wire:loading class="ms-3">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
            </button>
            <div class="d-flex align-items-center justify-content-center">
                <p class="fs-4 mb-0 fw-bold">Belum punya akun ?</p>
                <a class="text-primary fw-bold ms-2" href="{{ route('auth-signup') }}" wire:navigate>Daftar</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-toast', function() {
            setTimeout(() => {
                $('#toast').addClass('d-none')
            }, 2000);
        })
    </script>
@endpush
