<div class="hero-section bg-light" id="home">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <h3 class="hero-title">Apakah kamu sedang memutuhkan
                    sebuah mobil ?</h3>
                <p>Anda berada ditempat yang tepat.</p>
                <a href="{{ route('auth-signin') }}" wire:navigate class="btn btn-primary">Pesan Sekarang</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/backgrounds/hero-section.svg') }}" alt="..." class="img-fluid">
            </div>
        </div>
    </div>
</div>
