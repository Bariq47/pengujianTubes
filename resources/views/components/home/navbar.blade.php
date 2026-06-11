{{-- navbar --}}
<nav class="navbar navbar-expand-lg navbar-light  fixed-top" style="background-color: #0a2878;">
    <div class="container-fluid">
        {{-- <a class="navbar-brand  fs-5 fw-5" href="{{ route('home') }}" wire:navigate>{{ $kantor->nama }}</a> --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#mobil-section" style="color: white; font-weight: bold; ">Mobil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-hover" href="#pelayanan-section" style="color: white; font-weight: bold;">Pelayanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: white; font-weight: bold;">Download App</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="btn btn-primary me-3" wire:navigate href="{{ route('auth-signin') }}">
                        MASUK
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary text-light" wire:navigate href="{{ route('auth-signup') }}">
                        DAFTAR
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
{{-- end navbar --}}
