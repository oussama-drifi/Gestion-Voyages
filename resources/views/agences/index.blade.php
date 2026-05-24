@extends('layouts.app')
@section('title', 'Agences')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-2">
        <i class="bi bi-shop fs-3 text-success"></i>
        <h1 class="h3 fw-bold mb-0">Agences</h1>
        <span class="badge bg-success ms-1">{{ $agences->count() }}</span>
    </div>
    <a href="{{ route('agences.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i>Ajouter une agence
    </a>
</div>

@if($agences->isEmpty())
    <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Aucune agence trouvée.</div>
@else
    <div class="row g-3">
        @foreach($agences as $agence)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('agences.show', $agence) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-shop-window text-success fs-5"></i>
                            <h5 class="card-title mb-0 fw-semibold text-dark">{{ $agence->nom }}</h5>
                        </div>
                        <p class="text-muted small mb-1"><i class="bi bi-pin-map me-1"></i>{{ $agence->ville }}</p>
                        <p class="text-muted small mb-0"><i class="bi bi-signpost me-1"></i>{{ $agence->adresse }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                        @if($agence->societe)
                            <small class="text-muted"><i class="bi bi-building me-1"></i>{{ $agence->societe->nom }}</small>
                        @endif
                        <small class="text-success ms-auto">Voir <i class="bi bi-arrow-right"></i></small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif
@endsection
