<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GestionVoyages')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; }
        .card { border: 1.5px solid #eee !important; box-shadow: none !important; }
        .seat-btn { width: 42px; height: 42px; font-size: .8rem; font-weight: 600; border-radius: 6px; border: none; cursor: pointer; transition: transform .1s; }
        .seat-btn:hover:not(:disabled) { transform: scale(1.1); }
        .seat-available { background: #198754; color: #fff; }
        .seat-taken    { background: #ffc107; color: #000; cursor: not-allowed; }
        .seat-selected { background: #0d6efd; color: #fff; }
        .timeline-line { border-left: 3px solid #dee2e6; margin-left: 10px; }
        .timeline-dot  { width: 22px; height: 22px; border-radius: 50%; border: 3px solid #dee2e6; background: #fff; flex-shrink: 0; }
        .timeline-dot.highlight { border-color: #0d6efd; background: #0d6efd; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('client.voyages.index') }}">
                <i class="bi bi-bus-front-fill me-2"></i>GestionVoyages
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#clientNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="clientNav">
                <ul class="navbar-nav ms-auto gap-1 align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link rounded px-3 {{ request()->routeIs('client.voyages*') ? 'active bg-white bg-opacity-10' : '' }}"
                           href="{{ route('client.voyages.index') }}">
                            <i class="bi bi-search me-1"></i>Voyages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded px-3 {{ request()->routeIs('client.tickets*') ? 'active bg-white bg-opacity-10' : '' }}"
                           href="{{ route('client.tickets.index') }}">
                            <i class="bi bi-ticket-perforated me-1"></i>Mes tickets
                        </a>
                    </li>
                    <li class="nav-item ms-2 d-flex align-items-center gap-2">
                        <span class="text-white-50 small"><i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light">
                                <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>{{ $errors->first() }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
