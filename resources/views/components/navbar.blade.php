<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ $title }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}"><i class="fa-solid fa-house-chimney" style="color: rgb(4, 63, 142);"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('peta') }}"><i class="fa-regular fa-map" style="color: rgb(4, 63, 142);"></i> Peta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('table') }}"><i class="fa-solid fa-table" style="color: rgb(4, 63, 142);"></i> Tabel</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
