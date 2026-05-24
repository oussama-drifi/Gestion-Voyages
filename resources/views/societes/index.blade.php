@extends('layouts.app')
@section('title', 'Sociétés')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-2">
        <i class="bi bi-building fs-3 text-primary"></i>
        <h1 class="h3 fw-bold mb-0">Sociétés</h1>
        <span class="badge bg-primary ms-1">{{ $societes->count() }}</span>
    </div>
    <a href="{{ route('societes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>Ajouter une société
    </a>
</div>

@if($societes->isEmpty())
    <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Aucune société trouvée.</div>
@else
    <div class="row g-3">
        @foreach($societes as $societe)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('societes.show', $societe) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-building-fill text-primary fs-5"></i>
                            <h5 class="card-title mb-0 fw-semibold text-dark">{{ $societe->nom }}</h5>
                        </div>
                        <p class="card-text text-muted small mb-2">
                            <i class="bi bi-geo-alt me-1"></i>{{ $societe->adresse_siege }}
                        </p>
                        <div class="d-flex gap-3 text-muted small">
                            <span><i class="bi bi-shop me-1"></i>{{ $societe->agences_count ?? $societe->agences->count() }} agences</span>
                            <span><i class="bi bi-bus-front me-1"></i>{{ $societe->buses_count ?? $societe->buses->count() }} buses</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-end">
                        <small class="text-primary">Voir détails <i class="bi bi-arrow-right"></i></small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif
@endsection
