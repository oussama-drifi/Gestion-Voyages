<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Gestion Voyages')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; letter-spacing: .5px; }
        .nav-link.active { font-weight: 600; }
        .card { border: 1.5px solid #eee !important; box-shadow: none !important; }
        .badge-comfort-basique  { background-color: #6c757d; }
        .badge-comfort-bon      { background-color: #0d6efd; }
        .badge-comfort-comfortable { background-color: #198754; }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-bus-front-fill me-2"></i>GestionVoyages
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto gap-1">
                    @php
                        $links = [
                            'societes.index' => ['icon' => 'bi-building', 'label' => 'Sociétés'],
                            'agences.index'  => ['icon' => 'bi-shop',     'label' => 'Agences'],
                            'buses.index'    => ['icon' => 'bi-bus-front','label' => 'Buses'],
                            'voyages.index'  => ['icon' => 'bi-map',      'label' => 'Voyages'],
                            'tickets.index'  => ['icon' => 'bi-ticket-perforated', 'label' => 'Tickets'],
                        ];
                    @endphp
                    @foreach($links as $route => $item)
                        <li class="nav-item">
                            <a class="nav-link rounded px-3 {{ request()->routeIs(rtrim($route, '.index').'*') ? 'active bg-white bg-opacity-10' : '' }}"
                               href="{{ route($route) }}">
                                <i class="bi {{ $item['icon'] }} me-1"></i>{{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
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
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
