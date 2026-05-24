@extends('layouts.app')
@section('title', 'Voyages')

@section('content')
<div class="d-flex align-items-center mb-4 gap-2">
    <i class="bi bi-map fs-3 text-info"></i>
    <h1 class="h3 fw-bold mb-0">Voyages</h1>
    <span class="badge bg-info text-dark ms-1">{{ $voyages->count() }}</span>
</div>

@if($voyages->isEmpty())
    <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Aucun voyage trouvé.</div>
@else
    <div class="row g-3">
        @foreach($voyages as $voyage)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('voyages.show', $voyage) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="fw-bold text-dark fs-6">{{ $voyage->ville_depart }}</span>
                            <i class="bi bi-arrow-right text-info mx-2"></i>
                            <span class="fw-bold text-dark fs-6">{{ $voyage->ville_arrive }}</span>
                        </div>
                        <div class="d-flex flex-wrap gap-2 text-muted small">
                            <span><i class="bi bi-calendar3 me-1"></i>{{ $voyage->date?->format('d/m/Y') }}</span>
                            <span><i class="bi bi-clock me-1"></i>{{ $voyage->heure_depart }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                        @if($voyage->bus)
                            <small class="text-muted"><i class="bi bi-bus-front me-1"></i>{{ $voyage->bus->modele }}</small>
                        @endif
                        @if($voyage->voyage_principale_id)
                            <span class="badge bg-secondary ms-auto">Sous-voyage</span>
                        @else
                            <small class="text-info ms-auto">Voir <i class="bi bi-arrow-right"></i></small>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif
@endsection
