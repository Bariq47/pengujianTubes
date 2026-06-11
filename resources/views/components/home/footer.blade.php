<div class="container-fluid">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4">
        <p class="col-md-4 mb-0 text-muted">
            {{ date('Y') }} ERATRANS SURABAYA | alamat: {{ isset($kantor) ? $kantor->alamat : 'Komplek Ruko Grand City Regency, Jl. Rungkut Madya B-21, Central Rungkut, Gunung Anyar, Surabaya' }} | No.Telp: {{ isset($kantor) ? $kantor->no_telp : '+62 811-311-190' }}
        </p>
        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#home" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#mobil-section" class="nav-link px-2 text-muted">Mobil</a></li>
            <li class="nav-item"><a href="#pelayanan-section" class="nav-link px-2 text-muted">Pelayanan</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Download</a></li>
        </ul>
    </footer>
</div>
